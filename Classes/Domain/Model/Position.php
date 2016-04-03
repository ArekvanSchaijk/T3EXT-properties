<?php
namespace Ucreation\Properties\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Arek van Schaijk <info@ucreation.nl>, Ucreation
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
use Ucreation\Properties\Utility\AdditionalQueryConstrainsUtility;
use Ucreation\Properties\Utility\FilterUtility;

/**
 * Class Position
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class Position extends AbstractModel {

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var bool
	 */
	protected $disableFilterOption = FALSE;

	/**
	 * @var bool|null
	 */
	protected $isActive = NULL;

	/**
	 * @var int|null
	 */
	protected $filterAvailableObjects = NULL;

	/**
	 * Get Name
	 * 
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set Name
	 * 
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get Disable Filter Option
	 *
	 * @return bool
	 */
	public function getDisableFilterOption() {
		return $this->disableFilterOption;
	}

	/**
	 * Set Disable Filter Option
	 *
	 * @param bool $disableFilterOption
	 * @return void
	 */
	public function setDisableFilterOption($disableFilterOption) {
		$this->disableFilterOption = $disableFilterOption;
	}

	/**
	 * Get Is Active
	 *
	 * @return bool
	 */
	public function getIsActive() {
		if (is_null($this->isActive)) {
			$this->isActive = FALSE;
			if (($positionsFilter = $this->getFilterService()->getFilter(FilterUtility::FILTER_POSITIONS))) {
				if (in_array($this->getUid(), $positionsFilter->getActivePositions())) {
					$this->isActive = TRUE;
				}
			}
		}
		return $this->isActive;
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
	 * Get Count Available Objects
	 *
	 * @return int
	 */
	public function getFilterAvailableObjects() {
		if (is_null($this->filterAvailableObjects)) {
			$this->filterAvailableObjects = 0;
			// Query instructions
			$additionalConstrains = array();
			$additionalConstrains[] = AdditionalQueryConstrainsUtility::equals('position', $this->getUid());
			// Get filtered objects count
			$this->filterAvailableObjects = $this->getObjectService()->getFilteredObjects(NULL, NULL, array(FilterUtility::FILTER_POSITIONS), 0, NULL, $additionalConstrains)->count();
		}
		return $this->filterAvailableObjects;
	}

}