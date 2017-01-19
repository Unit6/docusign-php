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
 * DocuSign OAuth2 Token Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class OAuth2Token extends DocuSign\Model
{
    const SCOPE = 'api';
    const TYPE = 'bearer';

    public function __construct(array $row = array())
    {
        #$this->assignData($row, $map);

        // fix casing of these parameters.
        $map = [
            'access_token' => 'accessToken',
            'scope' => 'scope',
            'token_type' => 'tokenType',
        ];

        foreach ($map as $key => $value) {
            if (isset($key)) {
                $this->data[$value] = $row[$key];
            }
        }
    }
}