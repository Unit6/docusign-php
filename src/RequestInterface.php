<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign;

/**
 * Request interface for handling DocuSign requests.
 *
 * @author Unit6 <team@unit6websites.com>
 */
interface RequestInterface
{
    /**
     * Execute a cURL request.
     *
     * @param string     $method   HTTP method used.
     * @param string     $url      Endpoint
     * @param array      $headers  Assign the request headers.
     * @param array      $params   Additional parameters.
     * @param array|null $data     Data payload to be sent.
     *
     * @return array     $response Outcome of the request.
     */
    public static function execute($method = 'GET', $uri, array $options = array());
}
