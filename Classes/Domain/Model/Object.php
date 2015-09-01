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
 * Object
 */
class Object extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * name
	 * 
	 * @var string
	 */
	protected $name = '';

	/**
	 * type
	 * 
	 * @var integer
	 */
	protected $type = 0;

	/**
	 * sort
	 * 
	 * @var integer
	 */
	protected $sort = 0;

	/**
	 * offer
	 * 
	 * @var integer
	 */
	protected $offer = 0;

	/**
	 * images
	 * 
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $images = NULL;

	/**
	 * year
	 * 
	 * @var integer
	 */
	protected $year = 0;

	/**
	 * environmentalClass
	 * 
	 * @var string
	 */
	protected $environmentalClass = '';

	/**
	 * description
	 * 
	 * @var string
	 */
	protected $description = '';

	/**
	 * street
	 * 
	 * @var string
	 */
	protected $street = '';

	/**
	 * zipCode
	 * 
	 * @var string
	 */
	protected $zipCode = '';

	/**
	 * contact
	 * 
	 * @var string
	 */
	protected $contact = '';

	/**
	 * price
	 * 
	 * @var float
	 */
	protected $price = 0.0;

	/**
	 * rentPrice
	 * 
	 * @var float
	 */
	protected $rentPrice = 0.0;

	/**
	 * rentPriceType
	 * 
	 * @var string
	 */
	protected $rentPriceType = '';

	/**
	 * pricePerSquareMetre
	 * 
	 * @var float
	 */
	protected $pricePerSquareMetre = 0.0;

	/**
	 * lotSize
	 * 
	 * @var string
	 */
	protected $lotSize = '';

	/**
	 * livingArea
	 * 
	 * @var string
	 */
	protected $livingArea = '';

	/**
	 * gardenArea
	 * 
	 * @var string
	 */
	protected $gardenArea = '';

	/**
	 * numberOfRooms
	 * 
	 * @var integer
	 */
	protected $numberOfRooms = 0;

	/**
	 * latitude
	 * 
	 * @var string
	 */
	protected $latitude = '';

	/**
	 * longitude
	 * 
	 * @var string
	 */
	protected $longitude = '';

	/**
	 * latitudeLongitudeMd5
	 * 
	 * @var string
	 */
	protected $latitudeLongitudeMd5 = '';

	/**
	 * category
	 * 
	 * @var \Ucreation\Properties\Domain\Model\Category
	 */
	protected $category = NULL;

	/**
	 * presences
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ucreation\Properties\Domain\Model\Presence>
	 */
	protected $presences = NULL;

	/**
	 * town
	 * 
	 * @var \Ucreation\Properties\Domain\Model\Town
	 */
	protected $town = NULL;

	/**
	 * position
	 * 
	 * @var \Ucreation\Properties\Domain\Model\Position
	 */
	protected $position = NULL;

	/**
	 * constructionType
	 * 
	 * @var \Ucreation\Properties\Domain\Model\ConstructionType
	 */
	protected $constructionType = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 * 
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->presences = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the name
	 * 
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 * 
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the type
	 * 
	 * @return integer $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 * 
	 * @param integer $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns the sort
	 * 
	 * @return integer $sort
	 */
	public function getSort() {
		return $this->sort;
	}

	/**
	 * Sets the sort
	 * 
	 * @param integer $sort
	 * @return void
	 */
	public function setSort($sort) {
		$this->sort = $sort;
	}

	/**
	 * Returns the offer
	 * 
	 * @return integer $offer
	 */
	public function getOffer() {
		return $this->offer;
	}

	/**
	 * Sets the offer
	 * 
	 * @param integer $offer
	 * @return void
	 */
	public function setOffer($offer) {
		$this->offer = $offer;
	}

	/**
	 * Returns the images
	 * 
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * Sets the images
	 * 
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
	 * @return void
	 */
	public function setImages(\TYPO3\CMS\Extbase\Domain\Model\FileReference $images) {
		$this->images = $images;
	}

	/**
	 * Returns the year
	 * 
	 * @return integer $year
	 */
	public function getYear() {
		return $this->year;
	}

	/**
	 * Sets the year
	 * 
	 * @param integer $year
	 * @return void
	 */
	public function setYear($year) {
		$this->year = $year;
	}

	/**
	 * Returns the environmentalClass
	 * 
	 * @return string $environmentalClass
	 */
	public function getEnvironmentalClass() {
		return $this->environmentalClass;
	}

	/**
	 * Sets the environmentalClass
	 * 
	 * @param string $environmentalClass
	 * @return void
	 */
	public function setEnvironmentalClass($environmentalClass) {
		$this->environmentalClass = $environmentalClass;
	}

	/**
	 * Returns the description
	 * 
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 * 
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the street
	 * 
	 * @return string $street
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * Sets the street
	 * 
	 * @param string $street
	 * @return void
	 */
	public function setStreet($street) {
		$this->street = $street;
	}

	/**
	 * Returns the zipCode
	 * 
	 * @return string $zipCode
	 */
	public function getZipCode() {
		return $this->zipCode;
	}

	/**
	 * Sets the zipCode
	 * 
	 * @param string $zipCode
	 * @return void
	 */
	public function setZipCode($zipCode) {
		$this->zipCode = $zipCode;
	}

	/**
	 * Returns the contact
	 * 
	 * @return string $contact
	 */
	public function getContact() {
		return $this->contact;
	}

	/**
	 * Sets the contact
	 * 
	 * @param string $contact
	 * @return void
	 */
	public function setContact($contact) {
		$this->contact = $contact;
	}

	/**
	 * Returns the price
	 * 
	 * @return float $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets the price
	 * 
	 * @param float $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * Returns the rentPrice
	 * 
	 * @return float $rentPrice
	 */
	public function getRentPrice() {
		return $this->rentPrice;
	}

	/**
	 * Sets the rentPrice
	 * 
	 * @param float $rentPrice
	 * @return void
	 */
	public function setRentPrice($rentPrice) {
		$this->rentPrice = $rentPrice;
	}

	/**
	 * Returns the rentPriceType
	 * 
	 * @return string $rentPriceType
	 */
	public function getRentPriceType() {
		return $this->rentPriceType;
	}

	/**
	 * Sets the rentPriceType
	 * 
	 * @param string $rentPriceType
	 * @return void
	 */
	public function setRentPriceType($rentPriceType) {
		$this->rentPriceType = $rentPriceType;
	}

	/**
	 * Returns the pricePerSquareMetre
	 * 
	 * @return float $pricePerSquareMetre
	 */
	public function getPricePerSquareMetre() {
		return $this->pricePerSquareMetre;
	}

	/**
	 * Sets the pricePerSquareMetre
	 * 
	 * @param float $pricePerSquareMetre
	 * @return void
	 */
	public function setPricePerSquareMetre($pricePerSquareMetre) {
		$this->pricePerSquareMetre = $pricePerSquareMetre;
	}

	/**
	 * Returns the lotSize
	 * 
	 * @return string $lotSize
	 */
	public function getLotSize() {
		return $this->lotSize;
	}

	/**
	 * Sets the lotSize
	 * 
	 * @param string $lotSize
	 * @return void
	 */
	public function setLotSize($lotSize) {
		$this->lotSize = $lotSize;
	}

	/**
	 * Returns the livingArea
	 * 
	 * @return string $livingArea
	 */
	public function getLivingArea() {
		return $this->livingArea;
	}

	/**
	 * Sets the livingArea
	 * 
	 * @param string $livingArea
	 * @return void
	 */
	public function setLivingArea($livingArea) {
		$this->livingArea = $livingArea;
	}

	/**
	 * Returns the gardenArea
	 * 
	 * @return string $gardenArea
	 */
	public function getGardenArea() {
		return $this->gardenArea;
	}

	/**
	 * Sets the gardenArea
	 * 
	 * @param string $gardenArea
	 * @return void
	 */
	public function setGardenArea($gardenArea) {
		$this->gardenArea = $gardenArea;
	}

	/**
	 * Returns the numberOfRooms
	 * 
	 * @return integer $numberOfRooms
	 */
	public function getNumberOfRooms() {
		return $this->numberOfRooms;
	}

	/**
	 * Sets the numberOfRooms
	 * 
	 * @param integer $numberOfRooms
	 * @return void
	 */
	public function setNumberOfRooms($numberOfRooms) {
		$this->numberOfRooms = $numberOfRooms;
	}

	/**
	 * Returns the latitude
	 * 
	 * @return string $latitude
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Sets the latitude
	 * 
	 * @param string $latitude
	 * @return void
	 */
	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}

	/**
	 * Returns the longitude
	 * 
	 * @return string $longitude
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * Sets the longitude
	 * 
	 * @param string $longitude
	 * @return void
	 */
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}

	/**
	 * Returns the latitudeLongitudeMd5
	 * 
	 * @return string $latitudeLongitudeMd5
	 */
	public function getLatitudeLongitudeMd5() {
		return $this->latitudeLongitudeMd5;
	}

	/**
	 * Sets the latitudeLongitudeMd5
	 * 
	 * @param string $latitudeLongitudeMd5
	 * @return void
	 */
	public function setLatitudeLongitudeMd5($latitudeLongitudeMd5) {
		$this->latitudeLongitudeMd5 = $latitudeLongitudeMd5;
	}

	/**
	 * Returns the category
	 * 
	 * @return \Ucreation\Properties\Domain\Model\Category $category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets the category
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Category $category
	 * @return void
	 */
	public function setCategory(\Ucreation\Properties\Domain\Model\Category $category) {
		$this->category = $category;
	}

	/**
	 * Adds a Presence
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Presence $presence
	 * @return void
	 */
	public function addPresence(\Ucreation\Properties\Domain\Model\Presence $presence) {
		$this->presences->attach($presence);
	}

	/**
	 * Removes a Presence
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Presence $presenceToRemove The Presence to be removed
	 * @return void
	 */
	public function removePresence(\Ucreation\Properties\Domain\Model\Presence $presenceToRemove) {
		$this->presences->detach($presenceToRemove);
	}

	/**
	 * Returns the presences
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ucreation\Properties\Domain\Model\Presence> $presences
	 */
	public function getPresences() {
		return $this->presences;
	}

	/**
	 * Sets the presences
	 * 
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ucreation\Properties\Domain\Model\Presence> $presences
	 * @return void
	 */
	public function setPresences(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $presences) {
		$this->presences = $presences;
	}

	/**
	 * Returns the town
	 * 
	 * @return \Ucreation\Properties\Domain\Model\Town $town
	 */
	public function getTown() {
		return $this->town;
	}

	/**
	 * Sets the town
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Town $town
	 * @return void
	 */
	public function setTown(\Ucreation\Properties\Domain\Model\Town $town) {
		$this->town = $town;
	}

	/**
	 * Returns the position
	 * 
	 * @return \Ucreation\Properties\Domain\Model\Position $position
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * Sets the position
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Position $position
	 * @return void
	 */
	public function setPosition(\Ucreation\Properties\Domain\Model\Position $position) {
		$this->position = $position;
	}

	/**
	 * Returns the constructionType
	 * 
	 * @return \Ucreation\Properties\Domain\Model\ConstructionType $constructionType
	 */
	public function getConstructionType() {
		return $this->constructionType;
	}

	/**
	 * Sets the constructionType
	 * 
	 * @param \Ucreation\Properties\Domain\Model\ConstructionType $constructionType
	 * @return void
	 */
	public function setConstructionType(\Ucreation\Properties\Domain\Model\ConstructionType $constructionType) {
		$this->constructionType = $constructionType;
	}

}