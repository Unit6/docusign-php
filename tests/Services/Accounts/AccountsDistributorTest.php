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
 * Tests for distributor account actions.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class AccountsDistributorTest extends \PHPUnit_Framework_TestCase
{
    protected function assertResponseIsOK($response)
    {
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('statusCode', $response);
        $this->assertArrayHasKey('json', $response);

        $this->assertEquals(200, $response['statusCode']);
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
    public function testGetBillingPlans()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
            . ' A DocuSign DistributorCode or Password is required.'
        );

        $response = Service\Accounts::getBillingPlans();

        var_dump($response, 'testGetBillingPlans'); exit;
    }

    /**
     * @depends testGetBillingPlans
     */
    public function testGetBillingPlanInformation($planId)
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
            . ' A DocuSign DistributorCode or Password is required.'
        );

        $response = Service\Accounts::getBillingPlanInformation($planId);

        var_dump($response, 'testGetBillingPlanInformation'); exit;
    }

    /**
     * @depends testAccountClient
     */
    public function testGetAccountProvisioning()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
            . ' A DocuSign-AppToken is required.'
        );

        $appToken = '';

        $response = Service\Accounts::getAccountProvisioning($appToken);

        var_dump($response, 'testGetAccountProvisioning'); exit;
    }

    /**
     * @depends testAccountClient
     */
    public function testAccountLogin($client)
    {
        $client->authenticate();
        $this->assertFalse($client->hasError());
    }

    public function testBuildInitialUser()
    {
        $user = new Model\User([
            'activationAccessCode' => 'xyzabc',
            'email' => 'john.smith@example.com',
            'password' => 'secret',
            'title' => 'Mr',
            'firstName' => 'John',
            'middleName' => 'F.',
            'lastName' => 'Smith',
            'suffixName' => 'Jr',
            'userName' => 'John Smith',
            'enableConnectForUser' => true,
            'sendActivationOnInvalidLogin' => true
        ]);

        $user->setForgottenPassword([
            ['question' => 'What is the foo?',  'answer' => 'Bar'],
            ['question' => 'How many bar?',     'answer' => 'Foo'],
            ['question' => 'When is your foo?', 'answer' => 'FooBar'],
            ['question' => 'What is a bar?',    'answer' => 'BarFoo'],
        ]);

        $user->setGroups([
            [
                'groupId' => '',
                'groupName' => '',
                'permissionProfileId' => '',
                'groupType' => ''
            ]
        ]);

        $user->setSettings([
            'allowBulkRecipients' => true,
            'locale' => 'en',
        ]);

        $this->assertNotEmpty($user->getData());

        return $user;
    }

    public function testBuildPlanInformation()
    {
        $feature1 = new Model\PlanFeature([
            'name' => 'Basic Feature 1',
            'featureSetId' => 'Basic1',
            'envelopeFee' => '0.20',
            'fixedFee' => '1.00',
            'seatFee' => '0.50'
        ]);

        $feature1->addCurencyPrice([
            'currencyCode' => 'GBP',
            'currencySymbol' => '£',
            'envelopeFee' => '0.50',
            'fixedFee' => '20.00',
            'seatFee' => '1.50'
        ]);

        $feature1->setEnabled(true);
        $feature1->setActive(true);

        $feature2 = new Model\PlanFeature([
            'name' => 'Basic Feature 2',
            'featureSetId' => 'Basic2',
            'envelopeFee' => '0.25',
            'fixedFee' => '1.05',
            'seatFee' => '0.55'
        ]);

        $feature2->setEnabled(true);
        $feature2->setActive(false);

        $plan = new Model\Plan([
            'currencyCode' => 'USD',
            'planId' => 'XYZ123'
        ]);

        $plan->addFeature($feature1);
        $plan->addFeature($feature2);

        $this->assertNotEmpty($plan->getData());

        return $plan;
    }

    /**
     * @depends testBuildInitialUser
     * @depends testBuildPlanInformation
     */
    public function testBuildAccount($user, $plan)
    {
        $account = new Model\Account();

        $account->setName('Foobar Co.');

        $account->setSettings([
            'allowEnvelopeCorrect' => false,
            'allowInPerson' => true,
            'allowOfflineSigning' => true,
            'canSelfBrandSend' => false,
            'canSelfBrandSign' => false
        ]);

        $account->setAddress([
            'address1' => '1301 2nd Ave.',
            'address2' => 'Suite 2000',
            'city' => 'Seattle',
            'country' => 'United States',
            'phone' => '(206) 219-0200',
            'postalCode' => '98101',
            'state' => 'Washington'
        ]);

        $account->setCreditCard([
            'cardNumber' => '5432109876543210',
            'cardType' => 'Mastercard',
            'expirationMonth' => date('m', strtotime('+1 month')),
            'expirationYear' => date('Y', strtotime('+1 year')),
            'nameOnCard' => 'John Smith'
        ]);



        $account->setDistributor('code', 'password');
        $account->setUser($user);
        $account->setPlan($plan);

        $account->setReferralInformation([
            'referralCode' => 'DISCOUNT1',
            'referrerName' => 'Discount 1'
        ]);

        $account->setSocialAccountInformation([
            'email'    => $user->getEmail(),
            'provider' => 'Twitter',
            'userName' => 'johnSmith'
        ]);

        $this->assertNotEmpty($account->getData());

        return $account;
    }

    /**
     * @depends testBuildAccount
     */
    public function testCreateAccount($account)
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

        $this->assertInstanceOf(__NAMESPACE__ . '\Model\Account', $account);
        $this->assertNotEmpty($account->getData());

        #$response = Service\Accounts::createAccount($account);
        #var_dump($response); exit;
    }
}