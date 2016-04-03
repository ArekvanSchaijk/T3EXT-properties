<?php
namespace Ucreation\Properties\Filter;

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

use Ucreation\Properties\Utility\FilterUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;

/**
 * Class AbstractFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
abstract class AbstractFilter {

    // Force extending classes to have atleast the following function(s)
    abstract function getQueryConstrains(Query $query, array $additionalConstrains = NULL);

    /**
     * @var string
     */
    static protected $extensionName = 'Properties';

    /**
     * @var bool
     */
    protected $isEliminated = FALSE;

    /**
     * @var \Ucreation\Properties\Service\FilterService
     * @inject
     */
    protected $filterService = NULL;

    /**
     * Get Filter Key
     *
     * @return string
     */
    static public function getFilterKey() {
        return array_search(get_called_class(), FilterUtility::getRegistered());
    }

    /**
     * Get Filter Name
     *
     * @return string
     */
    static public function getFilterName() {
        return str_replace(chr(32), NULL, ucwords(str_replace('_', chr(32), self::getFilterKey())));
    }

    /**
     * Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if ($this->isEliminated) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Eliminate
     *
     * @return void
     */
    public function eliminate() {
        $this->isEliminated = TRUE;
    }

    /**
     * Get Filter Service
     *
     * @return \Ucreation\Properties\Service\FilterService
     */
    protected function getFilterService() {
        return $this->filterService;
    }

    /**
     * Get Object Service
     *
     * @return \Ucreation\Properties\Service\ObjectService
     */
    protected function getObjectService() {
        return $this->filterService->getObjectService();
    }

}