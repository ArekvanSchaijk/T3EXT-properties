<?php
namespace Ucreation\Properties\Filter\Option;

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

use Ucreation\Properties\Filter\StatusFilter;
use Ucreation\Properties\Utility\AdditionalQueryConstrainsUtility;
use Ucreation\Properties\Utility\FilterUtility;

/**
 * Class StatusOption
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class StatusOption extends AbstractOption {

    /**
     * @var int
     */
    protected $value = '';

    /**
     * @var string
     */
    protected $label = '';

    /**
     * @var bool|null
     */
    protected $isActive = NULL;

    /**
     * @var int|null
     */
    protected $filterAvailableObjects = NULL;

    /**
     * Get Value
     *
     * @return int
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Set Value
     *
     * @param int $value
     * @return void
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * Get Label
     *
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Set Label
     *
     * @param string $label
     * @return void
     */
    public function setLabel($label) {
        $this->label = $label;
    }

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if (is_null($this->isActive)) {
            $this->isActive = FALSE;
            if (($statusFilter = $this->getFilterService()->getFilter(FilterUtility::FILTER_STATUS))) {
                if (in_array($this->getValue(), $statusFilter->getActiveStates())) {
                    $this->isActive = TRUE;
                }
            }
        }
        return $this->isActive;
    }

    /**
     * Set Is Active
     *
     * @param bool $isActive
     * @return void
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    /**
     * Get Is Disabled
     *
     * @return bool
     */
    public function getIsDisabled() {
        return ($this->getFilterAvailableObjects() ? FALSE : TRUE);
    }

    /**
     * Get Filter Available Objects
     *
     * @return int
     */
    public function getFilterAvailableObjects() {
        if (is_null($this->filterAvailableObjects)) {
            $this->filterAvailableObjects = 0;
            // Query instructions
            $additionalConstrains = array();
            $additionalConstrains[] = AdditionalQueryConstrainsUtility::equals('status', StatusFilter::getQueryStatusValue($this->getValue()));
            // Get filtered objects count
            $this->filterAvailableObjects = $this->getObjectService()->getFilteredObjects(NULL, NULL, array(FilterUtility::FILTER_STATUS), 0, NULL, $additionalConstrains)->count();
        }
        return $this->filterAvailableObjects;
    }

}