<?php
namespace Ucreation\Properties\Controller;

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

use Ucreation\Domain\Model\Object;
use Ucreation\Properties\Utility\LinkUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ObjectController
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class ObjectController extends BaseController {

	/**
	 * @var \Ucreation\Properties\Service\ObjectService
	 * @inject
	 */
	protected $objectService = NULL;
	
	/**
	 * @var \Ucreation\Properties\Domain\Repository\ObjectRepository
	 * @inject
	 */
	protected $objectRepository = NULL;
	
	/**
	 * Initialize
	 *
	 * @return void
	 */
	protected function initialize() {
		// Prepares the object service if it's not prepared yet
		if (!$this->objectService->isPrepared()) {
			$this->prepareObjectService();
		}
	}

	/**
	 * List Action
	 * 
	 * @return void
	 */
	public function listAction() {
		$this->view->assign('categories', $categories);
	}
	
	/**
	 * Show Action
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @return void
	 */
	public function showAction(Object $object = NULL) {
		
	}
	
	/**
	 * Set Link Arguments
	 *
	 * @return void
	 */
	protected function setLinkArguments() {
		$linkArguments = array();
		// Gets the available parameter names
		$availableParameterNames = LinkUtility::getAvailableParameterNames(
			GeneralUtility::trimExplode(',', $this->settings['linkArguments']['ignore']),
			GeneralUtility::trimExplode(',', $this->settings['linkArguments']['register'])
		);
		// Foreach trough all available parameters
		foreach ($availableParameterNames as $parameterName) {
			// If the request contains a argument with $parameterName then we store it back in the $linkArguments array
			if ($this->request->hasArgument($parameterName)) {
				$linkArguments[$parameterName] = $this->request->getArgument($parameterName);	
			}
		}
		// Saves the calculated $linkArguments in the ObjectService so other instances can use it as well without calculating it them self
		$this->objectService->setLinkArguments($linkArguments);	
	}
	
	/**
	 * Prepare Object Service
	 *
	 * @return void
	 */
	protected function prepareObjectService() {
		// Sets the link arguments
		$this->setLinkArguments();
		// Lets the object service know we're done with preparing it ;)
		$this->objectService->setPrepared(TRUE);
	}
	
}