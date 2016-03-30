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
use Ucreation\Properties\Utility\FilterUtility;
use Ucreation\Properties\Utility\LinkUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
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
     * @var int|null
     */
    protected $activeOffer = NULL;

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if (parent::getIsActive()) {
            // Since this filter can only be used in combination with the 'type' filter selected as 'building' we're checking it here
            if (($typeFilter = $this->getFilterService()->getFilter(FilterUtility::FILTER_TYPE))) {
                if (
                    !$typeFilter->getIsActive() ||
                    $typeFilter->getActiveType() != TypeFilter::TYPE_BUILDING
                ) {
                    return FALSE;
                }
            }
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getObjectService()->getActiveCategory())) {
                if ($category->isDisableFilterOffer()) {
                    return FALSE;
                }
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get Offer Options
     *
     * @return array
     */
    public function getOfferOptions() {
        return array(
            self::OFFER_BOTH => LocalizationUtility::translate('filter.offer.both', self::$extensionName),
            self::OFFER_SALE => LocalizationUtility::translate('filter.offer.sale', self::$extensionName),
            self::OFFER_RENT => LocalizationUtility::translate('filter.offer.rent', self::$extensionName),
        );
    }

    /**
     * Get Active Offer
     *
     * @return int|bool
     */
    public function getActiveOffer() {
        if (is_null($this->activeOffer)) {
            $this->activeOffer = FALSE;
            if ($this->getObjectService()->request->hasArgument(LinkUtility::OFFER)) {
                $offer = $this->getObjectService()->request->getArgument(LinkUtility::OFFER);
                if (ctype_digit($offer) && $offer <= 2) {
                    $this->setActiveOffer($offer);
                }
            }
        }
        return $this->activeOffer;
    }

    /**
     * Set Active Offer
     *
     * @param int $activeOffer
     * @return void
     */
    public function setActiveOffer($activeOffer) {
        $this->activeOffer = $activeOffer;
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