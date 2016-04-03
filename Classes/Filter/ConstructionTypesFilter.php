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
 * Class ConstructionTypesFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class ConstructionTypesFilter extends AbstractFilter {

    /**
     * @var array|null
     */
    protected $activeConstructionTypes = NULL;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\ConstructionType>
     */
    protected $availableConstructionTypes = FALSE;

    /**
     * @var \Ucreation\Properties\Domain\Repository\ConstructionTypeRepository
     * @inject
     */
    protected $constructionTypeRepository = NULL;

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if (parent::getIsActive()) {
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getObjectService()->getActiveCategory())) {
                if ($category->getDisableFilterConstructionType()) {
                    return FALSE;
                }
            }
            // Auto deactivates the filter by setup
            if (
                (bool)$this->getObjectService()->settings['filters']['autoDeactivate'] &&
                !$this->getConstructionTypes()
            ) {
                return FALSE;
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get Available Construction Types
     *
     * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\ConstructionTypes>
     */
    public function getAvailableConstructionTypes() {
        if ($this->availableConstructionTypes === FALSE) {
            $this->availableConstructionTypes = $this->constructionTypeRepository->findAvailableFilterOptions();
        }
        return $this->availableConstructionTypes;
    }

    /**
     * Get Construction Types
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\ConstructionType>
     */
    public function getConstructionTypes() {
        if (!(bool)$this->getObjectService()->settings['filters']['hideDisabledOptions']) {
            return $this->getAvailableConstructionTypes();
        }
        $constructionTypes = array();
        foreach ($this->getAvailableConstructionTypes() as $constructionType) {
            if (!$constructionType->getIsDisabled()) {
                $constructionTypes[] = $constructionType;
            }
        }
        return $constructionTypes;
    }

    /**
     * Get Active Construction Types
     *
     * @return array
     */
    public function getActiveConstructionTypes() {
        if (is_null($this->activeConstructionTypes)) {
            $this->activeConstructionTypes = array();
            if ($this->getObjectService()->request->hasArgument(LinkUtility::CONSTRUCTION_TYPES)) {
                $this->activeConstructionTypes = GeneralUtility::trimExplode(',', $this->getObjectService()->request->getArgument(LinkUtility::CONSTRUCTION_TYPES));
            }
        }
        return $this->activeConstructionTypes;
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
        foreach ($this->getConstructionTypes() as $constructionType) {
            if ($constructionType->getIsActive()) {
                $constrains[] = $query->equals('construction_type', $constructionType->getUid());
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