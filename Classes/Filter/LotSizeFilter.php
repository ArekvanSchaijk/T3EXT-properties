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
 * Class LotSizeFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class LotSizeFilter extends AbstractFilter {

    /**
     * @var bool
     */
    protected $isLotSizeRangeCalculated = FALSE;

    /**
     * @var int|bool|null
     */
    protected $lowestLotSize = NULL;

    /**
     * @var int|bool|null
     */
    protected $highestLotSize = NULL;

    /**
     * @var int|bool|null
     */
    protected $selectedLowestLotSize = NULL;

    /**
     * @var int|bool|null
     */
    protected $selectedHighestLotSize = NULL;

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if (parent::getIsActive()) {
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getFilterService()->getObjectService()->getActiveCategory())) {
                if ($category->isDisableFilterLotSize()) {
                    return FALSE;
                }
            }
            if (
                $this->getLowestLotSize() !== FALSE &&
                $this->getHighestLotSize() !== FALSE &&
                $this->getLowestLotSize() != $this->getHighestLotSize()
            ) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Get Lowest Lot Size
     *
     * @return int
     */
    public function getLowestLotSize() {
        if (is_null($this->lowestLotSize)) {
            $this->lowestLotSize = FALSE;
            $filters = array();
            // Uses the current category filter
            if (($categoryFilter = $this->getFilterService()->getFilter(FilterUtility::FILTER_CATEGORY))) {
                $filters[FilterUtility::FILTER_CATEGORY] = $categoryFilter;
            }
            // Gets the lowest object price
            if (($object = $this->getFilterService()->getObjectService()->getFilteredObjects($filters, NULL, 1, array('lot_size' => QueryInterface::ORDER_ASCENDING))->getFirst())) {
                $this->setLowestLotSize($object->getLotSize());
            }
        }
        return $this->lowestLotSize;
    }

    /**
     * Set Lowest Lot Size
     *
     * @param int $lowestLotSize
     * @return void
     */
    public function setLowestLotSize($lowestLotSize) {
        $this->lowestLotSize = $lowestLotSize;
    }

    /**
     * Get Highest Lot Size
     *
     * @return int
     */
    public function getHighestLotSize() {
        if (is_null($this->highestLotSize)) {
            $this->highestLotSize = FALSE;
            $filters = array();
            // Uses the current category filter
            if (($categoryFilter = $this->getFilterService()->getFilter(FilterUtility::FILTER_CATEGORY))) {
                $filters[FilterUtility::FILTER_CATEGORY] = $categoryFilter;
            }
            // Gets the highest object price
            if (($object = $this->getFilterService()->getObjectService()->getFilteredObjects($filters, NULL, 1, array('lot_size' => QueryInterface::ORDER_DESCENDING))->getFirst())) {
                $this->setHighestLotSize($object->getLotSize());
            }
        }
        return $this->highestLotSize;
    }

    /**
     * Set Highest Lot Size
     *
     * @param int $highestLotSize
     * @return void
     */
    public function setHighestLotSize($highestLotSize) {
        $this->highestLotSize = $highestLotSize;
    }

    /**
     * Get Selected Lowest Lot Size
     *
     * @return int
     */
    public function getSelectedLowestLotSize() {
        $this->calculateLotSizeRange();
        return $this->selectedLowestLotSize;
    }

    /**
     * Get Selected Highest Lot Size
     *
     * @return int
     */
    public function getSelectedHighestLotSize() {
        $this->calculateLotSizeRange();
        return $this->selectedHighestLotSize;
    }

    /**
     * Calculate Lot Size Range
     *
     * @return void
     */
    protected function calculateLotSizeRange() {
        if (!$this->isLotSizeRangeCalculated) {
            $this->isLotSizeRangeCalculated = TRUE;
            $this->selectedLowestLotSize = FALSE;
            $this->selectedHighestLotSize = FALSE;
            if ($this->getObjectService()->request->hasArgument(LinkUtility::LOT_SIZE_RANGE)) {
                $range = $this->getObjectService()->request->getArgument(LinkUtility::LOT_SIZE_RANGE);
                if (strpos($range, '-') !== FALSE) {
                    $range = GeneralUtility::trimExplode('-', $range);
                    if (
                        ctype_digit($range[0]) &&
                        ctype_digit($range[1]) &&
                        $range[1] >= $range[0]
                    ) {
                        $this->setSelectedLotSizeRange($range[0], $range[1]);
                    }
                }
            }
        }
    }

    /**
     * Set Selected Lot Size Range
     *
     * @param $selectedLowestLotSize
     * @param $selectedHighestLotSize
     * @return void
     */
    public function setSelectedLotSizeRange($selectedLowestLotSize, $selectedHighestLotSize) {
        $this->isLotSizeRangeCalculated = TRUE;
        $this->selectedLowestLotSize = $selectedLowestLotSize;
        $this->selectedHighestLotSize = $selectedHighestLotSize;
    }

    /**
     * Get Query Constrain
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @return array
     */
    public function getQueryConstrain(Query $query) {
        $constrains = array();
        if (($lowest = $this->getSelectedLowestLotSize()) !== FALSE && ($highest = $this->getSelectedHighestLotSize()) !== FALSE) {
            $constrains[] = $query->greaterThanOrEqual('lot_size', $lowest);
            $constrains[] = $query->lessThanOrEqual('lot_size', $highest);
            return $constrains;
        }
        return FALSE;
    }

}