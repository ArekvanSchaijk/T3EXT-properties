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

use TYPO3\CMS\Extbase\Persistence\Repository;
use Ucreation\Properties\Service\ObjectService;
use Ucreation\Properties\Utility\FilterUtility;

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
		'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);

	/**
	 * Get Filtered Objects
	 *
	 * @param ObjectService $objectService
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function getFilteredObjects(ObjectService $objectService) {
		$matchings = array();
		// Creates an new query
		$query = $this->createQuery();
		// Apply filters
		if (($registredFilters = $objectService->getRegistredFilters())) {
			// Loops trough all registred filters
			foreach ($registredFilters as $registredFilter) {
				switch ($registredFilter) {
					// Filter by type
					case FilterUtility::FILTER_TYPE:
						if (($activeType = $objectService->getActiveType())) {
							$matchings[] = $query->equals('type', $activeType);
						}
						break;
					// Filter by category
					case FilterUtility::FILTER_CATEGORY:
						if (($categoryId = $objectService->getActiveCategoryId())) {
							$matchings[] = $query->equals('category', $categoryId);
						}
						break;
				}
			}
		}
		// Apply the matchings
		if ($matchings) {
			if (count($matchings) == 1) {
				$query->matching($matchings[0]);
			} else {
				$query->matching($query->logicalAnd($matchings));
			}
		}
		return $query->execute();
	}

}