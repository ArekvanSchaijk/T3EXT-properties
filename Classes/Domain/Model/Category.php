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

use Ucreation\Properties\Utility\LinkUtility;

/**
 * Class Category
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class Category extends AbstractModel {

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var bool
	 */
	protected $isActive = FALSE;

	/**
	 * @var array
	 */
	protected $linkArguments = array();

	/**
	 * @var bool
	 */
	protected $disableFilterOffer = FALSE;

	/**
	 * @var bool
	 */
	protected $disableFilterTown = FALSE;

	/**
	 * @var bool
	 */
	protected $disableFilterTowns = FALSE;

	/**
	 * @var bool
	 */
	protected $disableFilterPrice = FALSE;

	/**
	 * @var bool
	 */
	protected $disableFilterSurface = FALSE;

	/**
	 * @var bool
	 */
	protected $disableFilterPresences = FALSE;

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
		return $this->getObjectService()->isCategoryActive($this);
	}

	/**
	 * Get Link Arguments
	 *
	 * @return array
	 */
	public function getLinkArguments() {
		return array(
			LinkUtility::CATEGORY => $this->getUid()
		);
	}

	/**
	 * Get Disable Filter Offer
	 *
	 * @return bool
	 */
	public function getDisableFilterOffer() {
		return $this->disableFilterOffer;
	}

	/**
	 * Is Disable Filter Offer
	 *
	 * @return bool
	 */
	public function isDisableFilterOffer() {
		return $this->getDisableFilterOffer();
	}

	/**
	 * Set Disable Filter Offer
	 *
	 * @param bool $disableFilterOffer
	 * @return void
	 */
	public function setDisableFilterOffer($disableFilterOffer) {
		$this->disableFilterOffer = $disableFilterOffer;
	}

	/**
	 * Get Disable Filter Town
	 *
	 * @return bool
	 */
	public function getDisableFilterTown() {
		return $this->disableFilterTown;
	}

	/**
	 * Is Disable Filter Town
	 *
	 * @return bool
	 */
	public function isDisableFilterTown() {
		return $this->getDisableFilterTown();
	}

	/**
	 * Disable Filter Town
	 *
	 * @param bool $disableFilterTown
	 * @return void
	 */
	public function setDisableFilterTown($disableFilterTown) {
		$this->disableFilterTown = $disableFilterTown;
	}

	/**
	 * Get Disable Filter Towns
	 *
	 * @return bool
	 */
	public function getDisableFilterTowns() {
		return $this->disableFilterTowns;
	}

	/**
	 * Is Disable Filter Towns
	 *
	 * @return bool
	 */
	public function isDisableFilterTowns() {
		return $this->getDisableFilterTowns();
	}

	/**
	 * Set Disable Filter Towns
	 *
	 * @param bool $disableFilterTowns
	 * @return void
	 */
	public function setDisableFilterTowns($disableFilterTowns) {
		$this->disableFilterTowns = $disableFilterTowns;
	}

	/**
	 * Get Disable Filter Price
	 *
	 * @return bool
	 */
	public function getDisableFilterPrice() {
		return $this->disableFilterPrice;
	}

	/**
	 * Is Disable Filter Price
	 *
	 * @return bool
	 */
	public function isDisableFilterPrice() {
		return $this->getDisableFilterPrice();
	}

	/**
	 * Set Disable Filter Price
	 *
	 * @param bool $disableFilterPrice
	 * @return void
	 */
	public function setDisableFilterPrice($disableFilterPrice) {
		$this->disableFilterPrice = $disableFilterPrice;
	}

	/**
	 * Get Disable Filter Presences
	 *
	 * @return bool
	 */
	public function getDisableFilterPresences() {
		return $this->disableFilterPresences;
	}

	/**
	 * Is Disable Filter Presences
	 */
	public function isDisableFilterPresences() {
		return $this->getDisableFilterPresences();
	}

	/**
	 * Set Disable Filter Presences
	 *
	 * @param bool $disableFilterPresences
	 * @return void
	 */
	public function setDisableFilterPresences($disableFilterPresences) {
		$this->disableFilterPresences = $disableFilterPresences;
	}

}