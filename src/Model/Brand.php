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
 * DocuSign Brand Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Brand extends DocuSign\Model
{
    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }

    public function setId($id)
    {
        $this->setBrandId($id);
    }

    public function getId()
    {
        return $this->getBrandId();
    }

    public function setName($name)
    {
        $this->setBrandName($name);
    }

    public function getName()
    {
        $this->getBrandName();
    }

    public function setCompany($company)
    {
        $this->setBrandCompany($company);
    }

    public function getCompany()
    {
        $this->getBrandCompany();
    }
}