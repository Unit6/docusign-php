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
 * DocuSign Credentials Class
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Credentials implements CredentialsInterface
{
    private $integratorKey;
    private $email;
    private $password;

    public function __construct($config)
    {
        if (empty($config)) {
            throw new Exception\Authentication('DocuSign credentials are required.');
        }

        if ( ! isset($config['integrator_key'])) {
            throw new Exception\Authentication('DocuSign integrator key required.');
        }

        if ( ! isset($config['email'])) {
            throw new Exception\Authentication('DocuSign email required.');
        }

        if ( ! isset($config['password'])) {
            throw new Exception\Authentication('DocuSign password required.');
        }

        $this->integratorKey = $config['integrator_key'];
        $this->email         = $config['email'];
        $this->password      = $config['password'];
    }

    public function isEmpty()
    {
        return ( empty($this->integratorKey)
            || empty($this->email)
            || empty($this->password));
    }

    public function setIntegratorKey($integratorKey)
    {
        $this->integratorKey = $integratorKey;
    }

    public function getIntegratorKey()
    {
        return $this->integratorKey;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }
}