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
 * Tests for OAuth2 authorization.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class OAuth2AuthorizationTest extends \PHPUnit_Framework_TestCase
{
    protected $service;

    protected function setUp()
    {
        global $config;

        $client = new Client($config);
    }

    protected function tearDown()
    {
        unset($this->service);
    }

    public function testCreateOAuth2Token()
    {
        $response = Service\Authentication::getToken();

        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('statusCode', $response);
        $this->assertArrayHasKey('json', $response);

        $this->assertEquals(200, $response['statusCode']);

        $json = $response['json'];

        $this->assertArrayHasKey('access_token', $json);
        $this->assertArrayHasKey('token_type', $json);
        $this->assertArrayHasKey('scope', $json);

        $this->assertEquals(Model\OAuth2Token::SCOPE, $json['scope']);
        $this->assertEquals(Model\OAuth2Token::TYPE, $json['token_type']);

        return $json['access_token'];
    }

    /**
     * @depends testCreateOAuth2Token
     */
    public function testRevokeOAuth2Token($token)
    {
        $response = Service\Authentication::revokeToken($token);

        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('statusCode', $response);
        $this->assertEquals(200, $response['statusCode']);
    }
}