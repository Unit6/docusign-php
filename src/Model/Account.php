<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign\Model;

use Unit6\DocuSign;

/**
 * DocuSign Account Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Account extends DocuSign\Model
{
    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }

    public function setName($name)
    {
        $this->setAccountName($name);
    }

    public function setSettings(array $information)
    {
        $item = [];

        // parse the information against the whitelist.
        foreach ($information as $key => $value) {
            if (isset(DocuSign\Parameters::$accountSettings[$key])) {
                $format = DocuSign\Parameters::$accountSettings[$key];
                if (   (is_string($format) && gettype($value) === $format)
                    || (is_array($format)  && in_array($value, $format))) {
                    $item[$key] = $value;
                }
            }
        }

        $this->setAccountSettings($item);
    }

    public function setAddress($information)
    {
        $this->filterData($information, [
            'address1',
            'address2',
            'city',
            'state',
            'postalCode',
            'country',
            'phone',
            'fax'
        ]);

        $this->setAddressInformation($information);
    }

    public function setCreditCard($information)
    {
        $this->filterData($information, [
            'cardNumber',
            'cardType',
            'expirationMonth',
            'expirationYear',
            'nameOnCard'
        ]);

        $this->setCreditCardInformation($information);
    }

    public function setDistributor($code, $password)
    {
        $this->setDistributorCode($code);
        $this->setDistributorPassword($password);
    }

    public function setPlan(Plan $plan)
    {
        $this->setPlanInformation($plan->getData());
    }

    public function setUser(User $user)
    {
        $this->setInitialUser($user->getData());
    }
}