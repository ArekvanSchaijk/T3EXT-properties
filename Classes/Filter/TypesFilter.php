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
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Ucreation\Properties\Domain\Model\Object;
use Ucreation\Properties\Utility\LinkUtility;

/**
 * Class TypesFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class TypesFilter extends AbstractFilter {

    /**
     * @const int
     */
    const   TYPE_BUILDINGS_FOR_SALE = 1,
            TYPE_BUILDINGS_FOR_RENT = 2,
            TYPE_LOTS = 3;

    /**
     * @var array|null
     */
    protected $options = NULL;

    /**
     * @var array|null
     */
    protected $activeTypes = NULL;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager = NULL;

    /**
     * @var bool
     */
    protected $availableObjectsMode = FALSE;

    /**
     * @var int|null
     */
    protected $availableObjectsModeType = NULL;

    /**
     * Get Is Available Objects Mode
     *
     * @return bool
     */
    public function getIsAvailableObjectsMode() {
        return $this->availableObjectsMode;
    }

    /**
     * Get Available Objects Mode Type
     *
     * @return int
     */
    public function getAvailableObjectsModeType() {
        return $this->availableObjectsModeType;
    }

    /**
     * Set Available Objects Mode
     *
     * @param int $typeOption
     * @return void
     */
    public function setAvailableObjectsMode($typeOption) {
        $this->availableObjectsMode = TRUE;
        $this->availableObjectsModeType = $typeOption;
    }

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if ($this->getIsAvailableObjectsMode()) {
            return TRUE;
        }
        if (parent::getIsActive()) {
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getFilterService()->getObjectService()->getActiveCategory())) {
                if ($category->getDisableFilterTypes()) {
                    return FALSE;
                }
            }
            // Auto deactivates the filter by setup
            if (
                (bool)$this->getObjectService()->settings['filters']['autoDeactivate'] &&
                !$this->getTypesOptions()
            ) {
                return FALSE;
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get Types Options Array
     *
     * @return array
     */
    public function getTypesOptionsArray() {
        $optionsArray = array(
            self::TYPE_BUILDINGS_FOR_SALE => LocalizationUtility::translate('filter.types.buildings_for_sale', self::$extensionName),
            self::TYPE_BUILDINGS_FOR_RENT => LocalizationUtility::translate('filter.types.buildings_for_rent', self::$extensionName),
            self::TYPE_LOTS => LocalizationUtility::translate('filter.types.lots', self::$extensionName),
        );
        // Removes options by setup
        if (((bool)$removedOptions = $this->getObjectService()->settings['filters']['types']['options']['remove'])) {
            $removedOptions = GeneralUtility::trimExplode(',', $removedOptions);
            foreach ($removedOptions as $removedOption) {
                unset($optionsArray[$removedOption]);
            }
        }
        return $optionsArray;
    }

    /**
     * Get Types Options
     *
     * @return array
     */
    public function getTypesOptions() {
        if (is_null($this->options)) {
            $this->options = array();
            foreach ($this->getTypesOptionsArray() as $value => $label) {
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
     * Get Active Types
     *
     * @return array
     */
    public function getActiveTypes() {
        if (is_null($this->activeTypes)) {
            $this->activeTypes = array();
            if ($this->getObjectService()->request->hasArgument(LinkUtility::TYPES)) {
                $this->activeTypes = GeneralUtility::trimExplode(',', $this->getObjectService()->request->getArgument(LinkUtility::TYPES));
            }
        }
        return $this->activeTypes;
    }

    /**
     * Get New Types Option Object
     *
     * @return \Ucreation\Properties\Filter\Option\TypesOption
     */
    protected function getNewStatusOptionObject() {
        return $this->objectManager->get('Ucreation\\Properties\\Filter\\Option\\TypesOption');
    }

    /**
     * Get Query Constrains
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @param array $additionalConstrains
     * @return array
     */
    public function getQueryConstrains(Query $query, array $additionalConstrains = NULL) {
        if ($this->getIsAvailableObjectsMode()) {
            switch ($this->getAvailableObjectsModeType()) {
                case self::TYPE_BUILDINGS_FOR_SALE:
                    return $this->getBuildingForSaleQueryConstrain($query);
                    break;
                case self::TYPE_BUILDINGS_FOR_RENT:
                    return $this->getBuildingForRentQueryConstrain($query);
                    break;
                case self::TYPE_LOTS:
                    return $this->getLotsQueryConstrain($query);
                    break;
            }
        } else {
            $constrains = array();
            foreach ($this->getTypesOptions() as $option) {
                if ($option->getIsActive()) {
                    switch ($option->getValue()) {
                        case self::TYPE_BUILDINGS_FOR_SALE:
                            $constrains[] = $this->getBuildingForSaleQueryConstrain($query);
                            break;
                        case self::TYPE_BUILDINGS_FOR_RENT:
                            $constrains[] = $this->getBuildingForRentQueryConstrain($query);
                            break;
                        case self::TYPE_LOTS:
                            $constrains[] = $this->getLotsQueryConstrain($query);
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
        }
        return FALSE;
    }

    /**
     * Get Building For Sale Query Constrain
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @return \TYPO3\CMS\Extbase\Persistence\Generic\Qom\LogicalAnd
     */
    protected function getBuildingForSaleQueryConstrain(Query $query) {
        return $query->logicalAnd(
            $query->equals('type', Object::TYPE_BUILDING),
            $query->logicalOr(
                $query->equals('offer', Object::OFFER_SALE),
                $query->equals('offer', Object::OFFER_BOTH)
            )
        );
    }

    /**
     * Get Building For Rent Query Constrain
     *
     * @param Query $query
     * @return \TYPO3\CMS\Extbase\Persistence\Generic\Qom\LogicalAnd
     */
    protected function getBuildingForRentQueryConstrain(Query $query) {
        return $query->logicalAnd(
            $query->equals('type', Object::TYPE_BUILDING),
            $query->logicalOr(
                $query->equals('offer', Object::OFFER_RENT),
                $query->equals('offer', Object::OFFER_BOTH)
            )
        );
    }

    /**
     * Get Lots Query Constrain
     *
     * @param Query $query
     * @return \TYPO3\CMS\Extbase\Persistence\Generic\Qom\ComparisonInterface
     */
    protected function getLotsQueryConstrain(Query $query) {
        return $query->equals('type', Object::TYPE_LOT);
    }

}