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
use TYPO3\CMS\Extbase\Persistence\Generic\Query;

/**
 * Class OfferFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class OfferFilter extends AbstractFilter {

    /**
     * @const int
     */
    const   OFFER_BOTH = 0,
            OFFER_SALE = 1,
            OFFER_RENT = 2;

    /**
     * Is Active
     *
     * @return bool
     */
    public function isActive() {
        if (parent::isActive()) {
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getFilterService()->getObjectService()->getActiveCategory())) {
                if ($category->isDisableFilterOffer()) {
                    return FALSE;
                }
            }
            return TRUE:
        }
        return FALSE;
    }

    /**
     * Get Active Offer
     *
     * @return int|bool
     */
    public function getActiveOffer() {
        if ($this->getFilterService()->getObjectService()->request->hasArgument(LinkUtility::OFFER)) {
            $offer = $this->getFilterService()->getObjectService()->request->getArgument(LinkUtility::OFFER);
            if (ctype_digit($offer) && $offer <= 2) {
                return $offer;
            }
        }
        return FALSE;
    }

    /**
     * Get Query Constrain
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @return array|bool
     */
    public function getQueryConstrain(Query $query) {
        if (($offer = $this->getActiveOffer())) {
            switch ($offer) {
                case self::OFFER_BOTH:
                    return FALSE;
                case self::OFFER_SALE:
                    return $query->logicalOr(
                        $query->equals('offer', Object::OFFER_BOTH),
                        $query->equals('offer', Object::OFFER_SALE)
                    );
                case self::OFFER_RENT:
                    return $query->logicalOr(
                        $query->equals('offer', Object::OFFER_BOTH),
                        $query->equals('offer', Object::OFFER_RENT)
                    );
            }
        }
        return FALSE;
    }

}