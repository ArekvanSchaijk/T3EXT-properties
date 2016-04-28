<?php
namespace Ucreation\Properties\Controller;

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
use Ucreation\Properties\Domain\Model\ContactRequest;
use Ucreation\Properties\Exception;
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
	 * @var array
	 */
	protected $contactRequestErrors = array();

	/**
	 * @var \Ucreation\Properties\Domain\Repository\ContactRequestRepository
	 * @inject
	 */
	protected $contactRequestRepository = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager = NULL;

	/**
	 * List Action
	 * 
	 * @return string|void
	 */
	public function listAction() {
		// Determines if the filter form is posted
		if ($this->request->hasArgument('submitFilters')) {
			$this->performFiltersFormPost();
			exit;
		}
		// Determines if the filter was posted by ajax
		if ((int)GeneralUtility::_GP('ajax') == 1) {
			return $this->performFiltersAjaxFormPost();
		}
		$objects = $this->objectService->getFilteredObjects(NULL, NULL, NULL, 0, $this->getFilterService()->getQueryOrderings());
		$this->view->assign('objects', $objects);
	}
	
	/**
	 * Show Action
	 * 
	 * @param \Ucreation\Properties\Domain\Model\Object|null $object
	 * @param \Ucreation\Properties\Domain\Model\ContactRequest|null $contactRequest
	 * @return void
	 */
	public function showAction(Object $object = NULL, ContactRequest $contactRequest = NULL) {
		if (!$object) {
			self::getTypoScriptFrontendController()->pageNotFoundAndExit();
		}
		$this->view->assign('object', $object);
		// If the contact form is used
		if ((bool)$this->settings['object']['contact']['useContactForm']) {
			$this->processContactForm($object, $contactRequest);
		}
		// Get the filter arguments
		if (($filterArguments = self::getTypoScriptFrontendController()->fe_user->getKey('ses', 'tx_properties_filter_arguments'))) {
			$this->view->assign('filterArguments', $filterArguments);
		}
	}

	/**
	 * Related Action
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @return void
	 */
	public function relatedAction(Object $object) {
		$this->view->assign('object', $object);
		if ($object->getRelatedObjects()->count()) {
			$this->view->assign('type', 'related');
			$this->view->assign('relatedObjects', $object->getRelatedObjects());
		} else if ((bool)$this->settings['object']['related']['automaticallyCalculate']) {
			$limit = (int)$this->settings['object']['related']['limit'];
			$findBy = GeneralUtility::trimExplode(',', $this->settings['object']['related']['findBy']);
			$type = NULL;
			$relatedObjects = NULL;
			foreach ($findBy as $property) {
				switch ($property) {
					case 'category':
						if ($object->getCategory()) {
							$type = 'category';
							$relatedObjects = $this->objectService->getRelatedObjectsByCategory($object, $limit);
						}
						break;
					case 'town':
						$type = 'town';
						$relatedObjects = $this->objectService->getRelatedObjectsByTown($object, $limit);
						break;
				}
				if ($relatedObjects && $relatedObjects->count()) {
					break;
				}
			}
			$this->view->assign('type', $type);
			$this->view->assign('relatedObjects', $relatedObjects);
		}
	}

	/**
	 * Filters Action
	 *
	 * @return void
	 */
	public function filtersAction() {}

	/**
	 * Sub Filters Action
	 *
	 * @return void
	 */
	public function subFiltersAction() {}

	/**
	 * Map Data Action
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object|null $object
	 * @return string
	 */
	public function mapDataAction(Object $object = NULL) {
		$mapData = array(
			'objects' => array()
		);
		$objects = $this->objectService->getFilteredObjects(NULL, NULL, NULL, 0, NULL);
		foreach ($objects as $curObject) {
			// Processes the latitude/longitude
			$this->processObjectLatitudeLongitude($curObject);
			// Gets the map data
			$mapData['objects'][$curObject->getUid()] = $curObject->getMapData();
			$mapData['objects'][$curObject->getUid()]['current'] = FALSE;
			if ($object && $curObject->getUid() == $object->getUid()) {
				$mapData['objects'][$curObject->getUid()]['current'] = TRUE;
			}
			$mapData['objects'][$curObject->getUid()]['retrieveContentUrl'] =
				$this->getFrontendUri(
					$this->settings['object']['singlePid'],
					array(
						'tx_properties_pi1' => array(
							'object' => $curObject->getUid()
						)
					),
					FALSE,
					$this->settings['ajax']['retrieveMapInfoWindowObjectDetail']
				);

		}
		return json_encode($mapData);
	}

	/**
	 * Show Map Info Window Action
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @return void
	 */
	public function showMapInfoWindowAction(Object $object = NULL) {
		if ($object) {
			$this->view->assign('object', $object);
		}
	}

	/**
	 * Process Object Latitude Longitude
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @return void
	 */
	protected function processObjectLatitudeLongitude(Object $object) {
		if (
			$object->getDetermineLatlongAutomatic() &&
			(
				!$object->getLatitudeLongitudeMd5() ||
				md5($object->getLatitude().$object->getLongitude()) != $object->getLatitudeLongitudeMd5()
			)
		) {
			if (($output = GeneralUtility::getUrl('http://maps.google.com/maps/api/geocode/json?address='.rawurlencode($object->getFullAddress()).'&sensor=false'))) {
				$output = json_decode($output);
				if ($output->status == 'OK') {
					$object->setLatitude($output->results[0]->geometry->location->lat);
					$object->setLongitude($output->results[0]->geometry->location->lng);
					$object->setLatitudeLongitudeMd5(md5($output->results[0]->geometry->location->lat.$output->results[0]->geometry->location->lng));
					$this->getObjectService()->update($object);
				}
			}
		}
	}

	/**
	 * Perform Filters Form Post
	 *
	 * @return void
	 */
	protected function performFiltersFormPost() {
		// Gets the link arguments
		$linkArguments = $this->getObjectService()->getLinkArguments();
		// Stores it in an session
		self::getTypoScriptFrontendController()->fe_user->setKey('ses', 'tx_properties_filter_arguments', $linkArguments);
		self::getTypoScriptFrontendController()->fe_user->storeSessionData();
		$this->redirect(NULL, NULL, NULL, $linkArguments);
	}

	/**
	 * Perform Filters Ajax Form Post
	 *
	 * @return string
	 */
	protected function performFiltersAjaxFormPost() {
		// Gets the link arguments
		$linkArguments = $this->getObjectService()->getLinkArguments();
		// Stores it in an session
		self::getTypoScriptFrontendController()->fe_user->setKey('ses', 'tx_properties_filter_arguments', $linkArguments);
		self::getTypoScriptFrontendController()->fe_user->storeSessionData();
		return json_encode(
			array(
				'url' => $this->getFrontendUri(
					$this->settings['object']['listPid'],
					array(
						'tx_properties_pi1' => $linkArguments
					)
				),
				'ajaxUrl' => $this->getFrontendUri(
					$this->settings['object']['listPid'],
					array(
						'tx_properties_pi1' => $linkArguments
					),
					FALSE,
					$this->settings['ajax']['retrieveContentPageType']
				)
			)
		);
	}

	/**
	 * Process Contact Form
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @param \Ucreation\Properties\Domain\Model\ContactRequest|null $contactRequest
	 * @return void
	 * @throws \Ucreation\Properties\Exception
	 */
	protected function processContactForm(Object $object, ContactRequest $contactRequest = NULL) {
		if (!$contactRequest) {
			$this->view->assign(
				'contactRequest',
				$this->objectManager->get('Ucreation\\Properties\\Domain\\Model\\ContactRequest')
			);
		} else {
			// The contact request object has validation errors
			if ($contactRequest->getValidationErrors()) {
				foreach ($contactRequest->getValidationErrors() as $error) {
					$this->frontendMessage($error);
				}
				$this->view->assign('contactRequest', $contactRequest);
			} else {
				// Calculates the receiver
				if ((bool)$this->settings['object']['contact']['receiver']['useObjectContactDetails']) {
					if ($object->getContactDetails()) {
						$name = $object->getContactDetails()->getName();
						$email = $object->getContactDetails()->getEmail();
						if ($name && $email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
							$contactRequest->setReceiverName($name);
							$contactRequest->setReceiverEmail($email);
						}
					}
				}
				if (is_null($contactRequest->getMailReceiver())) {
					$name = $this->settings['object']['contact']['receiver']['name'];
					$email = $this->settings['object']['contact']['receiver']['email'];
					if ($name && $email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$contactRequest->setReceiverName($name);
						$contactRequest->setReceiverEmail($email);
					} else {
						throw new Exception('Invalid contact form receiver details given in the TypoScript setup');
					}
				}
				// Calculates the CC
				if (
					$this->settings['object']['contact']['receiver']['cc']['name'] &&
					$this->settings['object']['contact']['receiver']['cc']['email'] &&
					filter_var($this->settings['object']['contact']['receiver']['cc']['email'], FILTER_VALIDATE_EMAIL)
				) {
					$contactRequest->setCcName($this->settings['object']['contact']['receiver']['cc']['name']);
					$contactRequest->setCcEmail($this->settings['object']['contact']['receiver']['cc']['email']);
				}
				// Calculates the BCC
				if (
					$this->settings['object']['contact']['receiver']['bcc']['name'] &&
					$this->settings['object']['contact']['receiver']['bcc']['email'] &&
					filter_var($this->settings['object']['contact']['receiver']['bcc']['email'], FILTER_VALIDATE_EMAIL)
				) {
					$contactRequest->setBccName($this->settings['object']['contact']['receiver']['bcc']['name']);
					$contactRequest->setBccEmail($this->settings['object']['contact']['receiver']['bcc']['email']);
				}
				// Caldulates the storage pid
				$storagePid = ($this->settings['object']['contact']['contactRequestStoragePid'] ? : $this->settings['storagePid']);
				if ($storagePid) {
					$contactRequest->setPid($storagePid);
				}
				// Generates an security hash
				$contactRequest->generateHash();
				// Sets the object
				$contactRequest->setObject($object);
				// Adds the new contact rquest
				$this->contactRequestRepository->add($contactRequest);
				$this->persistenceManager->persistAll();
				// Sends the contact request email
				if ((bool)$this->settings['object']['contact']['receiver']['enableReceiverEmail']) {
					$this->sendContactRequestEmail($object, $contactRequest);
				}
				// Sends the contact request
				if ((bool)$this->settings['object']['contact']['thankYou']['confirmation']['enable']) {
					$this->sendContactRequestConfirmationEmail($object, $contactRequest);
				}
				// Thank you handling
				if ($this->settings['object']['contact']['thankYou']['pageId']) {
					$linkArguments = array();
					if ($this->settings['object']['contact']['thankYou']['arguments']['useObjectDetails']) {
						$linkArguments[LinkUtility::OBJECT] = $object->getUid();
					}
					if ($this->settings['object']['contact']['thankYou']['arguments']['useContactRequestDetails']) {
						$linkArguments[LinkUtility::CONTACT_REQUEST_HASH] = $contactRequest->getHash();
					}
					$this->redirect(NULL, NULL, NULL, $linkArguments, $this->settings['object']['contact']['thankYou']['pageId']);
				}
			}
		}
	}

	/**
	 * Send Contact Request Email
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @param \Ucreation\Properties\Domain\Model\ContactRequest $contactRequest
	 * @return void
	 * @throws \Ucreation\Properties\Exception
	 */
	protected function sendContactRequestEmail(Object $object, ContactRequest $contactRequest) {
		$templateInstance = $this->getTemplateServiceInstance();
		$templateInstance->setTemplateFilePath($this->settings['object']['contact']['templateFilePath']);
		$templateInstance->setVariables(
			array(
				'contactRequest' => $contactRequest,
				'objectUrl' => $this->getFrontendUri(
					$this->settings['object']['singlePid'],
					array(
						'tx_properties_pi1' => array(
							'object' => $object->getUid(),
						),
					),
					TRUE
				),
				'settings' => $this->settings,
			)
		);
		if (!$this->email(
			$templateInstance->render(),
			$contactRequest->getMailSender(),
			$contactRequest->getMailReceiver(),
			($this->settings['object']['contact']['receiver']['subject'] ? : $contactRequest->getSubject()),
			$contactRequest->getMailCc(),
			$contactRequest->getMailBcc()
		)) {
			throw new Exception('Email was not sent successfully');
		}
	}

	/**
	 * Send Contact Request Email Confirmation
	 *
	 * @param \Ucreation\Properties\Domain\Model\Object $object
	 * @param \Ucreation\Properties\Domain\Model\ContactRequest $contactRequest
	 * @return void
	 * @throws \Ucreation\Properties\Exception
	 */
	protected function sendContactRequestConfirmationEmail(Object $object, ContactRequest $contactRequest) {
		$templateInstance = $this->getTemplateServiceInstance();
		$templateInstance->setTemplateFilePath($this->settings['object']['contact']['thankYou']['confirmation']['templateFilePath']);
		$templateInstance->setVariables(
			array(
				'contactRequest' => $contactRequest,
				'objectUrl' => $this->getFrontendUri(
					$this->settings['object']['singlePid'],
					array(
						'tx_properties_pi1' => array(
							'object' => $object->getUid(),
						),
					),
					TRUE
				),
				'settings' => $this->settings,
			)
		);
		$sender = array($this->settings['object']['contact']['thankYou']['confirmation']['from']['email'] => $this->settings['object']['contact']['thankYou']['confirmation']['from']['name']);
		if (
			(bool)$this->settings['object']['contact']['thankYou']['confirmation']['from']['useObjectDetails'] &&
			(bool)$this->settings['object']['contact']['receiver']['useObjectContactDetails']
		) {
			$sender = $contactRequest->getMailReceiver();
		}
		if (!$this->email(
			$templateInstance->render(),
			$sender,
			$contactRequest->getMailSender(),
			$this->settings['object']['contact']['thankYou']['confirmation']['subject']
		)) {
			throw new Exception('Confirmation email was not sent successfully');
		}
	}

}