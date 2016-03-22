<?php
namespace Ucreation\Properties\Utility;

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

/**
 * Class FilterUtility
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class FilterUtility {

    /**
     * @const string
     */
    const   FILTER_CATEGORY = 'category',
            FILTER_TOWN = 'town',
            FILTER_TOWNS = 'towns',
            FILTER_PRESENCES = 'presences',
            FILTER_PRICE = 'price',
            FILTER_LOT_SIZE = 'lot_size',
            FILTER_TYPE = 'type',
            FILTER_OFFER = 'offer';

    /**
     * Get Registered
     * 
     * @return array
     * @static
     */
    static public function getRegistered() {
        return array(
            self::FILTER_TYPE       => 'Ucreation\\Properties\\Filter\\Type',
            self::FILTER_OFFER      => 'Ucreation\\Properties\\Filter\\Offer',
            self::FILTER_PRICE      => 'Ucreation\\Properties\\Filter\\Price',
            self::FILTER_LOT_SIZE   => 'Ucreation\\Properties\\Filter\\LotSize',
            self::FILTER_TOWN       => 'Ucreation\\Properties\\Filter\\Town',
            self::FILTER_TOWNS      => 'Ucreation\\Properties\\Filter\\Towns',
            self::FILTER_CATEGORY   => 'Ucreation\\Properties\\Filter\\Category',
            self::FILTER_PRESENCES  => 'Ucreation\\Properties\\Filter\\Presences',
        );
    }

}