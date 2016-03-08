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
 * Class CategoryController
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class CategoryController extends BaseController {

    /**
     * @var \Ucreation\Properties\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository = NULL;

    /**
     * List Categories Action
     *
     * @return void
     */
    public function listCategoriesAction() {
        $categories = $this->categoryRepository->findAll();
        if ($categories) {
            $activeCategoryId = $this->objectService->getActiveCategoryId();
            // If there is no category active we might activate it when the setup requests this
            if (!$activeCategoryId) {
                if ($this->settings['categories']['autoActivateFirstCategory']) {
                    if (($category = $categories->getFirst())) {
                        $this->redirect(NULL, NULL, NULL, $this->objectService->getLinkArguments(array(LinkUtility::CATEGORY => $category->getUid())));
                        exit;
                    }
                }
            }
        }
        $this->view->assign('categories', $categories);
    }

}