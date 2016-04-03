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

use Ucreation\Properties\Utility\LinkUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;

/**
 * Class PositionsFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class PositionsFilter extends AbstractFilter {

    /**
     * @var array|null
     */
    protected $activePositions = NULL;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Position>
     */
    protected $availablePositions = FALSE;

    /**
     * @var \Ucreation\Properties\Domain\Repository\PositionRepository
     * @inject
     */
    protected $positionRepository = NULL;

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if (parent::getIsActive()) {
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getFilterService()->getObjectService()->getActiveCategory())) {
                if ($category->getDisableFilterPosition()) {
                    return FALSE;
                }
            }
            // Auto deactivates the filter by setup
            if (
                (bool)$this->getObjectService()->settings['filters']['autoDeactivate'] &&
                !$this->getPositions()
            ) {
                return FALSE;
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get Available Positions
     *
     * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Position>
     */
    public function getAvailablePositions() {
        if ($this->availablePositions === FALSE) {
            $this->availablePositions = $this->positionRepository->findAvailableFilterOptions();
        }
        return $this->availablePositions;
    }

    /**
     * Get Positions
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Position>
     */
    public function getPositions() {
        if (!(bool)$this->getObjectService()->settings['filters']['hideDisabledOptions']) {
            return $this->getAvailablePositions();
        }
        $positions = array();
        foreach ($this->getAvailablePositions() as $position) {
            if (!$position->getIsDisabled()) {
                $positions[] = $position;
            }
        }
        return $positions;
    }

    /**
     * Get Active Positions
     *
     * @return array
     */
    public function getActivePositions() {
        if (is_null($this->activePositions)) {
            $this->activePositions = array();
            if ($this->getObjectService()->request->hasArgument(LinkUtility::POSITIONS)) {
                $this->activePositions = GeneralUtility::trimExplode(',', $this->getObjectService()->request->getArgument(LinkUtility::POSITIONS));
            }
        }
        return $this->activePositions;
    }

    /**
     * Get Query Constrains
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @param array $additionalConstrains
     * @return array|bool
     */
    public function getQueryConstrains(Query $query, array $additionalConstrains = NULL) {
        $constrains = array();
        foreach ($this->getPositions() as $position) {
            if ($position->getIsActive()) {
                $constrains[] = $query->equals('position', $position->getUid());
            }
        }
        if ($constrains) {
            if (count($constrains) == 1) {
                return $constrains[0];
            }
            return $query->logicalOr($constrains);
        }
        return FALSE;
    }

}