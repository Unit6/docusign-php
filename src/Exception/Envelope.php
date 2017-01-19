<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign\Exception;

use Unit6\DocuSign;

/**
 * DocuSign Envelope Exception Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Envelope extends DocuSign\Exception
{
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}