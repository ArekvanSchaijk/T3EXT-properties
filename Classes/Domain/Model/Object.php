<?php
namespace Ucreation\Properties\Domain\Model;

/***************************************************************
 *
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

/**
 * Class Object
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class Object extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var integer
	 */
	protected $type = 0;

	/**
	 * @var integer
	 */
	protected $sort = 0;

	/**
	 * @var integer
	 */
	protected $offer = 0;

	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $images = NULL;

	/**
	 * @var integer
	 */
	protected $year = 0;

	/**
	 * @var string
	 */
	protected $environmentalClass = '';

	/**
	 * @var string
	 */
	protected $description = '';

	/**
	 * @var string
	 */
	protected $street = '';

	/**
	 * @var string
	 */
	protected $zipCode = '';

	/**
	 * @var string
	 */
	protected $contact = '';

	/**
	 * @var float
	 */
	protected $price = 0.0;

	/**
	 * @var float
	 */
	protected $rentPrice = 0.0;

	/**
	 * @var string
	 */
	protected $rentPriceType = '';

	/**
	 * @var float
	 */
	protected $pricePerSquareMetre = 0.0;

	/**
	 * @var string
	 */
	protected $lotSize = '';

	/** 
	 * @var string
	 */
	protected $livingArea = '';

	/**
	 * @var string
	 */
	protected $gardenArea = '';

	/**
	 * @var integer
	 */
	protected $numberOfRooms = 0;

	/**
	 * @var string
	 */
	protected $latitude = '';

	/**
	 * @var string
	 */
	protected $longitude = '';

	/**
	 * @var string
	 */
	protected $latitudeLongitudeMd5 = '';

	/**
	 * @var \Ucreation\Properties\Domain\Model\Category
	 */
	protected $category = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ucreation\Properties\Domain\Model\Presence>
	 */
	protected $presences = NULL;

	/**
	 * @var \Ucreation\Properties\Domain\Model\Town
	 */
	protected $town = NULL;

	/**
	 * @var \Ucreation\Properties\Domain\Model\Position
	 */
	protected $position = NULL;

	/** 
	 * @var \Ucreation\Properties\Domain\Model\ConstructionType
	 */
	protected $constructionType = NULL;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->initStorageObjects();
	}

	/**
	 * Init Storage Objects
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->presences = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

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
	 * Get Type
	 * 
	 * @return integer
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Set Type
	 * 
	 * @param integer $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Get Sort
	 * 
	 * @return integer
	 */
	public function getSort() {
		return $this->sort;
	}

	/**
	 * Set Sort
	 * 
	 * @param integer $sort
	 * @return void
	 */
	public function setSort($sort) {
		$this->sort = $sort;
	}

	/**
	 * Get Offer
	 * 
	 * @return integer
	 */
	public function getOffer() {
		return $this->offer;
	}

	/**
	 * Set Offer
	 * 
	 * @param integer $offer
	 * @return void
	 */
	public function setOffer($offer) {
		$this->offer = $offer;
	}

	/**
	 * Get Images
	 * 
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * Set Images
	 * 
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
	 * @return void
	 */
	public function setImages(\TYPO3\CMS\Extbase\Domain\Model\FileReference $images) {
		$this->images = $images;
	}

	/**
	 * Get Year
	 * 
	 * @return integer
	 */
	public function getYear() {
		return $this->year;
	}

	/**
	 * Set Year
	 * 
	 * @param integer $year
	 * @return void
	 */
	public function setYear($year) {
		$this->year = $year;
	}

	/**
	 * Get Environmental Class
	 * 
	 * @return string
	 */
	public function getEnvironmentalClass() {
		return $this->environmentalClass;
	}

	/**
	 * Set Environmental Class
	 * 
	 * @param string $environmentalClass
	 * @return void
	 */
	public function setEnvironmentalClass($environmentalClass) {
		$this->environmentalClass = $environmentalClass;
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
	 * Get Street
	 * 
	 * @return string
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * Set Street
	 * 
	 * @param string $street
	 * @return void
	 */
	public function setStreet($street) {
		$this->street = $street;
	}

	/**
	 * Get Zip Code
	 * 
	 * @return string
	 */
	public function getZipCode() {
		return $this->zipCode;
	}

	/**
	 * Set Zip Code
	 * 
	 * @param string $zipCode
	 * @return void
	 */
	public function setZipCode($zipCode) {
		$this->zipCode = $zipCode;
	}

	/**
	 * Get Contact
	 * 
	 * @return string
	 */
	public function getContact() {
		return $this->contact;
	}

	/**
	 * Set Contact
	 * 
	 * @param string $contact
	 * @return void
	 */
	public function setContact($contact) {
		$this->contact = $contact;
	}

	/**
	 * Get Price
	 * 
	 * @return float
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Set Price
	 * 
	 * @param float $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * Get Rent Price
	 * 
	 * @return float
	 */
	public function getRentPrice() {
		return $this->rentPrice;
	}

	/**
	 * Set Rent Price
	 * 
	 * @param float $rentPrice
	 * @return void
	 */
	public function setRentPrice($rentPrice) {
		$this->rentPrice = $rentPrice;
	}

	/**
	 * Get Rent Price Type
	 * 
	 * @return string
	 */
	public function getRentPriceType() {
		return $this->rentPriceType;
	}

	/**
	 * Set Rent Price Type
	 * 
	 * @param string $rentPriceType
	 * @return void
	 */
	public function setRentPriceType($rentPriceType) {
		$this->rentPriceType = $rentPriceType;
	}

	/**
	 * Get Price Per Square Metre
	 * 
	 * @return float
	 */
	public function getPricePerSquareMetre() {
		return $this->pricePerSquareMetre;
	}

	/**
	 * Set Price Per Square Metre
	 * 
	 * @param float $pricePerSquareMetre
	 * @return void
	 */
	public function setPricePerSquareMetre($pricePerSquareMetre) {
		$this->pricePerSquareMetre = $pricePerSquareMetre;
	}

	/**
	 * Get Lot Size
	 * 
	 * @return string
	 */
	public function getLotSize() {
		return $this->lotSize;
	}

	/**
	 * Set Lot Size
	 * 
	 * @param string $lotSize
	 * @return void
	 */
	public function setLotSize($lotSize) {
		$this->lotSize = $lotSize;
	}

	/**
	 * Get Living Area
	 * 
	 * @return string
	 */
	public function getLivingArea() {
		return $this->livingArea;
	}

	/**
	 * Set Living Area
	 * 
	 * @param string $livingArea
	 * @return void
	 */
	public function setLivingArea($livingArea) {
		$this->livingArea = $livingArea;
	}

	/**
	 * Get Garden Area
	 * 
	 * @return string
	 */
	public function getGardenArea() {
		return $this->gardenArea;
	}

	/**
	 * Set Garden Area
	 * 
	 * @param string $gardenArea
	 * @return void
	 */
	public function setGardenArea($gardenArea) {
		$this->gardenArea = $gardenArea;
	}

	/**
	 * Get Number Of Rooms
	 * 
	 * @return integer
	 */
	public function getNumberOfRooms() {
		return $this->numberOfRooms;
	}

	/**
	 * Set Number Of Rooms
	 * 
	 * @param integer $numberOfRooms
	 * @return void
	 */
	public function setNumberOfRooms($numberOfRooms) {
		$this->numberOfRooms = $numberOfRooms;
	}

	/**
	 * Get Latitude
	 * 
	 * @return string
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Set Latitude
	 * 
	 * @param string
	 * @return void
	 */
	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}

	/**
	 * Get Longitude
	 * 
	 * @return string
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * Set Longitude
	 * 
	 * @param string $longitude
	 * @return void
	 */
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}

	/**
	 * Get Latitude Longitude Md5
	 * 
	 * @return string
	 */
	public function getLatitudeLongitudeMd5() {
		return $this->latitudeLongitudeMd5;
	}

	/**
	 * Set Latitude Longitude Md5
	 * 
	 * @param string $latitudeLongitudeMd5
	 * @return void
	 */
	public function setLatitudeLongitudeMd5($latitudeLongitudeMd5) {
		$this->latitudeLongitudeMd5 = $latitudeLongitudeMd5;
	}

	/**
	 * Get Category
	 * 
	 * @return \Ucreation\Properties\Domain\Model\Category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Set Category
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Category $category
	 * @return void
	 */
	public function setCategory(\Ucreation\Properties\Domain\Model\Category $category) {
		$this->category = $category;
	}

	/**
	 * Add Presence
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Presence $presence
	 * @return void
	 */
	public function addPresence(\Ucreation\Properties\Domain\Model\Presence $presence) {
		$this->presences->attach($presence);
	}

	/**
	 * Remove Presence
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Presence $presenceToRemove The Presence to be removed
	 * @return void
	 */
	public function removePresence(\Ucreation\Properties\Domain\Model\Presence $presenceToRemove) {
		$this->presences->detach($presenceToRemove);
	}

	/**
	 * Get Presences
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ucreation\Properties\Domain\Model\Presence>
	 */
	public function getPresences() {
		return $this->presences;
	}

	/**
	 * Set Presences
	 * 
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ucreation\Properties\Domain\Model\Presence> $presences
	 * @return void
	 */
	public function setPresences(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $presences) {
		$this->presences = $presences;
	}

	/**
	 * Get Town
	 * 
	 * @return \Ucreation\Properties\Domain\Model\Town
	 */
	public function getTown() {
		return $this->town;
	}

	/**
	 * Set Town
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Town $town
	 * @return void
	 */
	public function setTown(\Ucreation\Properties\Domain\Model\Town $town) {
		$this->town = $town;
	}

	/**
	 * Get Position
	 * 
	 * @return \Ucreation\Properties\Domain\Model\Position
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * Set Position
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Position $position
	 * @return void
	 */
	public function setPosition(\Ucreation\Properties\Domain\Model\Position $position) {
		$this->position = $position;
	}

	/**
	 * Get ConstructionType
	 * 
	 * @return \Ucreation\Properties\Domain\Model\ConstructionType
	 */
	public function getConstructionType() {
		return $this->constructionType;
	}

	/**
	 * Set ConstructionType
	 * 
	 * @param \Ucreation\Properties\Domain\Model\ConstructionType $constructionType
	 * @return void
	 */
	public function setConstructionType(\Ucreation\Properties\Domain\Model\ConstructionType $constructionType) {
		$this->constructionType = $constructionType;
	}

}