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
 * DocuSign Client Interface
 *
 * @author Unit6 <team@unit6websites.com>
 */
interface ClientInterface
{
    /**
     * Create a DocuSign Client.
     *
     * @param array $config Settings for client requests.
     *
     * @return void
     */
    public function __construct(array $config = array());

    /**
     * Set the DocuSign Client instance.
     *
     * @param DocuSign\Client $client
     *
     * @return void
     */
    public static function setInstance(Client $client);

    /**
     * Get the DocuSign Client instance.
     *
     * @return DocuSign\Client $client
     */
    public static function getInstance();

    /**
     * Attempt to authenticate with the DocuSign servers.
     *
     * @return void
     */
    public function authenticate();

    /**
     * Get Authorization Headers for DocuSign Authentication.
     *
     * @param string $accept      Set the accepted media type.
     * @param string $contentType Set the payload media type.
     *
     * @return array List of headers to send along with requests.
     */
    public function getHeaders($accept = 'Accept: application/json', $contentType = 'Content-Type: application/json');

    /**
     * Get DocuSign Credentials
     *
     * @return DocuSign\Credentials
     */
    public function getCredentials();

    /**
     * Get DocuSign Request
     *
     * @return DocuSign\Request
     */
    public function getRequest();

    /**
     * Get DocuSign API Version
     *
     * @return string
     */
    public function getVersion();

    /**
     * Get DocuSign Environment
     *
     * @return string
     */
    public function getEnvironment();

    /**
     * Get base URL of the DocuSign Account
     *
     * @return string
     */
    public function getBaseUrl();

    /**
     * Get DocuSign Account ID
     *
     * @return
     */
    public function getAccountID();

    /**
     * Get flag indicating if there are multiple DocuSign accounts.
     *
     * @return bool
     */
    public function hasMultipleAccounts();

    /**
     * Get flag indiciating a DocuSign error.
     *
     * @return bool
     */
    public function hasError();

    /**
     * Get DocuSign error message.
     *
     * @return string
     */
    public function getErrorMessage();
}