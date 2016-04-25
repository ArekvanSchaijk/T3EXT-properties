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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Class Object
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class Object extends AbstractModel {
	
	/**
	 * @const int
	 */
	const	TYPE_NONE = 0,	
			TYPE_BUILDING = 1,
			TYPE_LOT = 2;

	/**
	 * @const int
	 */
	const	STATUS_AVAILABLE = 0,
			STATUS_SOLD = 1,
			STATUS_LEASED = 2,
			STATUS_NOT_AVAILABLE = 3,
			STATUS_RESERVED = 4;
	
	/**
	 * @const int
	 */		
	const	TYPE_BUILDING_NONE = 0,
			TYPE_BUILDING_NEW = 1,
			TYPE_BUILDING_EXISTING = 2;

	/**
	 * @const int
	 */	
	const	OFFER_SALE = 0,
			OFFER_RENT = 1,
			OFFER_BOTH = 2;

	/**
	 * @const int
	 */
	const	PRICE_TYPE_KK = 0,
			PRICE_TYPE_VON = 1;

	/**
	 * @const int
	 */		
	const	RENT_PRICE_TYPE_BASIC = 0,
			RENT_PRICE_TYPE_ALLINCLUSIVE = 1;
			
	/**
	 * @const int
	 */
	const	RENT_AVAILABILITY_IMMEDIATELY = 0,
			RENT_AVAILABILITY_WAIT = 1,
			RENT_AVAILABILITY_BYDATE = 2,
			RENT_AVAILABILITY_INCONSULTATION = 3;
			
	/**
	 * @const int
	 */
	const	RENTAL_AGREEMENT_UNDETERMEDTIME = 0,
			RENTAL_AGREEMENT_TEMPORARYTIME = 1;
		
	/**
	 * @const int
	 */	
	const	LEASE_CONDITION_PADDED = 1,
			LEASE_CONDITION_FURNISHED = 2;
			
	/**
	 * @const int
	 */
	const	ACCESSIBILITY_NONE = 0,
			ACCESSIBILITY_CUSTOM = 1,
			ACCESSIBILITY_DISABILITY = 2,
			ACCESSIBILITY_SENIORS = 3;
	
	/**
	 * @const int
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
	 * @const int
	 */
	const	GARDEN_POSITION_NONE = 0,
			GARDEN_POSITION_NORTH = 1,
			GARDEN_POSITION_WEST = 2,
			GARDEN_POSITION_SOUTH = 3,
			GARDEN_POSITION_EAST = 4;

	/**
	 * @var string
	 */
	static protected $extensionName = 'Properties';

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
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	protected $images = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $backgroundImage = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $download = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $cover = NULL;

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
	protected $alternativeDescription = '';

	/**
	 * @var string
	 */
	protected $possibilities = '';

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
	protected $country = '';

	/**
	 * @var bool
	 */
	protected $useExistingContact = FALSE;

	/**
	 * @var \Ucreation\Properties\Domain\Model\Contact
	 */
	protected $contact = NULL;

	/**
	 * @var \Ucreation\Properties\Domain\Model\Contact|bool|null
	 */
	protected $contactDetails = FALSE;

	/**
	 * @var string
	 */
	protected $contactName = '';

	/**
	 * @var string
	 */
	protected $contactCompany = '';

	/**
	 * @var string
	 */
	protected $contactAddress = '';

	/**
	 * @var string
	 */
	protected $contactPhone = '';

	/**
	 * @var string
	 */
	protected $contactSecondaryPhone = '';

	/**
	 * @var string
	 */
	protected $contactEmail = '';

	/**
	 * @var string
	 */
	protected $contactWebsite = '';

	/**
	 * @var int
	 */
	protected $status = self::STATUS_AVAILABLE;

	/**
	 * @var int
	 */
	protected $price = 0;

	/**
	 * @var int
	 */
	protected $priceType = self::PRICE_TYPE_KK;

	/**
	 * @var int
	 */
	protected $rentPrice = 0;

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
	protected $numberOfBedrooms = 0;

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
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ucreation\Properties\Domain\Model\Object>
	 */
	protected $relatedObjects = NULL;

	/**
	 * @var \Ucreation\Properties\Domain\Model\Town
	 */
	protected $town = NULL;

	/**
	 * @var \Ucreation\Properties\Domain\Model\District
	 */
	protected $district = NULL;

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
	 * @var string
	 */
	protected $metaDescription = '';

	/**
	 * @var string
	 */
	protected $metaKeywords = '';

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 * @inject
	 */
	protected $objectManager = NULL;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->initStorageObjects();
	}

	/**
	 * Get Image Service
	 *
	 * @return \Ucreation\SiteEssentials\Service\ImageService
	 */
	public function getImageService() {
		return $this->objectManager->get('Ucreation\\SiteEssentials\\Service\\ImageService');
	}

	/**
	 * Init Storage Objects
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->presences = new ObjectStorage();
		$this->relatedObjects = new ObjectStorage();
		$this->images = new ObjectStorage();
	}
	
	/**
	 * Get Is Sale
	 *
	 * @return boolean
	 */
	public function getIsSale() {
		if ($this->getOffer() == self::OFFER_SALE || $this->getOffer() == self::OFFER_BOTH) {
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * Get Is Rent
	 *
	 * @return boolean
	 */
	public function getIsRent() {
		if (
			$this->getType() == self::TYPE_BUILDING &&
			(
				$this->getOffer() == self::OFFER_RENT ||
				$this->getOffer() == self::OFFER_BOTH
			)
		) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Get Is Sale And Rent
	 *
	 * @return void
	 */
	public function getIsSaleAndRent() {
		if ($this->getIsSale() && $this->getIsRent()) {
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
	 * Get Is Building
	 *
	 * @return bool
	 */
	public function getIsBuilding() {
		if ($this->getType() == self::TYPE_BUILDING) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Get Is Lot
	 *
	 * @return bool
	 */
	public function getIsLot() {
		if ($this->getType() == self::TYPE_LOT) {
			return TRUE;
		}
		return FALSE;
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
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * Set Images
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 * @return void
	 */
	public function setImages(ObjectStorage $images) {
		$this->images = $images;
	}

	/**
	 * Get Cover
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getCover() {
		if (is_null($this->cover)) {
			if ($this->getImages()) {
				foreach ($this->getImages() as $image) {
					$this->cover = $image;
					break;
				}
			}
		}
		return $this->cover;
	}

	/**
	 * Get Background Image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getBackgroundImage() {
		if (
			(bool)$this->getObjectService()->settings['object']['backgroundImage']['useObjectCoverIfNoBackgroundImageIsSet'] &&
			!$this->backgroundImage
		) {
			return $this->getCover();
		}
		return $this->backgroundImage;
	}

	/**
	 * Get Background Image CSS Class
	 *
	 * @return string|null
	 */
	public function getBackgroundImageCssClass() {
		if (($backgroundImage = $this->getBackgroundImage())) {
			if (ExtensionManagementUtility::isLoaded('site_essentials')) {
				$className = 'properties-object-' . $this->getUid() . '-background';
				$this->getImageService()
					->setImage($backgroundImage)
					->setImageSettings(
						$this->getObjectService()->settings['object']['backgroundImage']
					)
					->process()
					->writeInCss('.'.$className);
				return chr(32).$className;
			}
		}
		return NULL;
	}

	/**
	 * Set Background Image
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $backgroundImage
	 * @return void
	 */
	public function setBackgroundImage(FileReference $backgroundImage) {
		$this->backgroundImage = $backgroundImage;
	}

	/**
	 * Get Download
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getDownload() {
		return $this->download;
	}

	/**
	 * Set Download
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $download
	 * @return void
	 */
	public function setDownload(FileReference $download) {
		$this->download = $download;
	}

	/**
	 * Get Year
	 * 
	 * @return integer
	 */
	public function getYear() {
		if ($this->getIsBuilding()) {
			return $this->year;
		}
		return NULL;
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
		if ($this->getIsBuilding()) {
			return $this->environmentalClass;
		}
		return NULL;
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
	 * Get Alternative Description
	 *
	 * @return string
	 */
	public function getAlternativeDescription() {
		return $this->alternativeDescription;
	}

	/**
	 * Set Alternative Description
	 *
	 * @param string $alternativeDescription
	 * @return void
	 */
	public function setAlternativeDescription($alternativeDescription) {
		$this->alternativeDescription = $alternativeDescription;
	}

	/**
	 * Get Possibilities
	 *
	 * @return string
	 */
	public function getPossibilities() {
		return $this->possibilities;
	}

	/**
	 * Set Possibilities
	 *
	 * @param string $possibilities
	 * @return void
	 */
	public function setPossibilities($possibilities) {
		$this->possibilities = $possibilities;
	}

	/**
	 * Get Street
	 * 
	 * @return string
	 */
	public function getStreet() {
		if ($this->getIsBuilding()) {
			return $this->street;
		}
		return NULL;
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
		if ($this->getIsBuilding()) {
			return $this->streetNumber;
		}
		return NULL;
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
		if ($this->getIsBuilding()) {
			return $this->zipCode;
		}
		return NULL;
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
	 * Get Country
	 *
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Set Country
	 *
	 * @param string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Get Use Existing Contact
	 *
	 * @return bool
	 */
	public function getUseExistingContact() {
		return $this->useExistingContact;
	}

	/**
	 * Set Use Existing Contact
	 *
	 * @param bool $useExistingContact
	 * @return void
	 */
	public function setUseExistingContact($useExistingContact) {
		$this->useExistingContact = $useExistingContact;
	}

	/**
	 * Get Contact
	 * 
	 * @return \Ucreation\Properties\Domain\Model\Contact
	 */
	public function getContact() {
		return $this->contact;
	}

	/**
	 * Set Contact
	 *
	 * @param \Ucreation\Properties\Domain\Model\Contact $contact
	 * @return void
	 */
	public function setContact(Contact $contact) {
		$this->contact = $contact;
	}

	/**
	 * Get Contact Details
	 *
	 * @return \Ucreation\Properties\Domain\Model\Contact|null
	 */
	public function getContactDetails() {
		if ($this->contactDetails === FALSE) {
			if ($this->getUseExistingContact()) {
				$this->contactDetails = $this->getContact();
			} else {
				$contact = NULL;
				if (
					$this->getContactName() ||
					$this->getContactCompany() ||
					$this->getContactAddress() ||
					$this->getContactPhone() ||
					$this->getContactSecondaryPhone() ||
					$this->getContactEmail() ||
					$this->getContactWebsite()
				) {
					$contact = $this->objectManager->get('Ucreation\\Properties\\Domain\\Model\\Contact');
					$contact->setName($this->getContactName());
					$contact->setCompany($this->getContactCompany());
					$contact->setAddress($this->getContactAddress());
					$contact->setPhone($this->getContactPhone());
					$contact->setSecondaryPhone($this->getContactSecondaryPhone());
					$contact->setEmail($this->getContactEmail());
					$contact->setWebsite($this->getContactWebsite());
				}
				$this->contactDetails = $contact;
			}
		}
		return $this->contactDetails;
	}

	/**
	 * Get Contact Name
	 *
	 * @return string
	 */
	public function getContactName() {
		return $this->contactName;
	}

	/**
	 * Get Contact Company
	 *
	 * @return string
	 */
	public function getContactCompany() {
		return $this->contactCompany;
	}

	/**
	 * Get Contact Address
	 *
	 * @return string
	 */
	public function getContactAddress() {
		return $this->contactAddress;
	}

	/**
	 * Get Contact Phone
	 *
	 * @return string
	 */
	public function getContactPhone() {
		return $this->contactPhone;
	}

	/**
	 * Get Contact Secondary Phone
	 *
	 * @return string
	 */
	public function getContactSecondaryPhone() {
		return $this->contactSecondaryPhone;
	}

	/**
	 * Get Contact Email
	 *
	 * @return string
	 */
	public function getContactEmail() {
		return $this->contactEmail;
	}

	/**
	 * Get Contact Website
	 *
	 * @return string
	 */
	public function getContactWebsite() {
		return $this->contactWebsite;
	}

	/**
	 * Get Status
	 *
	 * @return int
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Set Status
	 *
	 * @param int $status
	 * @return void
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * Get Is Available
	 *
	 * @return bool
	 */
	public function getIsAvailable() {
		if ($this->getStatus() == self::STATUS_AVAILABLE) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Get Is Sold
	 *
	 * @return bool
	 */
	public function getIsSold() {
		if ($this->getStatus() == self::STATUS_SOLD) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Get Is Leased
	 *
	 * @return bool
	 */
	public function getIsLeased() {
		if ($this->getStatus() == self::STATUS_LEASED) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Get Is Not Available
	 *
	 * @return bool
	 */
	public function getIsNotAvailable() {
		if ($this->getStatus() == self::STATUS_NOT_AVAILABLE) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Get Is Reserved
	 *
	 * @return bool
	 */
	public function getIsReserved() {
		if ($this->getStatus() == self::STATUS_RESERVED) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Get Status Label
	 *
	 * @return string
	 */
	public function getStatusLabel() {
		switch ($this->getStatus()) {
			case self::STATUS_AVAILABLE:
				return LocalizationUtility::translate('object.status.label.available', self::$extensionName);
			case self::STATUS_SOLD:
				return LocalizationUtility::translate('object.status.label.sold', self::$extensionName);
			case self::STATUS_LEASED:
				return LocalizationUtility::translate('object.status.label.leased', self::$extensionName);
			case self::STATUS_NOT_AVAILABLE:
				return LocalizationUtility::translate('object.status.label.not_available', self::$extensionName);
			case self::STATUS_RESERVED:
				return LocalizationUtility::translate('object.status.label.reserved', self::$extensionName);

		}
	}

	/**
	 * Get Price
	 * 
	 * @return int
	 */
	public function getPrice() {
		if ($this->getIsSale()) {
			return $this->price;
		}
		return NULL;
	}

	/**
	 * Set Price
	 * 
	 * @param int $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * Get Price Type
	 *
	 * @return int
	 */
	public function getPriceType() {
		return $this->priceType;
	}

	/**
	 * Set Price Type
	 *
	 * @param int $priceType
	 * @return void
	 */
	public function setPriceType($priceType) {
		$this->priceType = $priceType;
	}

	/**
	 * Get Rent Price
	 * 
	 * @return int
	 */
	public function getRentPrice() {
		if ($this->getIsRent()) {
			return $this->rentPrice;
		}
		return NULL;
	}

	/**
	 * Set Rent Price
	 * 
	 * @param int $rentPrice
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
		if ($this->getIsRent()) {
			return $this->rentPriceType;
		}
		return NULL;
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
		if ($this->getIsRent()) {
			return $this->rentAvailability;
		}
		return NULL;
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
		if ($this->getIsRent() && $this->getRentAvailability() == self::RENT_AVAILABILITY_WAIT) {
			return $this->rentWait;
		}
		return NULL;
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
		if ($this->getIsRent() && $this->getRentAvailability() == self::RENT_AVAILABILITY_BYDATE) {
			return $this->rentAvailableDate;
		}
		return NULL;
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
		if ($this->getIsRent()) {
			return $this->rentalAgreement;
		}
		return NULL;
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
		if ($this->getIsRent()) {
			return $this->leaseConditions;
		}
		return NULL;
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
		if ($this->getIsBuilding()) {
			return $this->accessibility;
		}
		return NULL;
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
	 * @return int
	 */
	public function getPricePerSquareMetre() {
		if ($this->getIsSale()) {
			return $this->pricePerSquareMetre;
		}
		return NULL;
	}

	/**
	 * Set Price Per Square Metre
	 * 
	 * @param int $pricePerSquareMetre
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
		if ($this->getIsBuilding()) {
			return $this->livingArea;
		}
		return NULL;
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
		if ($this->getIsBuilding()) {
			return $this->gardenArea;
		}
		return NULL;
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
		if ($this->getIsBuilding()) {
			return $this->numberOfRooms;
		}
		return NULL;
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
		if ($this->getIsBuilding()) {
			return $this->numberOfBedrooms;
		}
		return NULL;
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
		if ($this->getIsBuilding()) {
			return $this->presences;
		}
		return NULL;
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
	 * Add Related Object
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $relatedObject
	 * @return void
	 */
	public function addRelatedObject(Object $relatedObject) {
		$this->relatedObjects->attach($relatedObject);
	}

	/**
	 * Remove Related Object
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $relatedObject
	 * @return void
	 */
	public function removeRelatedObject(Object $relatedObject) {
		$this->relatedObjects->detach($relatedObject);
	}

	/**
	 * Get Related Objects
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ucreation\Properties\Domain\Model\Object>
	 */
	public function getRelatedObjects() {
		return $this->relatedObjects;
	}

	/**
	 * Set Related Objects
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ucreation\Properties\Domain\Model\Object> $relatedObjects
	 * @return void
	 */
	public function setRelatedObjects(ObjectStorage $relatedObjects) {
		$this->relatedObjects = $relatedObjects;
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
	 * Get District
	 *
	 * @return \Ucreation\Properties\Domain\Model\District
	 */
	public function getDistrict() {
		return $this->district;
	}

	/**
	 * Set District
	 *
	 * @param \Ucreation\Properties\Domain\Model\District $district
	 * @return void
	 */
	public function setDistrict(District $district) {
		$this->district = $district;
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
		if ($this->getIsBuilding()) {
			return $this->gardenPosition;
		}
		return NULL;
	}

	/**
	 * Set Garden Position
	 * 
	 * @param int $gardenPosition
	 * @return void
	 */
	public function setGardenPosition($gardenPosition) {
		$this->gardenPosition = $gardenPosition;
	}

	/**
	 * Get Garden Position Label
	 *
	 * @return string
	 */
	public function getGardenPositionLabel() {
		if (($position = $this->getGardenPosition())) {
			switch ($position) {
				case self::GARDEN_POSITION_NORTH:
					return LocalizationUtility::translate('object.garden_position.label.north', self::$extensionName);
				case self::GARDEN_POSITION_WEST:
					return LocalizationUtility::translate('object.garden_position.label.west', self::$extensionName);
				case self::GARDEN_POSITION_SOUTH:
					return LocalizationUtility::translate('object.garden_position.label.south', self::$extensionName);
				case self::GARDEN_POSITION_EAST:
					return LocalizationUtility::translate('object.garden_position.label.east', self::$extensionName);
			}
		}
		return NULL;
	}

	/**
	 * Get Construction Type
	 * 
	 * @return \Ucreation\Properties\Domain\Model\ConstructionType
	 */
	public function getConstructionType() {
		if ($this->getIsBuilding()) {
			return $this->constructionType;
		}
		return NULL;
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
		if ($this->getGarage()) {
			return $this->garageCapacity;
		}
		return NULL;
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
		if ($this->getGarage()) {
			return $this->garageSort;
		}
		return NULL;
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

	/**
	 * Get Meta Description
	 *
	 * @return string
	 */
	public function getMetaDescription() {
		return $this->metaDescription;
	}

	/**
	 * Set Meta Description
	 *
	 * @param string $metaDescription
	 * @return void
	 */
	public function setMetaDescription($metaDescription) {
		$this->metaDescription = $metaDescription;
	}

	/**
	 * Get Meta Keywords
	 *
	 * @return string
	 */
	public function getMetaKeywords() {
		return $this->metaKeywords;
	}

	/**
	 * Set Meta Keywords
	 *
	 * @param string $metaKeywords
	 * @return void
	 */
	public function setMetaKeywords($metaKeywords) {
		$this->metaKeywords = $metaKeywords;
	}

}