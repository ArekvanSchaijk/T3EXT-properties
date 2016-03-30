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
	protected $disableFilterType = FALSE;

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
	protected $disableFilterPriceRange = FALSE;

	/**
	 * @var bool
	 */
	protected $disableFilterPresences = FALSE;

	/**
	 * @var bool
	 */
	protected $disableFilterLotSize = FALSE;

	/**
	 * @var bool
	 */
	protected $disableFilterPosition = FALSE;

	/**
	 * @var bool
	 */
	protected $disableFilterConstructionType = FALSE;

	/**
	 * @var bool
	 */
	protected $disableFilterStatus = FALSE;

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
		if (($activeCategoryId = $this->getObjectService()->getActiveCategoryId())) {
			if ($activeCategoryId == $this->getUid()) {
				return TRUE;
			}
		}
		return FALSE;
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
	 * Get Disable Filter Type
	 *
	 * @return bool
	 */
	public function getDisableFilterType() {
		return $this->disableFilterType;
	}

	/**
	 * Is Disable Filter Type
	 *
	 * @return bool
	 */
	public function isDisableFilterType() {
		return $this->getDisableFilterType();
	}

	/**
	 * Set Disable Filter Type
	 *
	 * @param bool $disableFilterType
	 * @return void
	 */
	public function setDisableFilterType($disableFilterType) {
		$this->disableFilterType = $disableFilterType;
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
	 * Get Disable Filter Price Range
	 *
	 * @return bool
	 */
	public function getDisableFilterPriceRange() {
		return $this->disableFilterPriceRange;
	}

	/**
	 * Is Disable Filter Price Range
	 *
	 * @return bool
	 */
	public function isDisableFilterPriceRange() {
		return $this->getDisableFilterPriceRange();
	}

	/**
	 * Set Disable Filter Price Range
	 *
	 * @param bool $disableFilterPriceRange
	 * @return void
	 */
	public function setDisableFilterPriceRange($disableFilterPriceRange) {
		$this->disableFilterPriceRange = $disableFilterPriceRange;
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

	/**
	 * Get Disable Filter Lot Size
	 *
	 * @return bool
	 */
	public function getDisableFilterLotSize() {
		return $this->disableFilterLotSize;
	}

	/**
	 * Is Disable Filter Lot Size
	 *
	 * @return bool
	 */
	public function isDisableFilterLotSize() {
		return $this->getDisableFilterLotSize();
	}

	/**
	 * Set Disable Filter Lot Size
	 *
	 * @param bool $disableFilterLotSize
	 * @return void
	 */
	public function setDisableFilterLotSize($disableFilterLotSize) {
		$this->disableFilterLotSize = $disableFilterLotSize;
	}

	/**
	 * Get Disable Filter Position
	 *
	 * @return bool
	 */
	public function getDisableFilterPosition() {
		return $this->disableFilterPosition;
	}

	/**
	 * Is Disable Filter Position
	 *
	 * @return bool
	 */
	public function isDisableFilterPosition() {
		return $this->getDisableFilterPosition();
	}

	/**
	 * Set Disable Filter Position
	 *
	 * @param bool $disableFilterPosition
	 * @return void
	 */
	public function setDisableFilterPosition($disableFilterPosition) {
		$this->disableFilterPosition = $disableFilterPosition;
	}

	/**
	 * Get Disable Filter Construction Type
	 *
	 * @return bool
	 */
	public function getDisableFilterConstructionType() {
		return $this->disableFilterConstructionType;
	}

	/**
	 * Is Disable Filter Construction Type
	 *
	 * @return bool
	 */
	public function isDisableFilterConstructionType() {
		return $this->getDisableFilterConstructionType();
	}

	/**
	 * Set Disable Filter Construction Type
	 *
	 * @param bool $disableFilterConstructionType
	 * @return void
	 */
	public function setDisableFilterConstructionType($disableFilterConstructionType) {
		$this->disableFilterConstructionType = $disableFilterConstructionType;
	}

	/**
	 * Get Disable Filter Status
	 *
	 * @return bool
	 */
	public function getDisableFilterStatus() {
		return $this->disableFilterStatus;
	}

	/**
	 * Is Disable Filter Status
	 *
	 * @return bool
	 */
	public function isDisableFilterStatus() {
		return $this->getDisableFilterStatus();
	}

	/**
	 * Set Disable Filter Status
	 *
	 * @param bool $disableFilterStatus
	 * @return void
	 */
	public function setDisableFilterStatus($disableFilterStatus) {
		$this->disableFilterStatus = $disableFilterStatus;
	}

}