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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class TemplateService
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class TemplateService {

    /**
     * @var string|null
     */
    protected $templateFilePath = NULL;

    /**
     * @var string|null
     */
    protected $partialRootPath = NULL;

    /**
     * @var string|null
     */
    protected $layoutRootPath = NULL;

    /**
     * @var array|null
     */
    protected $variables = NULL;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager = NULL;

    /**
     * Set Template Root Path
     *
     * @param string $templateFilePath
     * @return void
     */
    public function setTemplateFilePath($templateFilePath) {
        $this->templateFilePath = $templateFilePath;
    }

    /**
     * Set Partial Root Path
     *
     * @param string $partialRootPath
     * @return void
     */
    public function setPartialRootPath($partialRootPath) {
        $this->partialRootPath = $partialRootPath;
    }

    /**
     * Set Layout Root Path
     *
     * @param string $layoutRootPath
     * @return void
     */
    public function setLayoutRootPath($layoutRootPath) {
        $this->layoutRootPath = $layoutRootPath;
    }

    /**
     * Set Variables
     *
     * @param array $variables
     * @return void
     */
    public function setVariables(array $variables) {
        $this->variables = $variables;
    }

    /**
     * Render
     *
     * @return string
     * @throws \Ucreation\Properties\Exception
     */
    public function render() {
        if (!$this->templateFilePath) {
            throw new Exception('There is no template path set');
        }
        $view = $this->getNewViewInstance();
        $view->setFormat('html');
        // Set template path and filename
        $view->setTemplatePathAndFilename(
            GeneralUtility::getFileAbsFileName($this->templateFilePath)
        );
        // Set layout root path
        if ($this->layoutRootPath) {
            $view->setLayoutRootPaths($this->layoutRootPath);
        }
        // Assign multiple
        if ($this->variables) {
            $view->assignMultiple($this->variables);
        }
        return $view->render();
    }

    /**
     * Get New View Instance
     *
     * @return \TYPO3\CMS\Fluid\View\StandaloneView
     */
    protected function getNewViewInstance() {
        return $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
    }

}