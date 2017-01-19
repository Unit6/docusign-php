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
 * Tests for login information.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class LoginInformationTest extends \PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        global $config;

        $client = new Client($config);
    }

    protected function tearDown()
    {
        unset($this->client);
    }

    public function testGetLoginInformation()
    {
        $response = Service\Authentication::getLoginInformation();

        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('statusCode', $response);
        $this->assertArrayHasKey('json', $response);

        $this->assertEquals(200, $response['statusCode']);

        $json = $response['json'];

        $this->assertArrayHasKey('loginAccounts', $json);
        $this->assertNotEmpty($json['loginAccounts']);

        $account = $json['loginAccounts'][0];

        $this->assertArrayHasKey('name', $account);
        $this->assertArrayHasKey('accountId', $account);
        $this->assertArrayHasKey('baseUrl', $account);
        $this->assertArrayHasKey('isDefault', $account);
        $this->assertArrayHasKey('userName', $account);
        $this->assertArrayHasKey('userId', $account);
        $this->assertArrayHasKey('email', $account);
        $this->assertArrayHasKey('siteDescription', $account);

        return $account;
    }


    /**
     * @depends testGetLoginInformation
     */
    public function testUpdateLoginInformationPassword(array $account)
    {
        $this->markTestSkipped(
            'Avoid changing the user password.'
        );

        $newPassword = 'foobar';

        exit;

        $response = Service\Authentication::updatePassword($newPassword);

        var_dump($response); exit;

        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('statusCode', $response);
        $this->assertArrayHasKey('json', $response);

        $this->assertEquals(200, $response['statusCode']);
    }
}