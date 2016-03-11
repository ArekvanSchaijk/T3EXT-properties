<?php
namespace Ucreation\Properties\Controller;

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

use Ucreation\Properties\Domain\Model\Object;
use Ucreation\Properties\Utility\FilterUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class ObjectController
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class ObjectController extends BaseController {

	/**
	 * @var \Ucreation\Properties\Domain\Repository\PresenceRepository
	 * @inject
	 */
	protected $presenceRepository = NULL;

	/**
	 * @var \Ucreation\Properties\Domain\Repository\TownRepository
	 * @inject
	 */
	protected $townRepository = NULL;

	/**
	 * List Action
	 * 
	 * @return void
	 */
	public function listAction() {
		// Determines if the filter form is posted
		if ($this->request->hasArgument('submitFilters')) {
			$this->performFiltersFormPost();
			exit;
		}
		$objects = $this->objectService->getFilteredObjects();
		$this->view->assign('objects', $objects);
	}
	
	/**
	 * Show Action
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @return void
	 */
	public function showAction(Object $object = NULL) {

	}

	/**
	 * Filters Action
	 *
	 * @return void
	 */
	public function filtersAction() {
		// Filter type
		$this->view->assign('types', self::getObjectTypes());
		$this->view->assign('activeType', $this->objectService->getActiveType());
		if ($this->objectService->getActiveType() == FilterUtility::FILTER_TYPE_BUILDING) {
			// Filter offer
			if ($this->objectService->isFilterRegistred(FilterUtility::FILTER_OFFER)) {
				$this->view->assign('showOfferFilter', TRUE);
				$this->view->assign('offerTypes', self::getObjectOfferTypes());
				$this->view->assign('activeOfferType', $this->objectService->getActiveOfferType());
			}
			// Filter presences
			if ($this->objectService->isFilterRegistred(FilterUtility::FILTER_PRESENCES)) {
				$presences = $this->presenceRepository->findAll();
				$this->view->assign('showPresencesFilter', TRUE);
				$this->view->assign('presences', $presences);
			}
		}

		// Price
		if ($this->objectService->isFilterRegistred(FilterUtility::FILTER_PRICE)) {
			$objectLowestPrice = $this->objectService->getObjectLowestPrice();
			$objectHighestPrice = $this->objectService->getObjectHighestPrice();
			if ($objectLowestPrice !== FALSE && $objectHighestPrice !== FALSE && $objectLowestPrice != $objectHighestPrice) {
				$this->view->assign('showPriceFilter', TRUE);
				$this->view->assign('priceLowest', $objectLowestPrice);
				$this->view->assign('priceHighest', $objectHighestPrice);
				$this->view->assign('selectedPriceLowest', $this->objectService->getSelectedLowestPrice());
				$this->view->assign('selectedPriceHighest', $this->objectService->getSelectedHighestPrice());
			}
		}

		// Lot Size
		if ($this->objectService->isFilterRegistred(FilterUtility::FILTER_LOT_SIZE)) {
			$objectLowestLotSize = $this->objectService->getObjectLowestLotSize();
			$objectHighestLotSize = $this->objectService->getObjectHighestLotSize();
			if ($objectLowestLotSize != $objectHighestLotSize) {
				$this->view->assign('showLotSizeFilter', TRUE);
				$this->view->assign('lotSizeLowest', $objectLowestLotSize);
				$this->view->assign('lotSizeHighest', $objectHighestLotSize);
				$this->view->assign('selectedLotSizeLowest', $this->objectService->getSelectedLowestLotSize());
				$this->view->assign('selectedLotSizeHighest', $this->objectService->getSelectedHighestLotSize());
			}
		}

		// Filter town
		if ($this->objectService->isFilterRegistred(FilterUtility::FILTER_TOWN)) {
			$towns = $this->townRepository->findAll();
			$this->view->assign('showTownFilter', TRUE);
			$this->view->assign('towns', $towns);
			$this->view->assign('activeTown', $this->objectService->getActiveTownId());
		}

		// Filter towns (multiple)
		if ($this->objectService->isFilterRegistred(FilterUtility::FILTER_TOWNS)) {
			$towns = $this->townRepository->findAll();
			$this->view->assign('showTownsFilter', TRUE);
			$this->view->assign('towns', $towns);

		}
	}

	/**
	 * Perform Filters Form Post
	 *
	 * @return void
	 */
	protected function performFiltersFormPost() {
		$this->redirect(NULL, NULL, NULL, $this->objectService->getLinkArguments());
	}

	/**
	 * Get Object Types
	 *
	 * @return array
	 * @static
	 */
	static protected function getObjectTypes() {
		return array(
			FilterUtility::FILTER_TYPE_BOTH => LocalizationUtility::translate('filter.type.both', static::$extName),
			FilterUtility::FILTER_TYPE_BUILDING => LocalizationUtility::translate('filter.type.building', static::$extName),
			FilterUtility::FILTER_TYPE_LOT => LocalizationUtility::translate('filter.type.lot', static::$extName),
		);
	}

	/**
	 * Get Object Offer Types
	 *
	 * @return array
	 */
	static protected function getObjectOfferTypes() {
		return array(
			FilterUtility::FILTER_OFFER_BOTH => LocalizationUtility::translate('filter.offer.both', static::$extName),
			FilterUtility::FILTER_OFFER_SALE => LocalizationUtility::translate('filter.offer.sale', static::$extName),
			FilterUtility::FILTER_OFFER_RENT => LocalizationUtility::translate('filter.offer.rent', static::$extName),
		);
	}

}