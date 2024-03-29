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

use TYPO3\CMS\Extbase\Persistence\Generic\Query;

/**
 * Class CategoryFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class CategoryFilter extends AbstractFilter {

    /**
     * @var int|null
     */
    protected $activeCategory = NULL;

    /**
     * Get Active Category Id
     *
     * @return int|bool
     */
    public function getActiveCategoryId() {
        if (is_null($this->activeCategory)) {
            $this->setActiveCategoryId($this->getObjectService()->getActiveCategoryId());
        }
        return $this->activeCategory;
    }

    /**
     * Set Active Category Id
     *
     * @param int $categoryId
     * @return void
     */
    public function setActiveCategoryId($categoryId) {
        $this->activeCategory = $categoryId;
    }

    /**
     * Get Query Constrains
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @param array $additionalConstrains
     * @return array|bool
     */
    public function getQueryConstrains(Query $query, array $additionalConstrains = NULL) {
        if (($categoryId = $this->getActiveCategoryId())) {
            return $query->equals('category', $categoryId);
        }
        return FALSE;
    }

}