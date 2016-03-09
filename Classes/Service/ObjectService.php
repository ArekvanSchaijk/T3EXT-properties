<?php
namespace Ucreation\Properties\Service;

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

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use Ucreation\Properties\Domain\Model\Category;
use Ucreation\Properties\Domain\Model\Object;
use Ucreation\Properties\Domain\Model\Presence;
use Ucreation\Properties\Utility\FilterUtility;
use Ucreation\Properties\Utility\LinkUtility;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Web\Request;

/**
 * Class ObjectService
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class ObjectService implements SingletonInterface {
	
	/**
	 * @var boolean
	 */
	protected $prepared = FALSE;
	
	/**
	 * @var \TYPO3\CMS\Extbase\Mvc\Web\Request
	 */
	protected $request = NULL;

	/**
	 * @var array
	 */
	protected $settings = array();

	/**
	 * @var bool|array
	 */
	protected $linkArguments = FALSE;

	/**
	 * @var array
	 */
	protected $registeredFilters = NULL;

	/**
	 * @var array
	 */
	protected $presences = NULL;

	/**
	 * @var int
	 */
	protected $type = NULL;

	/**
	 * @var int
	 */
	protected $offerType = NULL;

	/**
	 * @var bool|\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Object>
	 */
	protected $objects = FALSE;

	/**
	 * @var int
	 */
	protected $selectedLowestPrice = NULL;

	/**
	 * @var int
	 */
	protected $selectedHighestPrice = NULL;

	/**
	 * @var float
	 */
	protected $objectLowestPrice = NULL;

	/**
	 * @var float
	 */
	protected $objectHighestPrice = NULL;

	/**
	 * @var array
	 */
	protected $filters = NULL;

	/**
	 * @var \Ucreation\Properties\Domain\Repository\ObjectRepository
	 * @inject
	 */
	protected $objectRepository = NULL;

	/**
	 * Is Prepared
	 *
	 * @return bool
	 */
	public function isPrepared() {
		return $this->prepared;
	}

	/**
	 * Get Filtered Objects
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Object>
	 */
	public function getFilteredObjects() {
		if ($this->objects === FALSE) {
			$this->objects = $this->objectRepository->getFilteredObjects($this);
		}
		return $this->objects;
	}

	/**
	 * Get Object Lowest Price
	 *
	 * @return float
	 */
	public function getObjectLowestPrice() {
		if (is_null($this->objectLowestPrice)) {
			$this->objectLowestPrice = FALSE;
			$object = $this->objectRepository->findByLowestPrice($this);
			if ($object) {
				$this->objectLowestPrice = $object->getPrice();
			}
		}
		return $this->objectLowestPrice;
	}

	/**
	 * Get Object Highest Price
	 *
	 * @return float
	 */
	public function getObjectHighestPrice() {
		if (is_null($this->objectHighestPrice)) {
			$this->objectHighestPrice = FALSE;
			$object = $this->objectRepository->findByHighestPrice($this);
			if ($object) {
				$this->objectHighestPrice = $object->getPrice();
			}
		}
		return $this->objectHighestPrice;
	}

	/**
	 * Get Query Filter Contrains
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
	 * @param array $filters
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\Query
	 */
	public function getQueryFilterConstrains(Query $query, array $filters = NULL) {
		$constrains = array();
		if (is_null($filters)) {
			$filters = $this->getFilters();
		}
		// Category
		if ($filters[FilterUtility::FILTER_CATEGORY]) {
			$constrains[FilterUtility::FILTER_CATEGORY] = $query->equals('category', $filters[FilterUtility::FILTER_CATEGORY]);
		}
		// Type
		if ($filters[FilterUtility::FILTER_TYPE]) {
			$constrains[FilterUtility::FILTER_TYPE] = $query->equals('type', $filters[FilterUtility::FILTER_TYPE]);
		}
		// Lowest Price
		if ($filters[FilterUtility::FILTER_PRICE_LOWEST]) {
			$constrains[FilterUtility::FILTER_PRICE_LOWEST] = $query->greaterThanOrEqual('price', $filters[FilterUtility::FILTER_PRICE_LOWEST]);
		}
		// Highest price
		if ($filters[FilterUtility::FILTER_PRICE_HIGHEST]) {
			$constrains[FilterUtility::FILTER_PRICE_HIGHEST] = $query->lessThanOrEqual('price', $filters[FilterUtility::FILTER_PRICE_HIGHEST]);
		}
		// Town
		if ($filters[FilterUtility::FILTER_TOWN]) {
			$constrains[FilterUtility::FILTER_TOWN] = $query->equals('town', $filters[FilterUtility::FILTER_TOWN]);
		}
		// Offer
		if ($filters[FilterUtility::FILTER_OFFER]) {
			// Filter for sale only
			if ($filters[FilterUtility::FILTER_OFFER] == FilterUtility::FILTER_OFFER_SALE) {
				$constrains[FilterUtility::FILTER_OFFER] = $query->logicalOr(
					$query->equals('offer', Object::OFFER_BOTH),
					$query->equals('offer', Object::OFFER_SALE)
				);
			} else if ($filters[FilterUtility::FILTER_OFFER] == FilterUtility::FILTER_OFFER_RENT) {
				$constrains[FilterUtility::FILTER_OFFER] = $query->logicalOr(
					$query->equals('offer', Object::OFFER_BOTH),
					$query->equals('offer', Object::OFFER_RENT)
				);
			}
		}
		return $constrains;
	}

	/**
	 * Get Filters
	 *
	 * @return array
	 */
	public function getFilters() {
		if (is_null($this->filters)) {
			$this->filters = array();
			// Loops through the registred filters
			foreach ($this->getRegistredFilters() as $filterName) {
				switch ($filterName) {
					case FilterUtility::FILTER_CATEGORY:
						if (($categoryId = $this->getActiveCategoryId())) {
							$this->filters[FilterUtility::FILTER_CATEGORY] = $categoryId;
						}
						break;
					case FilterUtility::FILTER_TYPE:
						if (($activeType = $this->getActiveType())) {
							$this->filters[FilterUtility::FILTER_TYPE] = $activeType;
						}
						break;
					case FilterUtility::FILTER_PRICE_LOWEST:
						if (($lowestPrice = $this->getSelectedLowestPrice()) !== FALSE) {
							$this->filters[FilterUtility::FILTER_PRICE_LOWEST] = $lowestPrice;
						}
						break;
					case FilterUtility::FILTER_PRICE_HIGHEST:
						if (($highestPrice = $this->getSelectedHighestPrice()) !== FALSE) {
							$this->filters[FilterUtility::FILTER_PRICE_HIGHEST] = $highestPrice;
						}
						break;
					case FilterUtility::FILTER_TOWN:
						if (($townId = $this->getActiveTownId())) {
							$this->filters[FilterUtility::FILTER_TOWN] = $townId;
						}
						break;
					case FilterUtility::FILTER_OFFER:
						if (($activeOfferType = $this->getActiveOfferType())) {
							$this->filters[FilterUtility::FILTER_OFFER] = $activeOfferType;
						}
						break;
				}
			}
		}
		return $this->filters;
	}

	/**
	 * Prepare
	 *
	 * @param \TYPO3\CMS\Extbase\Mvc\Web\Request $request
	 * @param array $settings
	 * @return void
	 */
	public function prepare(Request $request, array $settings = NULL) {
		if (!$this->prepared) {
			// Stores the request
			$this->request = $request;
			// Stores the settings
			if ($settings) {
				$this->settings = $settings;
			}
			$this->prepared = TRUE;
		}
	}

	/**
	 * Get Active Category
	 *
	 * @return int
	 */
	public function getActiveCategoryId() {
		if ($this->request->hasArgument(LinkUtility::CATEGORY)) {
			if (($categoryId = $this->request->getArgument(LinkUtility::CATEGORY))) {
				if (ctype_digit($categoryId)) {
					return $categoryId;
				}
			}
		}
		return FALSE;
	}

	/**
	 * Get Active Town Id
	 *
	 * @return int
	 */
	public function getActiveTownId() {
		if ($this->request->hasArgument(LinkUtility::TOWN)) {
			if (($townId = $this->request->getArgument(LinkUtility::TOWN))) {
				if (ctype_digit($townId)) {
					return $townId;
				}
			}
		}
		return FALSE;
	}

	/**
	 * Set Link Arguments
	 *
	 * @param array $linkArguments
	 * @return array
	 */
	public function getLinkArguments(array $linkArguments = NULL) {
		if ($this->linkArguments === FALSE) {
			$this->linkArguments = array();
			// Gets the available parameter names
			$allowedParameters = LinkUtility::getAvailableParameterNames(
				GeneralUtility::trimExplode(',', $this->settings['linkArguments']['ignore']),
				GeneralUtility::trimExplode(',', $this->settings['linkArguments']['register'])
			);
			// Foreach trough all arguments
			foreach ($allowedParameters as $parameterName) {
				// If the request contains a argument with $parameterName then we store it back in the $linkArguments array
				if ($this->request->hasArgument($parameterName)) {
					$this->linkArguments[$parameterName] = $this->request->getArgument($parameterName);
				}
			}
		}
		if ($linkArguments) {
			return $this->processLinkArguments(array_merge($this->linkArguments, $linkArguments));
		}
		return $this->processLinkArguments($this->linkArguments);
	}

	/**
	 * Process Link Arguments
	 *
	 * @param array $linkArguments
	 * @return array
	 */
	protected function processLinkArguments(array $linkArguments) {
		if (($removeParameters = GeneralUtility::trimExplode(',', $this->settings['linkArguments']['remove']))) {
			foreach ($removeParameters as $parameterName) {
				unset($linkArguments[$parameterName]);
			}
		}
		// Removes the type argument when it's selected as 'both'
		if (!$linkArguments[LinkUtility::TYPE]) {
			unset($linkArguments[LinkUtility::TYPE]);
		}
		// Removes the offer argument when it's selected as 'both'
		if (!$linkArguments[LinkUtility::OFFER]) {
			unset($linkArguments[LinkUtility::OFFER]);
		}
		// Processes the presences
		if ($linkArguments[LinkUtility::PRESENCES]) {
			$linkArguments[LinkUtility::PRESENCES] = implode(',', $linkArguments[LinkUtility::PRESENCES]);
		}
		return $linkArguments;
	}

	/**
	 * Get Registred Filters
	 *
	 * @return array
	 */
	public function getRegistredFilters() {
		if (is_null($this->registeredFilters)) {
			$this->registeredFilters = array();
			// Known filters array
			$knownFilters = FilterUtility::getKnownFilters();
			// Gets the registred filters
			$registeredFilters = GeneralUtility::trimExplode(',', $this->settings['filters']['registred']);
			// Loops through all filters and collect all filters which are registred by setup
			foreach ($knownFilters as $filter) {
				if (in_array(strtolower($filter), $registeredFilters)) {
					$this->registeredFilters[] = $filter;
				}
			}
		}
		return $this->registeredFilters;
	}

	/**
	 * Get Active Type
	 *
	 * @return int
	 */
	public function getActiveType() {
		if (is_null($this->type)) {
			$this->type = FilterUtility::FILTER_TYPE_BOTH;
			if ($this->request->hasArgument(LinkUtility::TYPE)) {
				switch ($this->request->getArgument(LinkUtility::TYPE)) {
					case FilterUtility::FILTER_TYPE_BUILDING:
						$this->type = FilterUtility::FILTER_TYPE_BUILDING;
						break;
					case FilterUtility::FILTER_TYPE_LOT:
						$this->type = FilterUtility::FILTER_TYPE_LOT;
						break;
					default:
						$this->type = FilterUtility::FILTER_TYPE_BOTH;
				}
			}
		}
		return $this->type;
	}

	/**
	 * Get Active Offer Type
	 *
	 * @return int
	 */
	public function getActiveOfferType() {
		if (is_null($this->offerType)) {
			$this->offerType = FilterUtility::FILTER_OFFER_BOTH;
			if ($this->request->hasArgument(LinkUtility::OFFER)) {
				switch ($this->request->getArgument(LinkUtility::OFFER)) {
					case FilterUtility::FILTER_OFFER_SALE:
						$this->offerType = FilterUtility::FILTER_OFFER_SALE;
						break;
					case FilterUtility::FILTER_OFFER_RENT:
						$this->offerType = FilterUtility::FILTER_OFFER_RENT;
						break;
					default:
						$this->type = FilterUtility::FILTER_OFFER_BOTH;
				}
			}
		}
		return $this->offerType;
	}

	/**
	 * Is Filter Registred
	 *
	 * @return bool
	 */
	public function isFilterRegistred($filterName) {
		return in_array($filterName, $this->getRegistredFilters());
	}

	/**
	 * Is Presence Active
	 *
	 * @param \Ucreation\Properties\Domain\Model\Presence $presence
	 * @return bool
	 */
	public function isPresenceActive(Presence $presence) {
		if (is_null($this->presences)) {
			$this->presences = array();
			if ($this->request->hasArgument(LinkUtility::PRESENCES)) {
				$presences = GeneralUtility::trimExplode(',', $this->request->getArgument(LinkUtility::PRESENCES));
				foreach ($presences as $key => $value) {
					if (ctype_digit($value) && !in_array($value, $this->presences)) {
						$this->presences[] = $value;
					}
				}
			}
		}
		return in_array($presence->getUid(), $this->presences);
	}

	/**
	 * Is Category Active
	 *
	 * @param \Ucreation\Properties\Domain\Model\Category $category
	 * @return bool
	 */
	public function isCategoryActive(Category $category) {
		if ($this->request->hasArgument(LinkUtility::CATEGORY)) {
			if ($this->request->getArgument(LinkUtility::CATEGORY) == $category->getUid()) {
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * Get Selected Lowest Price
	 *
	 * @return int
	 */
	public function getSelectedLowestPrice() {
		$this->processPriceSelection();
		return $this->selectedLowestPrice;
	}

	/**
	 * Get Selected Highest Price
	 *
	 * @return int
	 */
	public function getSelectedHighestPrice() {
		$this->processPriceSelection();
		return $this->selectedHighestPrice;
	}

	/**
	 * Process Price Selection
	 *
	 * @return void
	 */
	protected function processPriceSelection() {
		if (is_null($this->selectedLowestPrice) || is_null($this->selectedHighestPrice)) {
			$this->selectedLowestPrice = FALSE;
			$this->selectedHighestPrice = FALSE;
			if ($this->request->hasArgument(LinkUtility::PRICE)) {
				$price = $this->request->getArgument(LinkUtility::PRICE);
				if (strpos($price, '-') !== FALSE) {
					$price = GeneralUtility::trimExplode('-', $price);
					$this->selectedLowestPrice = (int)$price[0];
					$lowestPossiblePrice = $this->getObjectLowestPrice();
					if ($this->selectedLowestPrice < $lowestPossiblePrice) {
						$this->selectedLowestPrice = $lowestPossiblePrice;
					}
					$this->selectedHighestPrice = (int)$price[1];
					$highestPossiblePrice = $this->getObjectHighestPrice();
					if ($this->selectedHighestPrice > $highestPossiblePrice) {
						$this->selectedHighestPrice = $highestPossiblePrice;
					}

				}
			}
		}
	}

}