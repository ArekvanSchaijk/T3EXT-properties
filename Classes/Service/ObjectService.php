<?php
namespace Ucreation\Properties\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Arek van Schaijk <info@ucreation.nl>, Ucreation
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
 
use TYPO3\CMS\Core\SingletonInterface;

/**
 * Class ObjectService
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class ObjectService implements SingletonInterface {
	
	/**
	 * @var boolean
	 */
	protected $prepared = FALSE;
	
	/**
	 * @var array
	 */
	protected $linkArguments = array();
	
	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	protected $categories = NULL;
	
	/**
	 * @var \Ucreation\Properties\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository = NULL;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager = NULL;
	
	/**
	 * Is Prepared
	 *
	 * @return boolean
	 */
	public function isPrepared() {
		return $this->prepared;
	}
	
	/**
	 * Set Prepared
	 *
	 * @param boolean $prepared
	 * @return void
	 */
	public function setPrepared($prepared) {
		$this->prepared = $prepared;
	}
	
	/**
	 * Set Link Arguments
	 *
	 * @param array $linkArguments
	 * @return void
	 */
	public function setLinkArguments(array $linkArguments) {
		$this->linkArguments = $linkArguments;
	}
	
	/**
	 * Get Link Arguments
	 *
	 * @return array
	 */
	public function getLinkArguments() {
		return $this->linkArguments;
	}
	
	/**
	 * Get Link Argument
	 *
	 * @param string $parameterName
	 * @return mixed
	 */
	public function getLinkArgument($parameterName) {
		if (isset($this->linkArguments[$parameterName])) {
			return $this->linkArguments[$parameterName];
		}
		return NULL;
	}
	
	/**
	 * Get Categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function getCategories() {
		if (is_null($this->categories)) {
			$this->categories = $this->categoryRepository->findAll();
		}
		return $this->categories;
	}
	
}