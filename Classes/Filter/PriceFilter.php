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
     * @var array|null
     */
    protected $options = NULL;

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
     * @var int|bool|null
     */
    protected $selectedPriceMinimum = FALSE;

    /**
     * @var int|bool|null
     */
    protected $selectedPriceMaximum = FALSE;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager = NULL;

    /**
     * Get Is Slider
     *
     * @return bool
     */
    public function getIsSlider() {
        return (bool)$this->getObjectService()->settings['filters']['price']['slider']['enable'];
    }

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if (parent::getIsActive()) {
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getObjectService()->getActiveCategory())) {
                if ($category->getDisableFilterPriceRange()) {
                    return FALSE;
                }
            }
            if (
                !$this->getIsSlider() ||
                (
                    $this->getLowestPrice() !== FALSE &&
                    $this->getHighestPrice() !== FALSE &&
                    $this->getLowestPrice() != $this->getHighestPrice()
                )
            ) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Get Price Options Array
     *
     * @return array
     */
    protected function getPriceOptionsArray() {
        return GeneralUtility::trimExplode(',', $this->getObjectService()->settings['filters']['price']['options']);
    }

    /**
     * Get Price Options
     *
     * @return array
     */
    public function getPriceOptions() {
        if (is_null($this->options)) {
            $this->options = array();
            foreach ($this->getPriceOptionsArray() as $priceOption) {
                if (ctype_digit($priceOption)) {
                    $option = $this->getNewPriceOptionObject();
                    $option->setValue($priceOption);
                    $option->setLabel(
                        trim(
                            str_replace('*', chr(32), $this->getObjectService()->settings['filters']['price']['prependLabel']).
                            number_format($priceOption, 0, NULL, $this->getObjectService()->settings['filters']['price']['thousandsSeparator']).
                            str_replace('*', chr(32), $this->getObjectService()->settings['filters']['price']['appendLabel'])
                        )
                    );
                    $this->options[$priceOption] = $option;
                }
            }
        }
        return $this->options;
    }

    /**
     * Get New Price Option Object
     *
     * @return \Ucreation\Properties\Filter\Option\StatusOption
     */
    protected function getNewPriceOptionObject() {
        return $this->objectManager->get('Ucreation\\Properties\\Filter\\Option\\PriceOption');
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
            if (($object = $this->getObjectService()->getFilteredObjects($filters, NULL, NULL, 1, array('price' => QueryInterface::ORDER_ASCENDING))->getFirst())) {
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
            if (($object = $this->getObjectService()->getFilteredObjects($filters, NULL, NULL, 1, array('price' => QueryInterface::ORDER_DESCENDING))->getFirst())) {
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
     * Get Selected Price Minimum
     *
     * @return int|null
     */
    public function getSelectedPriceMinimum() {
        if ($this->selectedPriceMinimum === FALSE) {
            $this->selectedPriceMinimum = NULL;
            if ($this->getObjectService()->request->hasArgument(LinkUtility::PRICE_MIN)) {
                $minimum = $this->getObjectService()->request->getArgument(LinkUtility::PRICE_MIN);
                if (in_array($minimum, $this->getPriceOptionsArray())) {
                    $this->selectedPriceMinimum = $minimum;
                }
            }
        }
        return $this->selectedPriceMinimum;
    }

    /**
     * Get Selected Price Maximum
     *
     * @return int|null
     */
    public function getSelectedPriceMaximum() {
        if ($this->selectedPriceMaximum === FALSE) {
            $this->selectedPriceMaximum = NULL;
            if ($this->getObjectService()->request->hasArgument(LinkUtility::PRICE_MAX)) {
                $maximum = $this->getObjectService()->request->getArgument(LinkUtility::PRICE_MAX);
                if (in_array($maximum, $this->getPriceOptionsArray())) {
                    if (!$this->getSelectedPriceMinimum() || $maximum >= $this->getSelectedPriceMinimum()) {
                        $this->selectedPriceMaximum = $maximum;
                    }
                }
            }
        }
        return $this->selectedPriceMaximum;
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
     * Get Query Constrains
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @param array $additionalConstrains
     * @return array
     */
    public function getQueryConstrains(Query $query, array $additionalConstrains = NULL) {
        $constrains = array();
        if ($this->getIsSlider()) {
            if (($lowest = $this->getSelectedLowestPrice()) !== FALSE && ($highest = $this->getSelectedHighestPrice()) !== FALSE) {
                $constrains[] = $query->greaterThanOrEqual('price', $lowest);
                $constrains[] = $query->lessThanOrEqual('price', $highest);
                return $constrains;
            }
        } else {
            // If there is a minimum price selected we adjust it in the query below
            if (($minimum = $this->getSelectedPriceMinimum())) {
                $constrains[] = $query->greaterThanOrEqual('price', $minimum);
            }
            // If there is a maximum price selected we adjust it in the query below
            if (($maximum = $this->getSelectedPriceMaximum())) {
                $constrains[] = $query->lessThanOrEqual('price', $maximum);
            }
            if ($constrains) {
                if (count($constrains) == 1) {
                    return $constrains[0];
                }
                return $constrains;
            }
        }
        return FALSE;
    }

}