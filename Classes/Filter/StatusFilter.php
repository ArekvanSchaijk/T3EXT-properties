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

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use Ucreation\Properties\Domain\Model\Object;

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
            STATUS_UNAVAILABLE = 4;

    /**
     * @var array|null
     */
    protected $options = NULL;

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
                if ($category->isDisableFilterStatus()) {
                    return FALSE;
                }
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
    static protected function getStatusOptionsArray() {
        return array(
            self::STATUS_AVAILABLE => LocalizationUtility::translate('filter.status.available', self::$extensionName),
            self::STATUS_SOLD => LocalizationUtility::translate('filter.status.sold', self::$extensionName),
            self::STATUS_LEASED => LocalizationUtility::translate('filter.status.leased', self::$extensionName),
            self::STATUS_UNAVAILABLE => LocalizationUtility::translate('filter.status.unavailable', self::$extensionName),
        );
    }

    /**
     * Get Status Options
     *
     * @return array
     */
    public function getStatusOptions() {
        if (is_null($this->options)) {
            $this->options = array();
            foreach (self::getStatusOptionsArray() as $value => $label) {
                $option = $this->getNewStatusOptionObject();
                $option->setLabel($label);
                $option->setValue($value);
                $this->options[$label] = $option;
            }
        }
        return $this->options;
    }

    /**
     * Set Status Options
     *
     * @param array $options
     * @return void
     */
    public function setStatusOptions(array $options) {
        $this->options = $options;
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
     * Get Query Constrain
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @return array|bool
     */
    public function getQueryConstrain(Query $query) {
        return FALSE;
        $constrains = array();
        foreach ($this->getStatusOptions() as $option) {
            if ($option->getIsActive()) {
                switch ($option->getLabel()) {
                    case self::STATUS_AVAILABLE:
                        $constrains[] = $query->equals('status', Object::STATUS_AVAILABLE);
                        break;
                    case self::STATUS_SOLD:
                        $constrains[] = $query->equals('status', Object::STATUS_SOLD);
                        break;
                    case self::STATUS_LEASED:
                        $constrains[] = $query->equals('status', Object::STATUS_LEASED);
                        break;
                    case self::STATUS_UNAVAILABLE:
                        $constrains[] = $query->equals('status', Object::STATUS_UNAVAILABLE);
                        break;
                }
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