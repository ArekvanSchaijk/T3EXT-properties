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

use Ucreation\Properties\Utility\LinkUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;

/**
 * Class TownsFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class TownsFilter extends AbstractFilter {

    /**
     * Is Active
     *
     * @return bool
     */
    public function isActive() {
        if (parent::isActive()) {
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getFilterService()->getObjectService()->getActiveCategory())) {
                if ($category->isDisableFilterTowns()) {
                    return FALSE;
                }
            }
            return TRUE:
        }
        return FALSE;
    }

    /**
     * Get Active Towns
     *
     * @return array|bool
     */
    public function getActiveTowns() {
        if ($this->getFilterService()->getObjectService()->request->hasArgument(LinkUtility::TOWNS)) {
            return GeneralUtility::trimExplode(',', $this->getFilterService()->getObjectService()->request->getArgument(LinkUtility::TOWNS));
        }
        return FALSE;
    }

    /**
     * Get Query Constrain
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @return array
     */
    public function getQueryConstrain(Query $query) {
        if (($towns = $this->getActiveTowns())) {
            $constrains = array();
            foreach ($towns as $townId) {
                if (ctype_digit($townId)) {
                    $constrains[] = $query->equals('town', $townId);
                }
            }
            if ($constrains) {
                if (count($constrains) == 1) {
                    return $constrains[0];
                }
                return $query->logicalOr($constrains);
            }
        }
        return FALSE;
    }

}