<?php
namespace Ucreation\Properties\Domain\Model;

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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class FilterOption
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class Contact extends AbstractEntity {

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $company = '';

    /**
     * @var string
     */
    protected $address = '';

    /**
     * @var string
     */
    protected $phone = '';

    /**
     * @var string
     */
    protected $secondaryPhone = '';

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var string
     */
    protected $website = '';

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
     * Get Company
     *
     * @return string
     */
    public function getCompany() {
        return $this->company;
    }

    /**
     * Set Company
     *
     * @param string $company
     * @return void
     */
    public function setCompany($company) {
        $this->company = $company;
    }

    /**
     * Get Address
     *
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set Address
     *
     * @param string $address
     * @return void
     */
    public function setAddress($address) {
        $this->address = $address;
    }

    /**
     * Get Phone
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set Phone
     *
     * @param string $phone
     * @return void
     */
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    /**
     * Get Secondary Phone
     *
     * @return string
     */
    public function getSecondaryPhone() {
        return $this->secondaryPhone;
    }

    /**
     * Set Secondary Phone
     *
     * @param string $secondaryPhone
     * @return void
     */
    public function setSecondaryPhone($secondaryPhone) {
        $this->secondaryPhone = $secondaryPhone;
    }

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set Email
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Get Website
     *
     * @return string
     */
    public function getWebsite() {
        return $this->website;
    }

    /**
     * Set Website
     *
     * @param string $website
     * @return void
     */
    public function setWebsite($website) {
        $this->website = $website;
    }

}