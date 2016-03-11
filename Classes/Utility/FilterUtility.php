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
 * Class FilterUtility
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class FilterUtility {

    const   FILTER_CATEGORY = 'category';

    const   FILTER_TOWN = 'town',
            FILTER_TOWNS = 'towns';

    const   FILTER_PRESENCES = 'presences';

    const   FILTER_PRICE = 'price',
            FILTER_PRICE_LOWEST = 'price_lowest',
            FILTER_PRICE_HIGHEST = 'price_highest';

    const   FILTER_LOT_SIZE = 'lot_size',
            FILTER_LOT_SIZE_LOWEST = 'lot_size_lowest',
            FILTER_LOT_SIZE_HIGHEST = 'lot_size_highest';

    const   FILTER_TYPE = 'type',
            FILTER_TYPE_BOTH = 0,
            FILTER_TYPE_BUILDING = 1,
            FILTER_TYPE_LOT = 2;

    const   FILTER_OFFER = 'offer',
            FILTER_OFFER_BOTH = 0,
            FILTER_OFFER_SALE = 1,
            FILTER_OFFER_RENT = 2;

    /**
     * Get Known Filters
     * 
     * @return array
     * @static
     */
    static public function getKnownFilters() {
        return array(
            self::FILTER_TYPE,
            self::FILTER_OFFER,
            self::FILTER_PRICE,
            self::FILTER_PRICE_LOWEST,
            self::FILTER_PRICE_HIGHEST,
            self::FILTER_LOT_SIZE,
            self::FILTER_LOT_SIZE_LOWEST,
            self::FILTER_LOT_SIZE_HIGHEST,
            self::FILTER_TOWN,
            self::FILTER_TOWNS,
            self::FILTER_CATEGORY,
            self::FILTER_PRESENCES,
        );
    }

}