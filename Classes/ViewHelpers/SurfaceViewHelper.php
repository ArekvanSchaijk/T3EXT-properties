<?php
namespace Ucreation\Properties\ViewHelpers;

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

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class SurfaceViewHelper
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class SurfaceViewHelper extends AbstractViewHelper {

    /**
     * Render
     *
     * @param int $lotSize
     * @param int $livingArea
     * @param string $unit
     * @param string $hyphen
     * @param string $thousandsSeparator
     * @return string
     */
    public function render($lotSize = 0, $livingArea = 0, $unit = ' m&sup2;', $hyphen = ' / ', $thousandsSeparator = '.') {
        $lotSize = number_format($lotSize, 0, NULL, $thousandsSeparator);
        $livingArea = number_format($livingArea, 0, NULL, $thousandsSeparator);
        $string = '';
        if ($lotSize) {
            $string = $lotSize.$unit;
            if ($livingArea) {
                $string = $livingArea.$unit.$hyphen.$string;
            }
        } else if ($livingArea) {
            $string = $livingArea.$unit;
        }
        return $string;
    }

}