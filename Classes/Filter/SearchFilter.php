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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Ucreation\Properties\Utility\LinkUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;

/**
 * Class SearchFilter
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class SearchFilter extends AbstractFilter {

    /**
     * @var string|bool|null
     */
    protected $searchString = NULL;

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive() {
        if (parent::getIsActive()) {
            // Checks if there is an active category and checks if the category has disabled this filter
            if (($category = $this->getObjectService()->getActiveCategory())) {
                if ($category->getDisableFilterSearch()) {
                    return FALSE;
                }
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get Search String
     *
     * @return string|false
     */
    public function getSearchString() {
        if (is_null($this->searchString)) {
            $this->searchString = FALSE;
            if ($this->getObjectService()->request->hasArgument(LinkUtility::SEARCH)) {
                $this->searchString = str_replace($this->getSpaceCharacter(), chr(32), rawurldecode($this->getObjectService()->request->getArgument(LinkUtility::SEARCH)));
            }
        }
        return $this->searchString;
    }

    /**
     * Get Space Character
     *
     * @return string
     */
    public function getSpaceCharacter() {
        return ($this->getObjectService()->settings['filters']['search']['spaceCharacter'] ? : chr(32));
    }

    /**
     * Get Search Fields
     *
     * @return  array
     */
    public function getSearchFields() {
        return GeneralUtility::trimExplode(',', $this->getObjectService()->settings['filters']['search']['fields']);
    }

    /**
     * Process Link Arguments
     *
     * @param array $linkArguments
     * @return array
     */
    public function processLinkArguments(array $linkArguments) {
        if ($linkArguments[LinkUtility::SEARCH]) {
            $linkArguments[LinkUtility::SEARCH] = str_replace(chr(32), $this->getSpaceCharacter(), $linkArguments[LinkUtility::SEARCH]);
            $linkArguments[LinkUtility::SEARCH] = rawurlencode($linkArguments[LinkUtility::SEARCH]);
        }
        return $linkArguments;
    }

    /**
     * Get Query Constrains
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @param array $additionalConstrains
     * @return array
     */
    public function getQueryConstrains(Query $query, array $additionalConstrains = NULL) {
        if ($this->getSearchString() !== FALSE) {
            $constrains = array();
            foreach ($this->getSearchFields() as $fieldName) {
                $constrains[] = $query->like($fieldName, '%'.$this->getSearchString().'%');
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