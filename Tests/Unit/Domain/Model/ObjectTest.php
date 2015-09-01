<?php

namespace Ucreation\Properties\Tests\Unit\Domain\Model;

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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Ucreation\Properties\Domain\Model\Object.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class ObjectTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Ucreation\Properties\Domain\Model\Object
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Ucreation\Properties\Domain\Model\Object();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName() {
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTypeReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getType()
		);
	}

	/**
	 * @test
	 */
	public function setTypeForIntegerSetsType() {
		$this->subject->setType(12);

		$this->assertAttributeEquals(
			12,
			'type',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSortReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getSort()
		);
	}

	/**
	 * @test
	 */
	public function setSortForIntegerSetsSort() {
		$this->subject->setSort(12);

		$this->assertAttributeEquals(
			12,
			'sort',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOfferReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getOffer()
		);
	}

	/**
	 * @test
	 */
	public function setOfferForIntegerSetsOffer() {
		$this->subject->setOffer(12);

		$this->assertAttributeEquals(
			12,
			'offer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImagesReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getImages()
		);
	}

	/**
	 * @test
	 */
	public function setImagesForFileReferenceSetsImages() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImages($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'images',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getYearReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getYear()
		);
	}

	/**
	 * @test
	 */
	public function setYearForIntegerSetsYear() {
		$this->subject->setYear(12);

		$this->assertAttributeEquals(
			12,
			'year',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEnvironmentalClassReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEnvironmentalClass()
		);
	}

	/**
	 * @test
	 */
	public function setEnvironmentalClassForStringSetsEnvironmentalClass() {
		$this->subject->setEnvironmentalClass('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'environmentalClass',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() {
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStreetReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getStreet()
		);
	}

	/**
	 * @test
	 */
	public function setStreetForStringSetsStreet() {
		$this->subject->setStreet('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'street',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZipCodeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getZipCode()
		);
	}

	/**
	 * @test
	 */
	public function setZipCodeForStringSetsZipCode() {
		$this->subject->setZipCode('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'zipCode',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getContactReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getContact()
		);
	}

	/**
	 * @test
	 */
	public function setContactForStringSetsContact() {
		$this->subject->setContact('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'contact',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPriceReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getPrice()
		);
	}

	/**
	 * @test
	 */
	public function setPriceForFloatSetsPrice() {
		$this->subject->setPrice(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'price',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getRentPriceReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getRentPrice()
		);
	}

	/**
	 * @test
	 */
	public function setRentPriceForFloatSetsRentPrice() {
		$this->subject->setRentPrice(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'rentPrice',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getRentPriceTypeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getRentPriceType()
		);
	}

	/**
	 * @test
	 */
	public function setRentPriceTypeForStringSetsRentPriceType() {
		$this->subject->setRentPriceType('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'rentPriceType',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPricePerSquareMetreReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getPricePerSquareMetre()
		);
	}

	/**
	 * @test
	 */
	public function setPricePerSquareMetreForFloatSetsPricePerSquareMetre() {
		$this->subject->setPricePerSquareMetre(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'pricePerSquareMetre',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getLotSizeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLotSize()
		);
	}

	/**
	 * @test
	 */
	public function setLotSizeForStringSetsLotSize() {
		$this->subject->setLotSize('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lotSize',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLivingAreaReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLivingArea()
		);
	}

	/**
	 * @test
	 */
	public function setLivingAreaForStringSetsLivingArea() {
		$this->subject->setLivingArea('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'livingArea',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGardenAreaReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getGardenArea()
		);
	}

	/**
	 * @test
	 */
	public function setGardenAreaForStringSetsGardenArea() {
		$this->subject->setGardenArea('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'gardenArea',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNumberOfRoomsReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getNumberOfRooms()
		);
	}

	/**
	 * @test
	 */
	public function setNumberOfRoomsForIntegerSetsNumberOfRooms() {
		$this->subject->setNumberOfRooms(12);

		$this->assertAttributeEquals(
			12,
			'numberOfRooms',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLatitudeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLatitude()
		);
	}

	/**
	 * @test
	 */
	public function setLatitudeForStringSetsLatitude() {
		$this->subject->setLatitude('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'latitude',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLongitudeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLongitude()
		);
	}

	/**
	 * @test
	 */
	public function setLongitudeForStringSetsLongitude() {
		$this->subject->setLongitude('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'longitude',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLatitudeLongitudeMd5ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLatitudeLongitudeMd5()
		);
	}

	/**
	 * @test
	 */
	public function setLatitudeLongitudeMd5ForStringSetsLatitudeLongitudeMd5() {
		$this->subject->setLatitudeLongitudeMd5('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'latitudeLongitudeMd5',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCategoryReturnsInitialValueForCategory() {
		$this->assertEquals(
			NULL,
			$this->subject->getCategory()
		);
	}

	/**
	 * @test
	 */
	public function setCategoryForCategorySetsCategory() {
		$categoryFixture = new \Ucreation\Properties\Domain\Model\Category();
		$this->subject->setCategory($categoryFixture);

		$this->assertAttributeEquals(
			$categoryFixture,
			'category',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPresencesReturnsInitialValueForPresence() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getPresences()
		);
	}

	/**
	 * @test
	 */
	public function setPresencesForObjectStorageContainingPresenceSetsPresences() {
		$presence = new \Ucreation\Properties\Domain\Model\Presence();
		$objectStorageHoldingExactlyOnePresences = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOnePresences->attach($presence);
		$this->subject->setPresences($objectStorageHoldingExactlyOnePresences);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOnePresences,
			'presences',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addPresenceToObjectStorageHoldingPresences() {
		$presence = new \Ucreation\Properties\Domain\Model\Presence();
		$presencesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$presencesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($presence));
		$this->inject($this->subject, 'presences', $presencesObjectStorageMock);

		$this->subject->addPresence($presence);
	}

	/**
	 * @test
	 */
	public function removePresenceFromObjectStorageHoldingPresences() {
		$presence = new \Ucreation\Properties\Domain\Model\Presence();
		$presencesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$presencesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($presence));
		$this->inject($this->subject, 'presences', $presencesObjectStorageMock);

		$this->subject->removePresence($presence);

	}

	/**
	 * @test
	 */
	public function getTownReturnsInitialValueForTown() {
		$this->assertEquals(
			NULL,
			$this->subject->getTown()
		);
	}

	/**
	 * @test
	 */
	public function setTownForTownSetsTown() {
		$townFixture = new \Ucreation\Properties\Domain\Model\Town();
		$this->subject->setTown($townFixture);

		$this->assertAttributeEquals(
			$townFixture,
			'town',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPositionReturnsInitialValueForPosition() {
		$this->assertEquals(
			NULL,
			$this->subject->getPosition()
		);
	}

	/**
	 * @test
	 */
	public function setPositionForPositionSetsPosition() {
		$positionFixture = new \Ucreation\Properties\Domain\Model\Position();
		$this->subject->setPosition($positionFixture);

		$this->assertAttributeEquals(
			$positionFixture,
			'position',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getConstructionTypeReturnsInitialValueForConstructionType() {
		$this->assertEquals(
			NULL,
			$this->subject->getConstructionType()
		);
	}

	/**
	 * @test
	 */
	public function setConstructionTypeForConstructionTypeSetsConstructionType() {
		$constructionTypeFixture = new \Ucreation\Properties\Domain\Model\ConstructionType();
		$this->subject->setConstructionType($constructionTypeFixture);

		$this->assertAttributeEquals(
			$constructionTypeFixture,
			'constructionType',
			$this->subject
		);
	}
}
