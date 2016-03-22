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

use Ucreation\Properties\Service\ObjectService;
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
	 * @param int $limit
	 * @param array $orderings
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Object>
	 */
	public function findByFilters(ObjectService $objectService, array $filters = NULL, $limit = 0, array $orderings = NULL) {
		// Creates a new query
		$query = $this->createQuery();
		// Gets the query constrains from the filter service
		$constrains = $objectService->getFilterService()->getQueryConstrains($query, $filters);
		// Apply the query constrains
		$query = $this->applyQueryConstrains($query, $constrains);
		// Sets the limit
		if ($limit) {
			$query->setLimit($limit);
		}
		// Executes the query
		return $query->execute();
	}

}