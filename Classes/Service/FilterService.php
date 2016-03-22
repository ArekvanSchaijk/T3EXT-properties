<?php
namespace Ucreation\Properties\Service;

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

use Ucreation\Properties\Exception;
use Ucreation\Properties\Filter\AbstractFilter;
use Ucreation\Properties\Utility\FilterUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Core\SingletonInterface;

/**
 * Class FilterService
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class FilterService implements SingletonInterface {

    /**
     * @var bool
     */
    protected $isPrepared = FALSE;

    /**
     * @var array
     */
    protected $filters = array();

    /**
     * @var array
     */
    protected $eliminated = array();

    /**
     * @var \Ucreation\Properties\Service\ObjectService
     * @inject
     */
    protected $objectService = NULL;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager = NULL;

    /**
     * Prepare
     *
     * @return void
     * @throws \Ucreation\Properties\Exception
     */
    protected function prepare() {
        if (!$this->isPrepared) {
            $this->isPrepared = TRUE;
            // Creates an array with the eliminated filters by setup
            if (($eliminated = $this->getObjectService()->settings['filters']['eliminated'])) {
                $this->eliminated = GeneralUtility::trimExplode(',', $eliminated);
            }
            // Loops trough all registered filters and creates and creates/stores an instance of it
            foreach (FilterUtility::getRegistered() as $filterName => $class) {
                if (!$this->filters[$filterName]) {
                    $filterInstance = $this->objectManager->get($class);
                    if (!$filterInstance instanceof AbstractFilter) {
                        throw new Exception('Filter "'.$filterName.' must be an instance of "Ucreation\\Properties\\Filter\\AbstractFilter".');
                    }
                    // Prepare filter
                    if (method_exists($filterInstance, 'prepare')) {
                        $filterInstance->prepare();
                    }
                    // If the filter is eliminated by the setup we're eliminating the filter here
                    if (in_array($filterName, $this->eliminated)) {
                        $filterInstance->eliminate();
                    }
                    // Stores the filter instance
                    $this->filters[$filterName] = $filterInstance;
                }
            }
        }
    }

    /**
     * Get Object Service
     *
     * @return \Ucreation\Properties\Service\ObjectService
     */
    public function getObjectService() {
        return $this->objectService;
    }

    /**
     * Get Filters
     *
     * @return array
     */
    public function getFilters() {
        $this->prepare();
        return $this->filters;
    }

    /**
     * Get Filter
     *
     * @param string $filterName
     * @return mixed|null
     */
    public function getFilter($filterName) {
        return ($this->filters[$filterName] ? : NULL);
    }

    /**
     * Get Query Constrains
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Query $query
     * @param array $filters
     * @param array $overrides
     * @param array $ignored
     * @return array
     */
    public function getQueryConstrains(Query $query, array $filters = NULL, array $overrides = NULL, array $ignored = NULL) {
        $ignored = ($ignored ? : array());
        $filters = ($filters ? : $this->getFilters());
        // Merge array with overrides
        if ($overrides) {
            $filters = array_merge($filters, $overrides);
        }
        $constrains = array();
        // Foreach through all filters now and gets the query constrain(s)
        foreach ($filters as $filterName => $filterInstance) {
            if ($filterInstance->isActive() && !in_array($filterName, $ignored)) {
                if (($constrain = $filterInstance->getQueryConstrain($query))) {
                    $constrains = $constrain;
                }
            }
        }
        return $constrains;
    }

    /**
     * Is Filter Active
     *
     * @param string $filterName
     * @return bool
     *
     * @throws Exception
     */
    public function isFilterActive($filterName) {
        $this->prepare();
        if (!$this->filters[$filterName]) {
            return FALSE;
        }
        return $this->filters[$filterName]->isActive();
    }

}