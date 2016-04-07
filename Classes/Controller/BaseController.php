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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class BaseController
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class BaseController extends ActionController {

	/**
	 * @var string
	 */
	static protected $extName = 'Properties';

	/**
	 * @var \Ucreation\Properties\Service\ObjectService
	 * @inject
	 */
	protected $objectService = NULL;
	
	/**
	 * Initialize Action
	 *
	 * @return void
	 */
	public function initializeAction() {
		// Checks if the extending class has a 'initialize' method and calls it
		if (method_exists($this, 'initialize')) {
			$this->initialize();
		}
		// Prepares the object service
		if (!$this->objectService->isPrepared()) {
			$this->objectService->prepare($this->request, $this->settings);
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
	 * Get Filter Service
	 *
	 * @return \Ucreation\Properties\Service\FilterService
	 */
	public function getFilterService() {
		return $this->getObjectService()->getFilterService();
	}

	/**
	 * Get TypoScript Frontend Controller
	 *
	 * @return \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
	 * @static
	 */
	static protected function getTypoScriptFrontendController() {
		return $GLOBALS['TSFE'];
	}

	/**
	 * Get Frontend Uri
	 *
	 * @param int $pageId
	 * @param array $arguments
	 * @param bool $addHost
	 * @param int $pageType
	 * @return string
	 */
	public function getFrontendUri($pageId, array $arguments = NULL, $addHost = FALSE, $pageType = NULL) {
		$uri = $this->controllerContext->getUriBuilder();
		$uri->setTargetPageUid($pageId);
		$uri->setUseCacheHash(FALSE);
		if ($pageType) {
			$uri->setTargetPageType($pageType);
		}
		if ($arguments) {
			$uri->setArguments($arguments);
		}
		$uri = rawurldecode($uri->build());
		if (strpos(substr($uri, 0, 1), '/') !== FALSE) {
			return ($addHost ? GeneralUtility::getIndpEnv('TYPO3_REQUEST_HOST') : NULL).$uri;
		}
		return ($addHost ? GeneralUtility::getIndpEnv('TYPO3_REQUEST_HOST') : NULL).'/'.$uri;
	}
	
}