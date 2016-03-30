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

use Ucreation\Properties\Domain\Model\Object;
use Ucreation\Properties\Utility\LinkUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;

/**
 * Class OfferFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class TypeFilter extends AbstractFilter {

    /**
     * @const int
     */
    const   TYPE_BOTH = 0,
            TYPE_BUILDING = 1,
            TYPE_LOT = 2;

    /**
     * @var int|null
     */
    protected $activeType = NULL;

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if (parent::getIsActive()) {
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getObjectService()->getActiveCategory())) {
                if ($category->isDisableFilterType()) {
                    return FALSE;
                }
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get Active Type
     *
     * @return int|bool
     */
    public function getActiveType() {
        if (is_null($this->activeType)) {
            $this->activeType = FALSE;
            if ($this->getObjectService()->request->hasArgument(LinkUtility::TYPE)) {
                $type = $this->getObjectService()->request->getArgument(LinkUtility::TYPE);
                if (ctype_digit($type) && $type <= 2) {
                    $this->setActiveType($type);
                }
            }
        }
        return $this->activeType;
    }

    /**
     * Set Active Type
     *
     * @param int $activeType
     * @return void
     */
    public function setActiveType($activeType) {
        $this->activeType = $activeType;
    }

    /**
     * Get Types Options
     *
     * @return array
     */
    public function getTypesOptions() {
        return array(
            self::TYPE_BOTH => LocalizationUtility::translate('filter.type.both', self::$extensionName),
            self::TYPE_BUILDING => LocalizationUtility::translate('filter.type.building', self::$extensionName),
            self::TYPE_LOT => LocalizationUtility::translate('filter.type.lot', self::$extensionName),
        );
    }

    /**
     * Get Query Constrain
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @return array
     */
    public function getQueryConstrain(Query $query) {
        if (($type = $this->getActiveType())) {
            // Switch through the type
            switch ($type) {
                // Filter by both (buildings and lots)
                case self::TYPE_BOTH:
                    return $query->greaterThan('type', Object::TYPE_NONE);
                // Filter by only buildings
                case self::TYPE_BUILDING:
                    return $query->equals('type', Object::TYPE_BUILDING);
                // Filter by only lots
                case self::TYPE_LOT:
                    return $query->equals('type', Object::TYPE_LOT);
            }
        }
        // Makes sure that we're not selecting objects without type set
        return $query->greaterThan('type', Object::TYPE_NONE);
    }

}