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

use Ucreation\Properties\Utility\LinkUtility;

/**
 * Class ContactRequestController
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class ContactRequestController extends BaseController {

    /**
     * @var \Ucreation\Properties\Domain\Repository\ContactRequestRepository
     * @inject
     */
    protected $contactRequestRepository = NULL;

    /**
     * Thank You Action
     *
     * @return void
     */
    public function thankYouAction() {
        if ($this->request->hasArgument(LinkUtility::CONTACT_REQUEST_HASH)) {
            if (($hash = $this->request->getArgument(LinkUtility::CONTACT_REQUEST_HASH))) {
                if (($contactRequest = $this->contactRequestRepository->findOneByHash($hash))) {
                    $this->view->assign('contactRequest', $contactRequest);
                }
            }
        }
    }

}