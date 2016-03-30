<?php
namespace Ucreation\Properties\Filter;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Arek van Schaijk <info@ucreation.nl>, Ucreation
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use Ucreation\Properties\Utility\FilterUtility;
use Ucreation\Properties\Utility\LinkUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;

/**
 * Class PriceFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class PriceFilter extends AbstractFilter {

    /**
     * @var bool
     */
    protected $isPriceRangeCalculated = FALSE;

    /**
     * @var int|bool|null
     */
    protected $lowestPrice = NULL;

    /**
     * @var int|bool|null
     */
    protected $highestPrice = NULL;

    /**
     * @var int|bool|null
     */
    protected $selectedLowestPrice = NULL;

    /**
     * @var int|bool|null
     */
    protected $selectedHighestPrice = NULL;

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if (parent::getIsActive()) {
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getObjectService()->getActiveCategory())) {
                if ($category->isDisableFilterPriceRange()) {
                    return FALSE;
                }
            }
            if (
                $this->getLowestPrice() !== FALSE &&
                $this->getHighestPrice() !== FALSE &&
                $this->getLowestPrice() != $this->getHighestPrice()
            ) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Get Lowest Price
     *
     * @return int
     */
    public function getLowestPrice() {
        if (is_null($this->lowestPrice)) {
            $this->lowestPrice = FALSE;
            $filters = array();
            // Uses the current category filter
            if (($categoryFilter = $this->getFilterService()->getFilter(FilterUtility::FILTER_CATEGORY))) {
                $filters[FilterUtility::FILTER_CATEGORY] = $categoryFilter;
            }
            // Clones the offer filter and filters only for objects that are marked as 'sale'
            if (($offerFilter = $this->getFilterService()->getFilter(FilterUtility::FILTER_OFFER))) {
                $newOfferFilter = clone $offerFilter;
                $newOfferFilter->setActiveOffer(OfferFilter::OFFER_BOTH);
                $filters[FilterUtility::FILTER_OFFER] = $newOfferFilter;
            }
            // Gets the lowest object price
            if (($object = $this->getObjectService()->getFilteredObjects($filters, NULL, 1, array('price' => QueryInterface::ORDER_ASCENDING))->getFirst())) {
                $this->setLowestPrice($object->getPrice());
            }
        }
        return $this->lowestPrice;
    }

    /**
     * Lowest Price
     *
     * @param int $lowestPrice
     * @return void
     */
    public function setLowestPrice($lowestPrice) {
        $this->lowestPrice = $lowestPrice;
    }

    /**
     * Get Highest Price
     *
     * @return int|bool
     */
    public function getHighestPrice() {
        if (is_null($this->highestPrice)) {
            $this->highestPrice = FALSE;
            $filters = array();
            // Uses the current category filter
            if (($categoryFilter = $this->getFilterService()->getFilter(FilterUtility::FILTER_CATEGORY))) {
                $filters[FilterUtility::FILTER_CATEGORY] = $categoryFilter;
            }
            // Clones the offer filter and filters only for objects that are marked as 'sale'
            if (($offerFilter = $this->getFilterService()->getFilter(FilterUtility::FILTER_OFFER))) {
                $newOfferFilter = clone $offerFilter;
                $newOfferFilter->setActiveOffer(OfferFilter::OFFER_BOTH);
                $filters[FilterUtility::FILTER_OFFER] = $newOfferFilter;
            }
            // Gets the highest object price
            if (($object = $this->getObjectService()->getFilteredObjects($filters, NULL, 1, array('price' => QueryInterface::ORDER_DESCENDING))->getFirst())) {
                $this->setHighestPrice($object->getPrice());
            }
        }
        return $this->highestPrice;
    }

    /**
     * Set Highest Price
     *
     * @param int $highestPrice
     * @return void
     */
    public function setHighestPrice($highestPrice) {
        $this->highestPrice = $highestPrice;
    }

    /**
     * Get Selected Lowest Price
     *
     * @return int
     */
    public function getSelectedLowestPrice() {
        $this->calculatePriceRange();
        return $this->selectedLowestPrice;
    }

    /**
     * Get Selected Highest Price
     *
     * @return int
     */
    public function getSelectedHighestPrice() {
        $this->calculatePriceRange();
        return $this->selectedHighestPrice;
    }

    /**
     * Calculate Price Range
     *
     * @return void
     */
    protected function calculatePriceRange() {
        if (!$this->isPriceRangeCalculated) {
            $this->isPriceRangeCalculated = TRUE;
            $this->selectedLowestPrice = FALSE;
            $this->selectedHighestPrice = FALSE;
            if ($this->getObjectService()->request->hasArgument(LinkUtility::PRICE_RANGE)) {
                $range = $this->getObjectService()->request->getArgument(LinkUtility::PRICE_RANGE);
                if (strpos($range, '-') !== FALSE) {
                    $range = GeneralUtility::trimExplode('-', $range);
                    if (
                        ctype_digit($range[0]) &&
                        ctype_digit($range[1]) &&
                        $range[1] >= $range[0]
                    ) {
                        $this->setSelectedPriceRange($range[0], $range[1]);
                    }
                }
            }
        }
    }

    /**
     * Set Selected Price Range
     *
     * @param int $selectedLowestPrice
     * @param int $selectedHighestPrice
     * @return void
     */
    public function setSelectedPriceRange($selectedLowestPrice, $selectedHighestPrice) {
        $this->isPriceRangeCalculated = TRUE;
        $this->selectedLowestPrice = $selectedLowestPrice;
        $this->selectedHighestPrice = $selectedHighestPrice;
    }

    /**
     * Get Query Constrain
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @return array
     */
    public function getQueryConstrain(Query $query) {
        $constrains = array();
        if (($lowest = $this->getSelectedLowestPrice()) !== FALSE && ($highest = $this->getSelectedHighestPrice()) !== FALSE) {
            $constrains[] = $query->greaterThanOrEqual('price', $lowest);
            $constrains[] = $query->lessThanOrEqual('price', $highest);
            return $constrains;
        }
        return FALSE;
    }

}