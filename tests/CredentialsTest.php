<?php
/**
 * DocuSign - CredentialsTest
 *
 * @package    DocuSign
 * @author     Unit6 <team@unit6websites.com>
 */

use Unit6\DocuSign;

class CredentialsTest extends PHPUnit_Framework_TestCase
{
    protected $config;
    protected $credentials;

    protected function setUp()
    {
        global $config;

        $this->config = $config;
    }

    protected function tearDown()
    {
        unset($this->config);
        unset($this->credentials);
    }

    /**
     * @expectedException        Unit6\DocuSign\Exception\Authentication
     * @expectedExceptionMessage credentials are required
     * @expectedExceptionCode    0
     */
    public function testCredentialsFailsWithoutConfiguration()
    {
        $config = array();

        $credentials = new DocuSign\Credentials($config);
    }

    /**
     * @expectedException        Unit6\DocuSign\Exception\Authentication
     * @expectedExceptionMessage integrator key required
     * @expectedExceptionCode    0
     */
    public function testCredentialFailsWithoutIntegratorKey()
    {
        $config = $this->config;

        unset($config['integrator_key']);

        $credentials = new DocuSign\Credentials($config);
    }

    /**
     * @expectedException        Unit6\DocuSign\Exception\Authentication
     * @expectedExceptionMessage email required
     * @expectedExceptionCode    0
     */
    public function testCredentialFailsWithoutEmail()
    {
        $config = $this->config;

        unset($config['email']);

        $credentials = new DocuSign\Credentials($config);
    }

    /**
     * @expectedException        Unit6\DocuSign\Exception\Authentication
     * @expectedExceptionMessage password required
     * @expectedExceptionCode    0
     */
    public function testCredentialFailsWithoutPassword()
    {
        $config = $this->config;

        unset($config['password']);

        $credentials = new DocuSign\Credentials($config);
    }

    public function testCredentialsAreNotEmpty()
    {
        $config = $this->config;

        $credentials = new DocuSign\Credentials($config);

        $this->assertFalse($credentials->isEmpty());

        return $credentials;
    }

    /**
     * @depends testCredentialsAreNotEmpty
     */
    public function testCredentialsIntegratorKey(DocuSign\Credentials $credentials)
    {
        $expected = $this->config['integrator_key'];
        $changed = 'foobar';

        $this->assertEquals($expected, $credentials->getIntegratorKey());

        $credentials->setIntegratorKey($changed);

        $this->assertEquals($changed, $credentials->getIntegratorKey());
    }

    /**
     * @depends testCredentialsAreNotEmpty
     */
    public function testCredentialsEmail(DocuSign\Credentials $credentials)
    {
        $expected = $this->config['email'];
        $changed = 'foobar@example.com';

        $this->assertEquals($expected, $credentials->getEmail());

        $credentials->setEmail($changed);

        $this->assertEquals($changed, $credentials->getEmail());
    }

    /**
     * @depends testCredentialsAreNotEmpty
     */
    public function testCredentialsPassword(DocuSign\Credentials $credentials)
    {
        $expected = $this->config['password'];
        $changed = 'foo.password.bar';

        $this->assertEquals($expected, $credentials->getPassword());

        $credentials->setPassword($changed);

        $this->assertEquals($changed, $credentials->getPassword());
    }
}