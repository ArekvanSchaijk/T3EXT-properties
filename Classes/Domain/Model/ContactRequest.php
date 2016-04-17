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
 * Class ContactRequest
 *
 * @package Ucreation\Properties
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class ContactRequest extends AbstractEntity {

    /**
     * @var int
     */
    protected $pid = 0;

    /**
     * @var string
     */
    protected $hash = '';

    /**
     * @var \Ucreation\Properties\Domain\Model\Object
     */
    protected $object = NULL;

    /**
     * @var string
     */
    protected $firstName = '';

    /**
     * @var string
     */
    protected $lastName = '';

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var string
     */
    protected $subject = '';

    /**
     * @var string
     */
    protected $body = '';

    /**
     * @var string
     */
    protected $receiverName = '';

    /**
     * @var string
     */
    protected $receiverEmail = '';

    /**
     * @var string
     */
    protected $ccName = '';

    /**
     * @var string
     */
    protected $ccEmail = '';

    /**
     * @var string
     */
    protected $bccName = '';

    /**
     * @var string
     */
    protected $bccEmail = '';

    /**
     * @var array|null
     */
    protected $validationErrors = NULL;

    /**
     * Get Pid
     *
     * @return int
     */
    public function getPid() {
        return $this->pid;
    }

    /**
     * Set Pid
     *
     * @param int $pid
     * @return void
     */
    public function setPid($pid) {
        $this->pid = $pid;
    }

    /**
     * Get Hash
     *
     * @return string
     */
    public function getHash() {
        return $this->hash;
    }

    /**
     * Set Hash
     *
     * @param string $hash
     * @return void
     */
    public function setHash($hash) {
        $this->hash = $hash;
    }

    /**
     * Generate Hash
     *
     * @return void
     */
    public function generateHash() {
        $this->hash = md5(time().$this->getFullName());
    }

    /**
     * Get Object
     *
     * @return \Ucreation\Properties\Domain\Model\Object
     */
    public function getObject() {
        return $this->object;
    }

    /**
     * Set Object
     *
     * @param \Ucreation\Properties\Domain\Model\Object $object
     * @inject
     */
    public function setObject(Object $object) {
        $this->object = $object;
    }

    /**
     * Get First Name
     *
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set First Name
     *
     * @param string $firstName
     * @return void
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    /**
     * Get Last Name
     *
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set Last Name
     *
     * @param string $lastName
     * @return void
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    /**
     * Get Full Name
     *
     * @return string
     */
    public function getFullName() {
        return $this->getFirstName().chr(32).$this->getLastName();
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
     * Get Subject
     *
     * @return string
     */
    public function getSubject() {
        return $this->subject;
    }

    /**
     * Set Subject
     *
     * @param string $subject
     * @return void
     */
    public function setSubject($subject) {
        $this->subject = $subject;
    }

    /**
     * Get Body
     *
     * @return string
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * Set Body
     *
     * @param string $body
     * @return void
     */
    public function setBody($body) {
        $this->body = $body;
    }

    /**
     * Get Receiver Name
     *
     * @return string
     */
    public function getReceiverName() {
        return $this->receiverName;
    }

    /**
     * Set Receiver Name
     *
     * @param string $receiverName
     * @return void
     */
    public function setReceiverName($receiverName) {
        $this->receiverName = $receiverName;
    }

    /**
     * Get Receiver Email
     *
     * @return string
     */
    public function getReceiverEmail() {
        return $this->receiverEmail;
    }

    /**
     * Set Receiver Email
     * @param string $receiverEmail
     * @return void
     */
    public function setReceiverEmail($receiverEmail) {
        $this->receiverEmail = $receiverEmail;
    }

    /**
     * Get CC Name
     *
     * @return string
     */
    public function getCcName() {
        return $this->ccName;
    }

    /**
     * Set CC Name
     *
     * @param string $ccName
     * @return void
     */
    public function setCcName($ccName) {
        $this->ccName = $ccName;
    }

    /**
     * Get CC Email
     *
     * @return string
     */
    public function getCcEmail() {
        return $this->ccEmail;
    }

    /**
     * Set CC Email
     *
     * @param string $ccEmail
     * @return void
     */
    public function setCcEmail($ccEmail) {
        $this->ccEmail = $ccEmail;
    }

    /**
     * Get BCC Name
     *
     * @return string
     */
    public function getBccName() {
        return $this->bccName;
    }

    /**
     * Set BCC Name
     *
     * @param string $bccName
     * @return void
     */
    public function setBccName($bccName) {
        $this->bccName = $bccName;
    }

    /**
     * Get BCC Email
     *
     * @return string
     */
    public function getBccEmail() {
        return $this->bccEmail;
    }

    /**
     * Set BCC Email
     *
     * @param string $bccEmail
     * @return void
     */
    public function setBccEmail($bccEmail) {
        $this->bccEmail = $bccEmail;
    }

    /**
     * Get Errors
     *
     * @return array
     */
    public function getValidationErrors() {
        if (is_null($this->validationErrors)) {
            $this->validationErrors = array();
            if (!$this->getFirstName()) {
                $this->validationErrors[] = 'error.object.contact.first_name.empty';
            }
            if (!$this->getLastName()) {
                $this->validationErrors[] = 'error.object.contact.last_name.empty';
            }
            if (!$this->getEmail()) {
                $this->validationErrors[] = 'error.object.contact.email.empty';
            } else {
                if (!filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL)) {
                    $this->validationErrors[] = 'error.object.contact.email.invalid';
                }
            }
            if (!$this->getSubject()) {
                $this->validationErrors[] = 'error.object.contact.subject.empty';
            }
            if (!$this->getBody()) {
                $this->validationErrors[] = 'error.object.contact.body.empty';
            }
        }
        return $this->validationErrors;
    }

    /**
     * Get Mail Sender
     *
     * @return array|null
     */
    public function getMailSender() {
        if ($this->getFullName() && $this->getEmail()) {
            return array($this->getEmail() => $this->getFullName());
        }
        return NULL;
    }

    /**
     * Get Mail Receiver
     *
     * @return array|null
     */
    public function getMailReceiver() {
        if ($this->getReceiverName() && $this->getReceiverName()) {
            return array($this->getReceiverEmail() => $this->getReceiverName());
        }
        return NULL;
    }

    /**
     * Get Mail CC
     *
     * @return array|null
     */
    public function getMailCc() {
        if ($this->getCcName() && $this->getCcEmail()) {
            return array($this->getCcEmail() => $this->getCcName());
        }
        return NULL;
    }

    /**
     * Get Mail BCC
     *
     * @return array|null
     */
    public function getMailBcc() {
        if ($this->getBccName() && $this->getBccEmail()) {
            return array($this->getBccEmail() => $this->getBccName());
        }
        return NULL;
    }

}