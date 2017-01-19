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
 * Tests for accounts settings and information.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class AccountsInformationTest extends \PHPUnit_Framework_TestCase
{
    protected function assertResponseIsOK($response)
    {
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('statusCode', $response);
        $this->assertArrayHasKey('json', $response);

        $this->assertEquals(200, $response['statusCode']);
    }

    protected function getOneOf($key, $response, $index = 0)
    {
        $json = $response['json'];

        $this->assertArrayHasKey($key, $json);

        $list = $json[$key];

        $this->assertNotEmpty($list);

        return $list[$index];
    }

    public function testAccountClient()
    {
        global $config;

        $client = new Client($config);

        return $client;
    }

    /**
     * @depends testAccountClient
     */
    public function xtest()
    {
        $response = Service\Accounts::xtest();

        var_dump($response, 'xtest'); exit;
    }

    /**
     * @depends testAccountClient
     */
    public function testAccountLogin($client)
    {
        $client->authenticate();
        $this->assertFalse($client->hasError());
    }

    /**
     * @depends testAccountLogin
     */
    public function testGetAccountInformation()
    {
        $response = Service\Accounts::getAccount();

        $this->assertResponseIsOK($response);

        $json = $response['json'];

        $this->assertArrayHasKey('currentPlanId', $json);
        $this->assertArrayHasKey('planName', $json);
        $this->assertArrayHasKey('planStartDate', $json);
        $this->assertArrayHasKey('planEndDate', $json);
        $this->assertArrayHasKey('billingPeriodStartDate', $json);
        $this->assertArrayHasKey('billingPeriodEndDate', $json);
        $this->assertArrayHasKey('billingPeriodEnvelopesSent', $json);
        $this->assertArrayHasKey('billingPeriodEnvelopesAllowed', $json);
        $this->assertArrayHasKey('billingPeriodDaysRemaining', $json);
        $this->assertArrayHasKey('canUpgrade', $json);
        $this->assertArrayHasKey('canCancelRenewal', $json);
        $this->assertArrayHasKey('envelopeSendingBlocked', $json);
        $this->assertArrayHasKey('envelopeUnitPrice', $json);
        $this->assertArrayHasKey('suspensionStatus', $json);
        $this->assertArrayHasKey('accountName', $json);
        $this->assertArrayHasKey('connectPermission', $json);
        $this->assertArrayHasKey('docuSignLandingUrl', $json);
        $this->assertArrayHasKey('distributorCode', $json);
        $this->assertArrayHasKey('accountIdGuid', $json);
        $this->assertArrayHasKey('currencyCode', $json);
        $this->assertArrayHasKey('forgottenPasswordQuestionsCount', $json);
        $this->assertArrayHasKey('paymentMethod', $json);
        $this->assertArrayHasKey('createdDate', $json);
        $this->assertArrayHasKey('isDowngrade', $json);
        $this->assertArrayHasKey('billingProfile', $json);
    }

    /**
     * @depends testAccountLogin
     */
    public function testGetAccountBillingPlan()
    {
        $response = Service\Accounts::getAccountBillingPlan();

        $this->assertResponseIsOK($response);

        $json = $response['json'];

        $this->assertArrayHasKey('billingPlan', $json);
        $this->assertArrayHasKey('successorPlans', $json);
        $this->assertArrayHasKey('billingAddress', $json);
        $this->assertArrayHasKey('billingAddressIsCreditCardAddress', $json);

        $billingPlan = $json['billingPlan'];

        $this->assertArrayHasKey('planId', $billingPlan);
        $this->assertArrayHasKey('planName', $billingPlan);
        $this->assertArrayHasKey('paymentCycle', $billingPlan);
        $this->assertArrayHasKey('paymentMethod', $billingPlan);
        $this->assertArrayHasKey('perSeatPrice', $billingPlan);
        $this->assertArrayHasKey('otherDiscountPercent', $billingPlan);
        $this->assertArrayHasKey('supportIncidentFee', $billingPlan);
        $this->assertArrayHasKey('supportPlanFee', $billingPlan);
        $this->assertArrayHasKey('includedSeats', $billingPlan);
        $this->assertArrayHasKey('enableSupport', $billingPlan);
        $this->assertArrayHasKey('currencyCode', $billingPlan);
        $this->assertArrayHasKey('seatDiscounts', $billingPlan);
    }

    /**
     * @depends testAccountLogin
     */
    public function testGetRecipientNames()
    {
        $email = DOCUSIGN_EMAIL;

        $response = Service\Accounts::getRecipientNames($email);

        $this->assertResponseIsOK($response);

        $json = $response['json'];

        $this->assertArrayHasKey('recipientNames', $json);
        $this->assertArrayHasKey('reservedRecipientEmail', $json);
        $this->assertArrayHasKey('multipleUsers', $json);
    }

    /**
     * @depends testAccountLogin
     */
    public function testGetUnsupportedFileTypes()
    {
        $response = Service\Accounts::getUnsupportedFileTypes();

        $this->assertResponseIsOK($response);

        $fileType = $this->getOneOf('fileTypes', $response);

        $this->assertArrayHasKey('fileExtension', $fileType);
        $this->assertArrayHasKey('mimeType', $fileType);
    }

    /**
     * @depends testAccountLogin
     */
    public function testGetCustomFields()
    {
        $response = Service\Accounts::getCustomFields();

        $this->assertResponseIsOK($response);

        $json = $response['json'];

        $this->assertArrayHasKey('textCustomFields', $json);
        $this->assertArrayHasKey('listCustomFields', $json);
    }

    /**
     * @depends testAccountLogin
     */
    public function testGetConsumerDisclaimer()
    {
        $langCode = 'en';

        $response = Service\Accounts::getConsumerDisclaimer($langCode);

        $this->assertResponseIsOK($response);

        $json = $response['json'];

        $this->assertArrayHasKey('accountEsignId', $json);
        $this->assertArrayHasKey('esignAgreement', $json);
        $this->assertNotEmpty($json['esignAgreement']);
    }
}