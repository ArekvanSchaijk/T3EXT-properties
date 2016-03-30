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

use Ucreation\Properties\Filter\TypeFilter;
use Ucreation\Properties\Utility\FilterUtility;

/**
 * Class Presence
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class Presence extends AbstractModel {

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var bool
	 */
	protected $isActive = FALSE;

	/**
	 * @var bool
	 */
	protected $isDisabled = FALSE;

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
	 * Get Is Active
	 *
	 * @return bool
	 */
	public function getIsActive() {
		if (($activePresences = $this->getFilterService()->getFilter(FilterUtility::FILTER_PRESENCES)->getActivePresences())) {
			if (in_array($this->getUid(), $activePresences)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * Get Count Available Objects
	 *
	 * @return int
	 */
	public function getFilterAvailableObjects() {
		if (is_null($this->filterAvailableObjects)) {
			$this->filterAvailableObjects = 0;
			// Gets the current presence filter
			if (($presenceFilter = $this->getFilterService()->getFilter(FilterUtility::FILTER_PRESENCES))) {
				// Checks if the current presences filter is active (otherwise we just don't do anything since this filter can't be active)
				if ($presenceFilter->getIsActive()) {
					// Creates a new presence filter
					$newPresenceFilter = clone $presenceFilter;
					$newPresenceFilter->setActivePresence($this->getUid());
					// Creates a new type filter
					$newTypeFilter = $this->getFilterService()->createNewFilter(FilterUtility::FILTER_TYPE);
					$newTypeFilter->setActiveType(TypeFilter::TYPE_BUILDING);
					// Filter overrides
					$overrides = array(
						FilterUtility::FILTER_PRESENCES => $newPresenceFilter,
						FilterUtility::FILTER_TYPE => $newTypeFilter,
					);
					$this->filterAvailableObjects = $this->getObjectService()->getFilteredObjects(NULL, $overrides)->count();
				}
			}
		}
		return $this->filterAvailableObjects;
	}

	/**
	 * Get Is Disabled
	 *
	 * @return bool
	 */
	public function getIsDisabled() {
		return ($this->getFilterAvailableObjects() ? FALSE : TRUE);
	}

}