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
	 * @var float
	 */
	protected $objectLowestPrice = 0;

	/**
	 * @var float
	 */
	protected $objectHighestPrice = 0;

	/**
	 * @var bool
	 */
	protected $isObjectsProcessed = FALSE;

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
		$this->processObjects();
		return $this->objectLowestPrice;
	}

	/**
	 * Get Object Highest Price
	 *
	 * @return float
	 */
	public function getObjectHighestPrice() {
		$this->processObjects();
		return $this->objectHighestPrice;
	}

	/**
	 * Process Object Details
	 *
	 * @return void
	 */
	protected function processObjects() {
		if (!$this->isObjectsProcessed) {
			$this->isObjectsProcessed = TRUE;
			$this->objectLowestPrice = 10000000000;
			foreach ($this->getFilteredObjects() as $object) {
				$price = $object->getPrice();
				// Calculates object prices
				if (
					($object->getOffer() == Object::OFFER_BOTH || $object->getOffer() == Object::OFFER_SALE) &&
					$price > 0
				) {
					// Highest
					if ($object->getPrice() > $this->objectHighestPrice) {
						$this->objectHighestPrice = $price;
					}
					// Lowest
					if ($object->getPrice() < $this->objectLowestPrice) {
						$this->objectLowestPrice = $price;
					}
				}
			}
			if ($this->objectLowestPrice == 10000000000) {
				$this->objectLowestPrice = 0;
			}
		}
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
			$knownFilters = array(
				FilterUtility::FILTER_TYPE,
				FilterUtility::FILTER_OFFER,
				FilterUtility::FILTER_TOWN,
				FilterUtility::FILTER_CATEGORY,
				FilterUtility::FILTER_PRESENCES,
			);
			// Gets the registred filters
			$registredFilters = GeneralUtility::trimExplode(',', $this->settings['filters']['registred']);
			// Loops through all filters and collect all filters which are registred by setup
			foreach ($knownFilters as $filter) {
				if (in_array(strtolower($filter), $registredFilters)) {
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

}