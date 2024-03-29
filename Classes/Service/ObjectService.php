<?php
namespace Ucreation\Properties\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Arek van Schaijk <info@ucreation.nl>, Ucreation
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
	 * @var array
	 */
	public $settings = array();
	
	/**
	 * @var \TYPO3\CMS\Extbase\Mvc\Web\Request|null
	 */
	public $request = NULL;

	/**
	 * @var boolean
	 */
	protected $prepared = FALSE;

	/**
	 * @var array|bool
	 */
	protected $linkArguments = FALSE;

	/**
	 * @var \Ucreation\Properties\Domain\Model\Category|bool
	 */
	protected $activeCategory = FALSE;

	/**
	 * @var \Ucreation\Properties\Service\FilterService
	 * @inject
	 */
	protected $filterService = NULL;

	/**
	 * @var \Ucreation\Properties\Domain\Repository\ObjectRepository
	 * @inject
	 */
	private $objectRepository = NULL;

	/**
	 * @var \Ucreation\Properties\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager = NULL;

	/**
	 * Get Filter Service
	 *
	 * @return \Ucreation\Properties\Service\FilterService
	 */
	public function getFilterService() {
		return $this->filterService;
	}

	/**
	 * Is Prepared
	 *
	 * @return bool
	 */
	public function isPrepared() {
		return $this->prepared;
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
	 * Get Filtered Objects
	 *
	 * @param array $filters
	 * @param array $filterOverrides
	 * @param array $ignoredFilters
	 * @param int $limit
	 * @param array $orderings
	 * @param array $additionalConstrains
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Object>
	 */
	public function getFilteredObjects(array $filters = NULL, array $filterOverrides = NULL, array $ignoredFilters = NULL, $limit = 0, array $orderings = NULL, array $additionalConstrains = NULL) {
		return $this->objectRepository->findByFilters($this, $filters, $filterOverrides, $ignoredFilters, $limit, $orderings, $additionalConstrains);
	}

	/**
	 * Get Related Objects By Category
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @param int $limit
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Object>
	 */
	public function getRelatedObjectsByCategory(Object $object, $limit = 0) {
		return $this->objectRepository->findRelatedObjectsByCategory($object, $limit);
	}

	/**
	 * Get Related Objects By Category
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @param int $limit
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Object>
	 */
	public function getRelatedObjectsByTown(Object $object, $limit = 0) {
		return $this->objectRepository->findRelatedObjectsByTown($object, $limit);
	}

	/**
	 * Get Active Category Id
	 *
	 * @return int|bool
	 */
	public function getActiveCategoryId() {
		if ($this->request->hasArgument(LinkUtility::CATEGORY)) {
			$categoryId = $this->request->getArgument(LinkUtility::CATEGORY);
			if (ctype_digit($categoryId)) {
				return $categoryId;
			}
		}
		return FALSE;
	}

	/**
	 * Get Active Category
	 *
	 * @return \Ucreation\Properties\Domain\Model\Category
	 */
	public function getActiveCategory() {
		if ($this->activeCategory === FALSE) {
			$this->activeCategory = NULL;
			if (($categoryId = $this->getActiveCategoryId())) {
				$this->activeCategory = $this->categoryRepository->findOneByUid($categoryId);
			}
		}
		return $this->activeCategory;
	}

	/**
	 * Get Active Tab
	 *
	 * @return string|null
	 */
	public function getActiveTab() {
		if ($this->request->hasArgument(LinkUtility::TAB)) {
			return $this->request->getArgument(LinkUtility::TAB);
		}
		return NULL;
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
					$parameterValue = $this->request->getArgument($parameterName);
					if ($parameterValue != '') {
						$this->linkArguments[$parameterName] = $parameterValue;;
					}
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
		// Processes the implodes
		if (($implodes = $this->settings['linkArguments']['processing']['implodes'])) {
			foreach (GeneralUtility::trimExplode(',', $implodes) as $parameterToImplode) {
				if ($linkArguments[$parameterToImplode] && is_array($linkArguments[$parameterToImplode])) {
					$linkArguments[$parameterToImplode] = implode(',', $linkArguments[$parameterToImplode]);
				}
			}
		}
		// Loops through the filters and checks if there are methods where we have to pass through the array with link arguments
		foreach ($this->getFilterService()->getFilters() as $filter) {
			if (method_exists($filter, 'processLinkArguments')) {
				$linkArguments = $filter->processLinkArguments($linkArguments);
			}
		}
		return $linkArguments;
	}

	/**
	 * Update
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @return void
	 */
	public function update(Object $object) {
		$this->objectRepository->update($object);
		$this->persistenceManager->persistAll();
	}

}