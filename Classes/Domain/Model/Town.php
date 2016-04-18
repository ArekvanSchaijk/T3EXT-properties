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
 * Class Town
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class Town extends AbstractModel {

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var string
	 */
	protected $description = '';

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
	 * Get Description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Set Description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
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
			if (($activeTown = $this->getFilterService()->getFilter(FilterUtility::FILTER_TOWN)->getActiveTown())) {
				if ($this->getUid() == $activeTown) {
					$this->isActive = TRUE;
				}
			}
			if (($activeTowns = $this->getFilterService()->getFilter(FilterUtility::FILTER_TOWNS)->getActiveTowns())) {
				if (in_array($this->getUid(), $activeTowns)) {
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
	 * Get Filter Available Objects
	 *
	 * @return int
	 */
	public function getFilterAvailableObjects() {
		if (is_null($this->filterAvailableObjects)) {
			$this->filterAvailableObjects = 0;
			// Query instructions
			$additionalConstrains = array();
			$additionalConstrains[] = AdditionalQueryConstrainsUtility::equals('town', $this->getUid());
			// Get filtered objects count
			$this->filterAvailableObjects = $this->getObjectService()->getFilteredObjects(NULL, NULL, array(FilterUtility::FILTER_TOWN, FilterUtility::FILTER_TOWNS), 0, NULL, $additionalConstrains)->count();
		}
		return $this->filterAvailableObjects;
	}

}