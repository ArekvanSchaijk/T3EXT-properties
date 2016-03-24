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
use TYPO3\CMS\Extbase\Persistence\Generic\Query;

/**
 * Class TownFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class TownFilter extends AbstractFilter {

    /**
     * @var int|null
     */
    protected $activeTown = NULL;

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
            if (($category = $this->getFilterService()->getObjectService()->getActiveCategory())) {
                if ($category->isDisableFilterTown()) {
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
     * Get Active Town
     *
     * @return int|bool
     */
    public function getActiveTown() {
        if (is_null($this->activeTown)) {
            $this->activeTown = FALSE;
            if ($this->getFilterService()->getObjectService()->request->hasArgument(LinkUtility::TOWN)) {
                $townId = $this->getFilterService()->getObjectService()->request->getArgument(LinkUtility::TOWN);
                if (ctype_digit($townId)) {
                    $this->setActiveTown($townId);
                }
            }
        }
        return $this->activeTown;
    }

    /**
     * Set Active Town
     *
     * @param int $activeTown
     * @return void
     */
    public function setActiveTown($activeTown) {
        $this->activeTown = $activeTown;
    }

    /**
     * Get Query Constrain
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @return array|bool
     */
    public function getQueryConstrain(Query $query) {
        if (($townId = $this->getActiveTown())) {
            return $query->equals('town', $this->getActiveTown());
        }
        return FALSE;
    }

}