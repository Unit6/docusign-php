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
 * DocuSign Profile Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Profile extends DocuSign\Model
{
    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }
}