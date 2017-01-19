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
 * DocuSign Signature Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Signature extends DocuSign\Model
{
    // signtaureFont
    const FONT_1           = '1_DocuSign';
    const FONT_2           = '2_DocuSign';
    const FONT_3           = '3_DocuSign';
    const FONT_4           = '4_DocuSign';
    const FONT_5           = '5_DocuSign';
    const FONT_6           = '6_DocuSign';
    const FONT_7           = '7_DocuSign';
    const FONT_8           = '8_DocuSign';
    const FONT_MISTRAL     = 'Mistral';
    const FONT_RAGE_ITALIC = 'Rage Italic';

    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }
}