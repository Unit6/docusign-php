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
 * DocuSign Resource Interface.
 *
 * @author Unit6 <team@unit6websites.com>
 */
interface ServiceInterface
{
    /**
     * Create a DocuSign Service.
     *
     * @return void
     */
    public function __construct();

    /**
     * Get the DocuSign Endpoint.
     *
     * @param string $uri API Endpoint Resource
     *
     * @return string
     */
    public function getEndpoint($uri);

    /**
     * Get the DocuSign Client.
     *
     * @return DocuSign\Client
     */
    public function getClient();

    /**
     * Get the DocuSign Request.
     *
     * @return DocuSign\Request
     */
    public function getRequest();
}
