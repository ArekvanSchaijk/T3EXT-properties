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

use Ucreation\Properties\Domain\Model\Object;
use Ucreation\Properties\Utility\LinkUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;

/**
 * Class StatusFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class StatusFilter extends AbstractFilter {

    /**
     * @const int
     */
    const   STATUS_AVAILABLE = 1,
            STATUS_SOLD = 2,
            STATUS_LEASED = 3,
            STATUS_NOT_AVAILABLE = 4;

    /**
     * @var array|null
     */
    protected $options = NULL;

    /**
     * @var array|null
     */
    protected $activeStates = NULL;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager = NULL;

    /**
     * Clone
     *
     * @return void
     */
    public function __clone() {
        $newOptions = array();
        foreach ($this->getStatusOptions() as $label => $option) {
            $newOptions[$label] = clone $option;
        }
        $this->options = $newOptions;
    }

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if (parent::getIsActive()) {
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getFilterService()->getObjectService()->getActiveCategory())) {
                if ($category->getDisableFilterStatus()) {
                    return FALSE;
                }
            }
            // Auto deactivates the filter by setup
            if (
                $this->getFilterService()->getIsAutoDeactivate() &&
                !$this->getStatusOptions()
            ) {
                return FALSE;
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get Status Options Array
     *
     * @return array
     */
    protected function getStatusOptionsArray() {
        $optionsArray = array(
            self::STATUS_AVAILABLE => LocalizationUtility::translate('filter.status.available', self::$extensionName),
            self::STATUS_SOLD => LocalizationUtility::translate('filter.status.sold', self::$extensionName),
            self::STATUS_LEASED => LocalizationUtility::translate('filter.status.leased', self::$extensionName),
            self::STATUS_NOT_AVAILABLE => LocalizationUtility::translate('filter.status.unavailable', self::$extensionName),
        );
        // Removes options by setup
        if (((bool)$removedOptions = $this->getObjectService()->settings['filters']['status']['options']['remove'])) {
            $removedOptions = GeneralUtility::trimExplode(',', $removedOptions);
            foreach ($removedOptions as $removedOption) {
                unset($optionsArray[$removedOption]);
            }
        }
        return $optionsArray;
    }

    /**
     * Get Status Options
     *
     * @return array
     */
    public function getStatusOptions() {
        if (is_null($this->options)) {
            $this->options = array();
            foreach ($this->getStatusOptionsArray() as $value => $label) {
                $option = $this->getNewStatusOptionObject();
                $option->setLabel($label);
                $option->setValue($value);
                // Hides disabled options by setup
                if (!$this->getObjectService()->settings['filters']['hideDisabledOptions'] || !$option->getIsDisabled()) {
                    $this->options[$value] = $option;
                }
            }
        }
        return $this->options;
    }

    /**
     * Get Active States
     *
     * @return array
     */
    public function getActiveStates() {
        if (is_null($this->activeStates)) {
            $this->activeStates = array();
            if ($this->getObjectService()->request->hasArgument(LinkUtility::STATUS)) {
                $this->activeStates = GeneralUtility::trimExplode(',', $this->getObjectService()->request->getArgument(LinkUtility::STATUS));
            }
        }
        return $this->activeStates;
    }

    /**
     * Get New Status Option Object
     *
     * @return \Ucreation\Properties\Filter\Option\StatusOption
     */
    protected function getNewStatusOptionObject() {
        return $this->objectManager->get('Ucreation\\Properties\\Filter\\Option\\StatusOption');
    }

    /**
     * Get Query Status Value
     *
     * @param int $status
     * @return int
     */
    static public function getQueryStatusValue($status) {
        switch ($status) {
            case self::STATUS_AVAILABLE:
                return Object::STATUS_AVAILABLE;
            case self::STATUS_SOLD:
                return Object::STATUS_SOLD;
            case self::STATUS_LEASED:
                return Object::STATUS_LEASED;
            case self::STATUS_NOT_AVAILABLE:
                return Object::STATUS_NOT_AVAILABLE;
            default:
                return FALSE;
        }
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
        foreach ($this->getStatusOptions() as $option) {
            if ($option->getIsActive()) {
                $constrains[] = $query->equals('status', self::getQueryStatusValue($option->getValue()));
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