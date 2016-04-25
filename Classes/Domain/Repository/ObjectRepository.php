<?php
namespace Ucreation\Properties\Domain\Repository;

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
use Ucreation\Properties\Service\ObjectService;
use Ucreation\Properties\Utility\AdditionalQueryConstrainsUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Class ObjectRepository
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class ObjectRepository extends AbstractRepository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = array(
		'sorting' => QueryInterface::ORDER_ASCENDING
	);

	/**
	 * Find By Filters
	 *
	 * @param \Ucreation\Properties\Service\ObjectService $objectService
	 * @param array $filters
	 * @param array $filterOverrides
	 * @param array $ignoredFilters
	 * @param int $limit
	 * @param array $orderings
	 * @param array $additionalConstrains
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Object>
	 */
	public function findByFilters(ObjectService $objectService, array $filters = NULL, array $filterOverrides = NULL, array $ignoredFilters = NULL, $limit = 0, array $orderings = NULL, array $additionalConstrains = NULL) {
		// Creates a new query
		$query = $this->createQuery();
		// Sets the orderings
		if ($orderings) {
			$query->setOrderings($orderings);
		}
		// Gets the query constrains from the filter service
		$constrains = $objectService->getFilterService()->getQueryConstrains($query, $filters, $filterOverrides, $ignoredFilters, $additionalConstrains);
		// Processes the additional constrains
		if ($additionalConstrains) {
			$constrains = AdditionalQueryConstrainsUtility::processAdditionalConstrains($query, $additionalConstrains, $constrains);
		}
		// Apply the query constrains
		$query = $this->applyQueryConstrains($query, $constrains);
		// Sets the limit
		if ($limit) {
			$query->setLimit($limit);
		}
		// Executes the query
		return $query->execute();
	}

	/**
	 * Find Related Objects By Category
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @param int $limit
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Object>
	 */
	public function findRelatedObjectsByCategory(Object $object, $limit = 0) {
		$query = $this->createQuery();
		$constrains = array();
		// Excludes the current object
		$constrains[] = $query->logicalNot($query->equals('uid', $object->getUid()));
		if (($category = $object->getCategory())) {
			$constrains[] = $query->equals('category', $category->getUid());
		}
		if (count($constrains) > 1) {
			$query->matching($query->logicalAnd($constrains));
		} else {
			$query->matching($constrains[0]);
		}
		// Sets the limit
		if ($limit) {
			$query->setLimit($limit);
		}
		// Executes the query
		return $query->execute();
	}

	/**
	 * Find Related Objects By Category
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @param int $limit
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Object>
	 */
	public function findRelatedObjectsByTown(Object $object, $limit = 0) {
		$query = $this->createQuery();
		$constrains = array();
		// Excludes the current object
		$constrains[] = $query->logicalNot($query->equals('uid', $object->getUid()));
		if (($town = $object->getTown())) {
			$constrains[] = $query->equals('town', $town->getUid());
		}
		if (count($constrains) > 1) {
			$query->matching($query->logicalAnd($constrains));
		} else {
			$query->matching($constrains[0]);
		}
		// Sets the limit
		if ($limit) {
			$query->setLimit($limit);
		}
		// Executes the query
		return $query->execute();
	}

}