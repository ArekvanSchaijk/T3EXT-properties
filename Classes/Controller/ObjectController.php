<?php
namespace Ucreation\Properties\Controller;

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

use Ucreation\Properties\Domain\Model\Object;

/**
 * Class ObjectController
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class ObjectController extends BaseController {

	/**
	 * List Action
	 * 
	 * @return void
	 */
	public function listAction() {
		// Determines if the filter form is posted
		if ($this->request->hasArgument('submitFilters')) {
			$this->performFiltersFormPost();
			exit;
		}
		$objects = $this->objectService->getFilteredObjects(NULL, NULL, NULL, 0, $this->getFilterService()->getQueryOrderings());
		$this->view->assign('objects', $objects);
	}
	
	/**
	 * Show Action
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @return void
	 */
	public function showAction(Object $object = NULL) {
		if (!$object) {
			self::getTypoScriptFrontendController()->pageNotFoundAndExit();
		}
		$this->view->assign('object', $object);
	}

	/**
	 * Filters Action
	 *
	 * @return void
	 */
	public function filtersAction() {}

	/**
	 * Perform Filters Form Post
	 *
	 * @return void
	 */
	protected function performFiltersFormPost() {
		$this->redirect(NULL, NULL, NULL, $this->getObjectService()->getLinkArguments());
	}

}