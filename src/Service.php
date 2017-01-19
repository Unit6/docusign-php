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
abstract class Service implements ServiceInterface
{
    protected $client;
    protected $request;

    public function __construct()
    {
        $this->client  = Client::getInstance();
        $this->request = $this->client->getRequest();
    }

    public function getEndpoint($uri)
    {
        // NOTE: The first request will authenticate on the standard endpoint.
        //       Once a baseUrl has been set, all subsequent requests should
        //       use that server endpoint.
        $baseUrl = $this->client->getBaseUrl();

        if ( ! is_null($baseUrl)) {
            $rootUrl = $baseUrl;
        } else {
            $rootUrl = sprintf(
                'https://%s.docusign.net/restapi/v%d',
                $this->client->getEnvironment(),
                $this->client->getVersion()
            );
        }

        return $rootUrl . '/' . $uri;;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getRequest()
    {
        return $this->request;
    }
}