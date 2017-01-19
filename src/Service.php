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
 * Abstract Service class for handling DocuSign requests.
 *
 * @author Unit6 <team@unit6websites.com>
 */
abstract class Service #implements ServiceInterface
{
    public function __construct()
    {
        //
    }

    public static function getClientHeaders()
    {
        $client = Client::getInstance();
        $headers = $client->getHeaders();

        return $headers;
    }

    public function getResource($uri)
    {
        $resourceUri = ltrim($uri, '/');

        $url = $this->getEndpoint($resourceUri);

        return $this->request->get($url, $this->client->getHeaders());
    }
}