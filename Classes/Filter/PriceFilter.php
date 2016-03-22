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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use Ucreation\Properties\Utility\LinkUtility;

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
     * @var bool|int
     */
    protected $lowestPrice = FALSE;

    /**
     * @var bool|int
     */
    protected $highestPrice = FALSE;

    /**
     * @var bool|int
     */
    protected $selectedLowestPrice = FALSE;

    /**
     * @var bool|int
     */
    protected $selectedHighestPrice = FALSE;

    /**
     * Is Active
     *
     * @return bool
     */
    public function isActive() {
        if (
            !parent::isActive() ||
            // Filter is not active when there isn't a lowest or highest price
            !$this->getLowestPrice() ||
            !$this->getHighestPrice() ||
            // The filter can't be used either when the lowest price matches the highest price
            $this->getLowestPrice() == $this->getHighestPrice()
        ) {
            return FALSE;
        }
        return FALSE;
    }

    /**
     * Get Lowest Price
     *
     * @return int
     */
    public function getLowestPrice() {
        if ($this->lowestPrice === FALSE) {

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
     * Calculate Price Range
     *
     * @return void
     */
    protected function calculatePriceRange() {
        $this->isPriceRangeCalculated = TRUE;
        if ($this->filterService->getObjectService()->request->hasArgument(LinkUtility::PRICE_RANGE)) {
            $range = $this->filterService->getObjectService()->request->getArgument(LinkUtility::PRICE_RANGE);
            if (strpos($range, '-') !== FALSE) {
                $range = GeneralUtility::trimExplode('-', $selectedPriceRange);
                if (
                    ctype_digit($range[0]) &&
                    ctype_digit($range[1]) &&
                    $range[1] >= $range[0]
                ) {
                    $this->selectedLowestPrice = $range[0];
                    $this->selectedHighestPrice = $range[1];
                }
            }
        }
    }

    /**
     * Get Highest Price
     *
     * @return int
     */
    public function getHighestPrice() {
        if ($this->highestPrice === FALSE) {
            $filters = $this->filterService->getFilters();
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
        if (!$this->isPriceRangeCalculated) {
            $this->calculatePriceRange();
        }
        return $this->selectedLowestPrice;
    }

    /**
     * Get Selected Highest Price
     *
     * @return int
     */
    public function getSelectedHighestPrice() {
        if (!$this->isPriceRangeCalculated) {
            $this->calculatePriceRange();
        }
        return $this->selectedHighestPrice;
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
        // Lowest price
        $lowest = ($this->getSelectedLowestPrice() ? : $this->getLowestPrice());
        // Highest price
        $highest = ($this->getSelectedHighestPrice() ? : $this->getHighestPrice());
        if (ctype_digit($lowest)) {
            $constrains[] = $query->greaterThanOrEqual('price', $lowest);
        }
        if (ctype_digit($highest)) {
            $constrains[] = $query->lessThanOrEqual('price', $highest);
        }
        return $constrains;
    }

}