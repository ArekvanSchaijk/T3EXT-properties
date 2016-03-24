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
		if (($activeTown = $this->objectService->getFilterService()->getFilter(FilterUtility::FILTER_TOWN)->getActiveTown())) {
			if ($this->getUid() == $activeTown) {
				return TRUE;
			}
		}
		if (($activeTowns = $this->objectService->getFilterService()->getFilter(FilterUtility::FILTER_TOWNS)->getActiveTowns())) {
			if (in_array($this->getUid(), $activeTowns)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * Get Is Disabled
	 *
	 * @return bool
	 */
	public function getIsDisabled() {
		return FALSE;
	}

}