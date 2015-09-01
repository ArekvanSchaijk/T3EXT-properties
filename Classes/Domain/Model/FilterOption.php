<?php
namespace Ucreation\Properties\Domain\Model;

/***************************************************************
 *
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

/**
 * Class FilterOption
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class FilterOption extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var integer
	 */
	protected $filterFor = 0;

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var integer
	 */
	protected $filterFrom = 0;

	/**
	 * @var integer
	 */
	protected $filterTo = 0;

	/**
	 * Get Filter For
	 * 
	 * @return integer
	 */
	public function getFilterFor() {
		return $this->filterFor;
	}

	/**
	 * Set Filter For
	 * 
	 * @param integer $filterFor
	 * @return void
	 */
	public function setFilterFor($filterFor) {
		$this->filterFor = $filterFor;
	}

	/**
	 * Get Name
	 * 
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set Name
	 * 
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get Filter From
	 * 
	 * @return integer
	 */
	public function getFilterFrom() {
		return $this->filterFrom;
	}

	/**
	 * Set Filter From
	 * 
	 * @param integer $filterFrom
	 * @return void
	 */
	public function setFilterFrom($filterFrom) {
		$this->filterFrom = $filterFrom;
	}

	/**
	 * Get Filter To
	 * 
	 * @return integer
	 */
	public function getFilterTo() {
		return $this->filterTo;
	}

	/**
	 * Set Filter To
	 * 
	 * @param integer $filterTo
	 * @return void
	 */
	public function setFilterTo($filterTo) {
		$this->filterTo = $filterTo;
	}

}