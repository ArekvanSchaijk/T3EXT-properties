<?php
namespace Ucreation\Properties\Utility;

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

/**
 * Class LinkUtility
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class LinkUtility {
	
	/**
	 * @const string
	 */	
	const	SEARCH = 'search',
			TYPE = 'type',
			TYPES = 'types',
			OFFER = 'offer',
			TOWN = 'town',
			TOWNS = 'towns',
			PRICE_RANGE = 'priceRange',
			PRICE_MIN = 'priceMin',
			PRICE_MAX = 'priceMax',
			LOT_SIZE_RANGE = 'lotSizeRange',
			LOT_SIZE_MIN = 'lotSizeMin',
			LOT_SIZE_MAX = 'lotSizeMax',
			CATEGORY = 'category',
			PRESENCES = 'presences',
			POSITIONS = 'positions',
			CONSTRUCTION_TYPES = 'constructionTypes',
			STATUS = 'status';
	
	/**
	 * @var array
	 */
	static protected $availableParameterNames = array(
		self::SEARCH,
		self::TYPE,
		self::TYPES,
		self::OFFER,
		self::TOWN,
		self::TOWNS,
		self::PRICE_RANGE,
		self::PRICE_MIN,
		self::PRICE_MAX,
		self::LOT_SIZE_RANGE,
		self::LOT_SIZE_MIN,
		self::LOT_SIZE_MAX,
		self::CATEGORY,
		self::PRESENCES,
		self::POSITIONS,
		self::CONSTRUCTION_TYPES,
		self::STATUS,
	);
	
	/**
	 * Get Available Parameter Names
	 *
	 * @param array $ignored array with ignored parameter names
	 * @param array $registered array with custom registred parameter names
	 * @return array
	 */
	static public function getAvailableParameterNames(array $ignored = NULL, array $registered = NULL) {
		// Gets the available parameter names
		$parameterNames = self::$availableParameterNames;
		// Merges the registred parameters with the available parameter names
		if ($registered) {
			$parameterNames = array_merge($parameterNames, $registered);
		}
		// Removes the ignored parameters
		if ($ignored) {
			foreach ($ignored as $parameterNameToRemove) {
				if (($key = array_search($parameterNameToRemove, $parameterNames)) !== FALSE) {
					unset($parameterNames[$key]);
				}
			}
		}
		return $parameterNames;
	}
	
}