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
use TYPO3\CMS\Extbase\Persistence\Generic\Query;

/**
 * Class PresencesFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class PresencesFilter extends AbstractFilter {

    /**
     * @var array|null
     */
    protected $activePresences = NULL;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Presence>|bool
     */
    protected $availablePresences = FALSE;

    /**
     * @var \Ucreation\Properties\Domain\Repository\PresenceRepository
     * @inject
     */
    protected $presenceRepository = NULL;

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if (parent::getIsActive()) {
            // Disables the filter when the 'type(s)' filters are only filtering for lots
            if (($typeFilter = $this->getFilterService()->getFilter(FilterUtility::FILTER_TYPE))) {
                if (
                    $typeFilter->getIsActive() &&
                    $typeFilter->getActiveType() == TypeFilter::TYPE_LOT
                ) {
                    return FALSE;
                }
            }
            if (($typesFilter = $this->getFilterService()->getFilter(FilterUtility::FILTER_TYPES))) {
                if ($typesFilter->getIsActive()) {
                    $activeTypes = $typesFilter->getActiveTypes();
                    if (count($activeTypes) == 1 && $activeTypes[0] == TypesFilter::TYPE_LOTS) {
                        return FALSE;
                    }
                }
            }
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getObjectService()->getActiveCategory())) {
                if ($category->getDisableFilterPresences()) {
                    return FALSE;
                }
            }
            // Auto deactivates the filter by setup
            if (
                $this->getFilterService()->getIsAutoDeactivate() &&
                !$this->getPresences()
            ) {
                return FALSE;
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get Available Presences
     *
     * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Presence>
     */
    public function getAvailablePresences() {
        if ($this->availablePresences === FALSE) {
            $this->availablePresences = $this->presenceRepository->findAvailableFilterOptions();
        }
        return $this->availablePresences;
    }

    /**
     * Get Presences
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Presence>
     */
    public function getPresences() {
        if (!(bool)$this->getObjectService()->settings['filters']['hideDisabledOptions']) {
            return $this->getAvailablePresences();
        }
        $presences = array();
        foreach ($this->getAvailablePresences() as $presence) {
            if (!$presence->getIsDisabled()) {
                $presences[] = $presence;
            }
        }
        return $presences;
    }

    /**
     * Get Active Presences
     *
     * @return array
     */
    public function getActivePresences() {
        if (is_null($this->activePresences)) {
            $this->activePresences = array();
            if ($this->getObjectService()->request->hasArgument(LinkUtility::PRESENCES)) {
                $this->activePresences = GeneralUtility::trimExplode(',', $this->getObjectService()->request->getArgument(LinkUtility::PRESENCES));
            }
        }
        return $this->activePresences;
    }

    /**
     * Is Presence Id Active
     *
     * @param int $presenceId
     * @return bool
     */
    public function isPresenceIdActive($presenceId) {
        return in_array($presenceId, $this->getActivePresences());
    }

    /**
     * Set Active Presence
     *
     * @param int $presenceId
     * @return void
     */
    public function setActivePresence($presenceId) {
        if (!in_array($presenceId, $this->activePresences)) {
            $this->activePresences[] = $presenceId;
        }
    }

    /**
     * Set Active Presences
     *
     * @param array $activePresences
     * @return void
     */
    public function setActivePresences(array $activePresences) {
        $this->activePresences = $activePresences;
    }

    /**
     * Get Query Constrains
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @param array $additionalConstrains
     * @return array|null
     */
    public function getQueryConstrains(Query $query, array $additionalConstrains = NULL) {
        $constrains = array();
        foreach ($this->getPresences() as $presence) {
            if ($presence->getIsActive()) {
                $constrains[] = $query->contains('presences', (int)$presence->getUid());
            }
        }
        if ($constrains) {
            if (count($constrains) == 1) {
                return $constrains[0];
            }
            return $constrains;
        }
        return FALSE;
    }

}