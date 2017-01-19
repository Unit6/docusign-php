<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign\Service;

use Unit6\DocuSign;
use Unit6\DocuSign\Exception;

/**
 * DocuSign Authentication Service Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Authentication extends DocuSign\Service
{
    /**
    * Constructs the internal representation of the DocuSign Authentication service.
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Post Authentication View
     *
     * This provides a URL to start the authentication view of the DocuSign UI.
     */
    public function getAuthenticationView()
    {
        # POST /accounts/{accountId}/views/console

        $service = new Service\Views();

        return $service->createAuthenticationView();
    }

    /**
     * Logging in
     *
     * Before sending any requests, you need to login to the system
     * to get the account and baseUrl information for future calls.
     */
    public function getLoginInformation()
    {
        # GET /login_information

        $this->url = $this->getEndpoint('login_information');

        return $this->request->get($this->url, $this->client->getHeaders());
    }

    /**
     * Update User Password
     *
     * Change the password for a user.
     */
    public function updatePassword($newPassword)
    {
        # PUT /login_information/password

        $this->url = $this->getEndpoint('login_information/password');

        $credentials = $this->client->getCredentials();

        $data = array(
            'currentPassword' => $credentials->getPassword(),
            'email'           => $credentials->getEmail(),
            'newPassword'     => $newPassword
        );

        $json = json_encode($data);

        return $this->request->put(
            $this->url,
            $this->client->getHeaders(),
            array(),
            $json
        );
    }

    /**
     * Revoking Tokens
     *
     * Specify which OAuth2 access_token to revoke. That token is then
     * no longer valid and attempts to use it will result in an error response.
     */
    public function revokeToken($token)
    {
        # POST /oauth2/revoke

        $this->url = $this->getEndpoint('oauth2/revoke');

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        );

        $data = array(
            'token' => $token
        );

        $query = http_build_query($data);

        return $this->request->post($this->url, $headers, array(), $query);
    }


    /**
     * OAuth2 Token Request
     *
     * Obtain an access token that can be stored locally with the
     * client. Once authentication is complete, the access token
     * is used instead of the username/password/integrator key
     * combination for all API calls.
     */
    public function getToken()
    {
        # POST /oauth2/token

        $this->url = $this->getEndpoint('oauth2/token');

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        );

        $credentials = $this->client->getCredentials();

        $data = array (
            'grant_type' => 'password',
            'scope'      => 'api',
            'client_id'  => $credentials->getIntegratorKey(),
            'username'   => $credentials->getEmail(),
            'password'   => $credentials->getPassword()
        );

        $query = http_build_query($data);

        return $this->request->post($this->url, $headers, array(), $query);
    }

    /**
     * Acting As Other Account Users
     *
     * The authenticating user can also obtain access_tokens for
     * other members in the account.
     */
    public function getTokenOnBehalfOf($username, $bearer)
    {
        # POST /oauth2/token

        $this->url = $this->getEndpoint('oauth2/token');

        $headers = array(
            'Authorization: bearer ' . $bearer,
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        );

        $credentials = $this->client->getCredentials();

        $data = array(
            'grant_type' => 'password',
            'scope'      => 'api',
            'client_id'  => $credentials->getIntegratorKey(),
            'username'   => $username,
            'password'   => 'password'
        );

        $query = http_build_query($data);

        return $this->request->post($this->url, $headers, array(), $query);
    }
}