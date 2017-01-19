<?php
/**
 * DocuSign - ClientTest
 *
 * @package    DocuSign
 * @author     Unit6 <team@unit6websites.com>
 */

use Unit6\DocuSign;

class ClientTest extends PHPUnit_Framework_TestCase
{
    protected $config;
    protected $client;

    protected function setUp()
    {
        global $config;

        $this->config = $config;

        #$this->client = new DocuSign\Client();
    }

    protected function tearDown()
    {
        unset($this->config);
        unset($this->client);
    }

    /**
     * @expectedException        Unit6\DocuSign\Exception\Client
     * @expectedExceptionMessage options required
     * @expectedExceptionCode    0
     */
    public function testClientWithoutConfiguration()
    {
        $client = new DocuSign\Client();
    }

    public function testClientAuthenticationFailure()
    {
        $config = $this->config;

        $config['email']    = 'foobar@example.com';
        $config['password'] = 'foobar';

        $client = new DocuSign\Client($config);
        $client->authenticate();

        $this->assertTrue($client->hasError());
    }

    public function testClientAuthenticationSuccess()
    {
        $config = $this->config;

        $client = new DocuSign\Client($config);
        $client->authenticate();

        $this->assertFalse($client->hasError());

        return $client;
    }

    /**
     * @depends testClientAuthenticationSuccess
     */
    public function testClientIsValid(DocuSign\Client $client)
    {
        $this->assertNotNull($client->getBaseUrl());
        $this->assertNotNull($client->getAccountId());
    }
}