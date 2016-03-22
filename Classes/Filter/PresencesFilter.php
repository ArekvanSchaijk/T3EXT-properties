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
 * Class PresencesFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class PresencesFilter extends AbstractFilter {

    /**
     * Get Active Presences
     *
     * @return array|bool
     */
    public function getActivePresences() {
        if ($this->getFilterService()->getObjectService()->request->hasArgument(LinkUtility::PRESENCES)) {
            return GeneralUtility::trimExplode(',', $this->getFilterService()->getObjectService()->request->getArgument(LinkUtility::PRESENCES));
        }
        return FALSE;
    }

    /**
     * Get Query Constrain
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @return array|null
     */
    public function getQueryConstrain(Query $query) {
        if (($presences = $this->getActivePresences())) {
            $constrains = array();
            foreach ($presences as $presenceId) {
                if (ctype_digit($presenceId)) {
                    $constrains[] = $query->contains('presences', $presenceId);
                }
            }
            if ($constrains) {
                if (count($constrains) == 1) {
                    return $constrains[0];
                }
                return $constrains;
            }
        }
        return FALSE;
    }

}