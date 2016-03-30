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
     * @var array|null
     */
    protected $activeTowns = NULL;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Town>
     */
    protected $availableTowns = FALSE;

    /**
     * @var \Ucreation\Properties\Domain\Repository\TownRepository
     * @inject
     */
    protected $townRepository = NULL;

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if (parent::getIsActive()) {
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getObjectService()->getActiveCategory())) {
                if ($category->isDisableFilterTowns()) {
                    return FALSE;
                }
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get Available Towns
     *
     * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<\Ucreation\Properties\Domain\Model\Town>
     */
    public function getAvailableTowns() {
        if ($this->availableTowns === FALSE) {
            $this->availableTowns = $this->townRepository->findAll();
        }
        return $this->availableTowns;
    }

    /**
     * Get Active Towns
     *
     * @return array
     */
    public function getActiveTowns() {
        if (is_null($this->activeTowns)) {
            $this->activeTowns = array();
            if ($this->getObjectService()->request->hasArgument(LinkUtility::TOWNS)) {
                $this->activeTowns = GeneralUtility::trimExplode(',', $this->getObjectService()->request->getArgument(LinkUtility::TOWNS));
            }
        }
        return $this->activeTowns;
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