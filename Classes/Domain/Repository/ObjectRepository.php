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

use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Extbase\Persistence\Repository;
use Ucreation\Properties\Domain\Model\Object;
use Ucreation\Properties\Service\ObjectService;
use Ucreation\Properties\Utility\FilterUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Class ObjectRepository
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class ObjectRepository extends Repository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = array(
		'sorting' => QueryInterface::ORDER_ASCENDING
	);

	/**
	 * Get Filtered Objects
	 *
	 * @param \Ucreation\Properties\Service\ObjectService $objectService
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Object>
	 */
	public function getFilteredObjects(ObjectService $objectService) {
		// Creates an new query
		$query = $this->createQuery();
		// Get query contrains
		$constrains = $objectService->getQueryFilterConstrains($query);
		// Apply query constrains
		$query = $this->applyQueryConstrains($query, $constrains);
		return $query->execute();
	}

	/**
	 * Get Lowest Price
	 *
	 * @param \Ucreation\Properties\Service\ObjectService $objectService
	 * @return \Ucreation\Properties\Domain\Model\Object
	 */
	public function findByLowestPrice(ObjectService $objectService) {
		$query = $this->createQuery();
		$query->setOrderings(array('price' => QueryInterface::ORDER_ASCENDING));
		// Get query contrains
		$constrains = $objectService->getQueryFilterConstrains($query);
		// Removes the pricing constrains
		unset($constrains[FilterUtility::FILTER_PRICE_LOWEST]);
		unset($constrains[FilterUtility::FILTER_PRICE_HIGHEST]);
		unset($constrains[FilterUtility::FILTER_OFFER]);
		unset($constrains[FilterUtility::FILTER_PRICE]);
		// Adds a new constrains for the offer
		$constrains[FilterUtility::FILTER_OFFER] = $query->logicalOr(
			$query->equals('offer', Object::OFFER_BOTH),
			$query->equals('offer', Object::OFFER_SALE)
		);
		// Adds another constrains for the price (this must be filled in)
		$constrains[FilterUtility::FILTER_PRICE] = $query->greaterThan('price', 0);
		// Sets limit
		$query->setLimit((int)1);
		return $query->execute()->getFirst();
	}

	/**
	 * Find By Highest Price
	 *
	 * @param \Ucreation\Properties\Service\ObjectService $objectService
	 * @return \Ucreation\Properties\Domain\Model\Object
	 */
	public function findByHighestPrice(ObjectService $objectService) {
		$query = $this->createQuery();
		$query->setOrderings(array('price' => QueryInterface::ORDER_DESCENDING));
		// Get query contrains
		$constrains = $objectService->getQueryFilterConstrains($query);
		// Removes the pricing constrains
		unset($constrains[FilterUtility::FILTER_PRICE_LOWEST]);
		unset($constrains[FilterUtility::FILTER_PRICE_HIGHEST]);
		unset($constrains[FilterUtility::FILTER_OFFER]);
		unset($constrains[FilterUtility::FILTER_PRICE]);
		// Adds a new constrains for the offer
		$constrains[FilterUtility::FILTER_OFFER] = $query->logicalOr(
			$query->equals('offer', Object::OFFER_BOTH),
			$query->equals('offer', Object::OFFER_SALE)
		);
		// Adds another constrains for the price (this must be filled in)
		$constrains[FilterUtility::FILTER_PRICE] = $query->greaterThan('price', 0);
		// Sets limit
		$query->setLimit((int)1);
		return $query->execute()->getFirst();
	}

	/**
	 * Apply Query Constrains
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
	 * @param array|NULL $constrains
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\Query
	 */
	protected function applyQueryConstrains(Query $query, array $constrains = NULL) {
		if ($constrains) {
			if (count($constrains) == 1) {
				$query->matching($constrains[0]);
			} else {
				$query->matching(
					$query->logicalAnd($constrains)
				);
			}
		}
		return $query;
	}

}