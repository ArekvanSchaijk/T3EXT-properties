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

use Ucreation\Properties\Service\FilterService;

/**
 * Class AbstractFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
abstract class AbstractFilter {

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
     * Is Active
     *
     * @return bool
     */
    public function isActive() {
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

}