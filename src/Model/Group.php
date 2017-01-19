<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign\Model;

use Unit6\DocuSign;

/**
 * DocuSign Group Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Group extends DocuSign\Model
{
    const TYPE_ADMIN    = 'adminGroup';    // groupName=Administrators
    const TYPE_EVERYONE = 'everyoneGroup'; // groupName=Everyone
    const TYPE_CUSTOM   = 'customGroup';   // groupName={YourChosenGroupName}

    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }

    public function setId($id)
    {
        $this->setGroupId($id);
    }

    public function getId()
    {
        return $this->getGroupId();
    }

    public function setName($name)
    {
        $this->setGroupName($name);
    }

    public function getName()
    {
        $this->getGroupName();
    }
}