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
    public static function getLoginInformation()
    {
        # GET /login_information

        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        return DocuSign\Request::get('login_information', $options);
    }

    /**
     * Update User Password
     *
     * Change the password for a user.
     */
    public function updatePassword($newPassword)
    {
        # PUT /login_information/password

        $credentials = $this->client->getCredentials();
        $headers = $this->client->getHeaders();

        $options = [
            'headers' => $headers,
            'json' => [
                'currentPassword' => $credentials->getPassword(),
                'email'           => $credentials->getEmail(),
                'newPassword'     => $newPassword
            ]
        ];

        return DocuSign\Request::put('login_information/password', $options);
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

        $options = [
            'headers' => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'token' => $token
            ]
        ];

        return DocuSign\Request::post('oauth2/revoke', $options);
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

        $credentials = $this->client->getCredentials();

        $options = [
            'headers' => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'grant_type' => 'password',
                'scope'      => 'api',
                'client_id'  => $credentials->getIntegratorKey(),
                'username'   => $credentials->getEmail(),
                'password'   => $credentials->getPassword()
            ]
        ];

        return DocuSign\Request::post('oauth2/token', $options);
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

        $credentials = $this->client->getCredentials();

        $options = [
            'headers' => [
                'Authorization' => 'bearer ' . $bearer,
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'grant_type' => 'password',
                'scope'      => 'api',
                'client_id'  => $credentials->getIntegratorKey(),
                'username'   => $username,
                'password'   => 'password'
            ]
        ];

        return DocuSign\Request::post('oauth2/token', $options);
    }
}