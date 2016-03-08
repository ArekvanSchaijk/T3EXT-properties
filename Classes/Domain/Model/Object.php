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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Class Object
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class Object extends AbstractEntity {
	
	/**
	 * @const integer
	 */
	const	TYPE_NONE = 0,	
			TYPE_BUILDING = 1,
			TYPE_LOT = 2;
	
	/**
	 * @const integer
	 */		
	const	TYPE_BUILDING_NONE = 0,
			TYPE_BUILDING_NEW = 1,
			TYPE_BUILDING_EXISTING = 2;

	/**
	 * @const integer
	 */	
	const	OFFER_SALE = 0,
			OFFER_RENT = 1,
			OFFER_BOTH = 2;
			
	/**
	 * @const integer
	 */		
	const	RENT_PRICE_TYPE_BASIC = 0,
			RENT_PRICE_TYPE_ALLINCLUSIVE = 1;
			
	/**
	 * @const integer
	 */
	const	RENT_AVAILABILITY_IMMEDIATELY = 0,
			RENT_AVAILABILITY_WAIT = 1,
			RENT_AVAILABILITY_BYDATE = 2,
			RENT_AVAILABILITY_INCONSULTATION = 3;
			
	/**
	 * @const integer
	 */
	const	RENTAL_AGREEMENT_UNDETERMEDTIME = 0,
			RENTAL_AGREEMENT_TEMPORARYTIME = 1;
		
	/**
	 * @const integer
	 */	
	const	LEASE_CONDITION_PADDED = 1,
			LEASE_CONDITION_FURNISHED = 2;
			
	/**
	 * @const integer
	 */
	const	ACCESSIBILITY_NONE = 0,
			ACCESSIBILITY_CUSTOM = 1,
			ACCESSIBILITY_DISABILITY = 2,
			ACCESSIBILITY_SENIORS = 3;
	
	/**
	 * @const integer
	 */
	const	ENVIRONMENTAL_CLASS_NONE = 0,
			ENVIRONMENTAL_CLASS_A = 10,
			ENVIRONMENTAL_CLASS_B = 20,
			ENVIRONMENTAL_CLASS_C = 30,
			ENVIRONMENTAL_CLASS_D = 40,
			ENVIRONMENTAL_CLASS_E = 50,
			ENVIRONMENTAL_CLASS_F = 60,
			ENVIRONMENTAL_CLASS_G = 70;
		
	/**
	 * @const integer
	 */	
	const	GARDEN_POSITION_NONE = 0,
			GARDEN_POSITION_NORTH = 1,
			GARDEN_POSITION_WEST = 2,
			GARDEN_POSITION_SOUTH = 3,
			GARDEN_POSITION_EAST = 4;
	
	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var integer
	 */
	protected $type = self::TYPE_NONE;
	
	/**
	 * @var integer
	 */
	protected $typeBuilding = self::TYPE_BUILDING_NONE;

	/**
	 * @var integer
	 */
	protected $sort = 0;

	/**
	 * @var integer
	 */
	protected $offer = self::OFFER_SALE;

	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $images = NULL;

	/**
	 * @var integer
	 */
	protected $year = 0;

	/**
	 * @var integer
	 */
	protected $environmentalClass = self::ENVIRONMENTAL_CLASS_NONE;

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
	protected $streetNumber = '';

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
	protected $rentPriceType = self::RENT_PRICE_TYPE_BASIC;

	/**
	 * @var integer
	 */
	protected $rentAvailability = self::RENT_AVAILABILITY_IMMEDIATELY;

	/**
	 * @var integer
	 */
	protected $rentWait = 0;

	/**
	 * @var integer
	 */
	protected $rentAvailableDate = 0;
	
	/**
	 * @var integer
	 */
	protected $rentalAgreement = self::RENTAL_AGREEMENT_UNDETERMEDTIME;
	
	/**
	 * @var integer
	 */
	protected $leaseConditions = 0;
	
	/**
	 * @var integer
	 */
	protected $accessibility = self::ACCESSIBILITY_NONE;

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
	 * @var integer
	 */
	protected $numberOfBedooms = 0;

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
	 * @var integer
	 */
	protected $gardenPosition = self::GARDEN_POSITION_NONE;

	/** 
	 * @var \Ucreation\Properties\Domain\Model\ConstructionType
	 */
	protected $constructionType = NULL;
	
	/** 
	 * @var boolean
	 */
	protected $garage = FALSE;
	
	/**
	 * @var integer
	 */
	protected $garageCapacity = 0;
	
	/** 
	 * @var \Ucreation\Properties\Domain\Model\GarageSort
	 */
	protected $garageSort = NULL;

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
		$this->presences = new ObjectStorage();
	}
	
	/**
	 * Is Sale
	 *
	 * @return boolean
	 */
	public function isSale() {
		if ($this->offer == self::OFFER_SALE || self:: $this->offer == self::OFFER_BOTH) {
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * Is Rent
	 *
	 * @return boolean
	 */
	public function isRent() {
		if ($this->offer == self::OFFER_RENT || self:: $this->offer == self::OFFER_BOTH) {
			return TRUE;
		}
		return FALSE;
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
	 * Get Type Building
	 * 
	 * @return integer
	 */
	public function getTypeBuilding() {
		return $this->typeBuilding;
	}

	/**
	 * Set Type Building
	 * 
	 * @param integer $typeBuilding
	 * @return void
	 */
	public function setTypeBuilding($typeBuilding) {
		$this->typeBuilding = $typeBuilding;
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
	public function setImages(FileReference $images) {
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
	 * @return integer
	 */
	public function getEnvironmentalClass() {
		return $this->environmentalClass;
	}

	/**
	 * Set Environmental Class
	 * 
	 * @param integer $environmentalClass
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
	 * Get Street Number
	 * 
	 * @return string
	 */
	public function getStreetNumber() {
		return $this->street;
	}

	/**
	 * Set Street Number
	 * 
	 * @param string $streetNumber
	 * @return void
	 */
	public function setStreetNumber($streetNumber) {
		$this->streetNumber = $streetNumber;
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
		return floor($this->price);
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
	 * Get Rent Availability
	 *
	 * @return integer
	 */
	public function getRentAvailability() {
		return $this->rentAvailability;
	}
	
	/**
	 * Set Rent Availability
	 *
	 * @param integer $rentAvailability
	 * @return void
	 */
	public function setRentAvailability($rentAvailability) {
		$this->rentAvailability = $rentAvailability;
	}
	
	/**
	 * Get Rent Wait
	 *
	 * @return integer
	 */
	public function getRentWait() {
		return $this->rentWait;	
	}
	
	/**
	 * Set Rent Wait
	 *
	 * @param integer $rentWait
	 * @return void
	 */
	public function setRentWait($rentWait) {
		$this->rentWait = $rentWait;	
	}
	
	/**
	 * Get Rent Available Date
	 *
	 * @return integer
	 */
	public function getRentAvailableDate() {
		return $this->rentAvailableDate;	
	}
	
	/**
	 * Set Rent Available Date
	 *
	 * @param integer $rentAvailableDate
	 * @return void
	 */
	public function setRentAvailableDate($rentAvailableDate) {
		$this->rentAvailableDate = $rentAvailableDate;	
	}
	
	/**
	 * Get Rental Agreement
	 *
	 * @return integer
	 */
	public function getRentalAgreement() {
		return $this->rentalAgreement;	
	}
	
	/**
	 * Set Rental Agreement
	 *
	 * @param integer $rentalAgreement
	 * @return void
	 */
	public function setRentalAgreement($rentalAgreement) {
		$this->rentalAgreement = $rentalAgreement;	
	}
	
	/**
	 * Get Lease Conditions
	 *
	 * @return integer
	 */
	public function getLeaseConditions() {
		return $this->leaseConditions;	
	}
	
	/**
	 * Set Lease Conditions
	 *
	 * @param integer $leaseConditions
	 * @return void
	 */
	public function setLeaseConditions($leaseConditions) {
		$this->leaseConditions = $leaseConditions;	
	}
	
	/**
	 * Get Accessibility
	 *
	 * @return integer
	 */
	public function getAccessibility() {
		return $this->accessibility;	
	}
	
	/**
	 * Set Accessibility
	 *
	 * @param integer $accessibility
	 * @return void
	 */
	public function setAccessibility($accessibility) {
		$this->accessibility = $accessibility;	
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
	 * Get Number Of Bedrooms
	 * 
	 * @return integer
	 */
	public function getNumberOfBedrooms() {
		return $this->numberOfBedrooms;
	}

	/**
	 * Set Number Of Bedrooms
	 * 
	 * @param integer $numberOfBedrooms
	 * @return void
	 */
	public function setNumberOfBedrooms($numberOfBedrooms) {
		$this->numberOfBedrooms = $numberOfBedrooms;
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
	public function setCategory(Category $category) {
		$this->category = $category;
	}

	/**
	 * Add Presence
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Presence $presence
	 * @return void
	 */
	public function addPresence(Presence $presence) {
		$this->presences->attach($presence);
	}

	/**
	 * Remove Presence
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Presence $presenceToRemove The Presence to be removed
	 * @return void
	 */
	public function removePresence(Presence $presenceToRemove) {
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
	public function setPresences(ObjectStorage $presences) {
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
	public function setTown(Town $town) {
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
	public function setPosition(Position $position) {
		$this->position = $position;
	}

	/**
	 * Get Garden Position
	 * 
	 * @return integer
	 */
	public function getGardenPosition() {
		return $this->gardenPosition;
	}

	/**
	 * Set Garden Position
	 * 
	 * @param integer $gardenPosition
	 * @return void
	 */
	public function setGardenPosition($gardenPosition) {
		$this->gardenPosition = $gardenPosition;
	}

	/**
	 * Get Construction Type
	 * 
	 * @return \Ucreation\Properties\Domain\Model\ConstructionType
	 */
	public function getConstructionType() {
		return $this->constructionType;
	}

	/**
	 * Set Construction Type
	 * 
	 * @param \Ucreation\Properties\Domain\Model\ConstructionType $constructionType
	 * @return void
	 */
	public function setConstructionType(ConstructionType $constructionType) {
		$this->constructionType = $constructionType;
	}
	
	/**
	 * Get Garage
	 * 
	 * @return boolean
	 */
	public function getGarage() {
		return $this->garage;
	}

	/**
	 * Set Garage
	 * 
	 * @param boolean $garage
	 * @return void
	 */
	public function setGarage($garage) {
		$this->garage = $garage;
	}
	
	/**
	 * Get Garage Capacity
	 * 
	 * @return boolean
	 */
	public function getGarageCapacity() {
		return $this->garageCapacity;
	}

	/**
	 * Set Garage Capacity
	 * 
	 * @param boolean $garageCapacity
	 * @return void
	 */
	public function setGarageCapacity($garageCapacity) {
		$this->garageCapacity = $garageCapacity;
	}

	/**
	 * Get Garage Sort
	 * 
	 * @return \Ucreation\Properties\Domain\Model\GarageSort
	 */
	public function getGarageSort() {
		return $this->garageSort;
	}

	/**
	 * Set Garage Sort
	 * 
	 * @param \Ucreation\Properties\Domain\Model\GarageSort $garageSort
	 * @return void
	 */
	public function setGarageSort(GarageSort $garageSort) {
		$this->garageSort = $garageSort;
	}

}