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
 * DocuSign Credentials Interface
 *
 * @author Unit6 <team@unit6websites.com>
 */
interface CredentialsInterface
{
    /**
     * Instantiate an Instance of DocuSign Credentials
     *
     * @param array $config Settings which contains the key, email and password.
     *
     * @return void
     */
    public function __construct($config);

    /**
     * Checks whether the DocuSign credentials are empty or not.
     *
     * @return bool Outcome of whether any aspect of the key, email or password is empty.
     */
    public function isEmpty();

    /**
     * Set DocuSign Integrator Key
     *
     * @param string $integratorKey
     *
     * @return void
     */
    public function setIntegratorKey($integratorKey);

    /**
     * Get the DocuSign Integrator Key
     *
     * @return string
     */
    public function getIntegratorKey();

    /**
     * Set the DocuSign Account Email
     *
     * @param string $email
     *
     * @return void
     */
    public function setEmail($email);

    /**
     * Get the DocuSign Account Email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set the DocuSign Account/API Password
     *
     * @param string $password
     *
     * @return void
     */
    public function setPassword($password);

    /**
     * Get the DocuSign Account/API Password
     *
     * @return string
     */
    public function getPassword();
}