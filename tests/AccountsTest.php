<?php
/**
 * DocuSign - AccountsTest
 *
 * @package    DocuSign
 * @author     Unit6 <team@unit6websites.com>
 */

use Unit6\DocuSign;

class AccountsTest extends PHPUnit_Framework_TestCase
{
    protected $config;

    protected function setUp()
    {
        global $config;

        $this->config = $config;
    }

    protected function tearDown()
    {
        unset($this->config);
    }

    public function testServiceAccountAuthentication()
    {
        $client = new DocuSign\Client($this->config);

        $response = $client->authenticate();

        $this->assertFalse($client->hasError());

        $service = new DocuSign\Service\Accounts($client);
    }

    public function testGetAccountResource()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );

        $this->service->getResource($uri);
    }

    public function testCreateAccount()
    {
        # POST /accounts

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountInformation()
    {
        # GET /accounts/{accountId}

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testDeleteAccount()
    {
        # DELETE /accounts/{accountId}

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountBillingPlan()
    {
        # GET /accounts/{accountId}/billing_plan

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testUpdateAccountBillingPlan()
    {
        # PUT /accounts/{accountId}/billing_plan

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Purchase Additional Envelopes
     *
     * IMPORTANT: At this time, this operation is limited to DocuSign
     * internal use only.
     *
     * This completes the purchase of envelopes for your account. The actual
     * purchase is done as part of an internal workflow interaction with
     * an envelope vendor.
     */
    public function testPurchaseOfAdditionalEnvelopesForAccount()
    {
        # PUT /accounts/{accountId}/billing_plan/purchased_envelopes

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountBrandProfile()
    {
        # GET /accounts/{accountId}/brands

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testCreateAccountBrandProfiles()
    {
        # POST /accounts/{accountId}/brands

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testDeleteAccountBrandProfiles()
    {
        # DELETE /accounts/{accountId}/brands

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testDeleteAccountCaptiveRecipientSignature()
    {
        # DELETE /accounts/{accountId}/captive_recipients/signature

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountConsumerDisclosure()
    {
        # GET /accounts/{accountId}/consumer_disclosure
        # ? langCode={value}

        /*
        The supported languages, with
        the language value shown in parenthesis, are:
        Arabic (ar), Bulgarian (bg), Czech (cs), Chinese
        Simplified (zh-CN), Chinese Traditional (zhTW),
        Croatian (hr), Danish (da), Dutch (nl),
        English US (en), English UK (en-GB), Estonian
        (et), Farsi (fa), Finnish (fi), French (fr), French
        Canada (fr-CA), German (de), Greek (el),
        Hebrew (he), Hindi (hi), Hungarian (hu), Bahasa
        Indonesia (id), Italian (it), Japanese (ja), Korean
        (ko), Latvian (lv), Lithuanian (lt), Bahasa Melayu
        (ms), Norwegian (no), Polish (pl), Portuguese
        (pt), Portuguese Brazil (pt-BR), Romanian (ro),
        Russian (ru), Serbian (sr), Slovak (sk),
        Slovenian (sl), Spanish (es),Spanish Latin
        America (es-MX), Swedish (sv), Thai (th),
        Turkish (tr), Ukrainian (uk) and Vietnamese (vi).
        Additionally, the value can be set to ‘browser’ to
        automatically detect the browser language
        being used by the viewer and display the
        consumer disclosure in that language.
        */

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountCustomFields()
    {
        # GET /accounts/{accountId}/custom_fields

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountFolders()
    {
        # GET /accounts/{accountId}/folders
        # ? template={string}

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountFolder()
    {
        # GET /accounts/{accountId}/folders/{folderId}
        # ? start_position={ integer}, from_date = {date/time}, to_date= {date/time},
        #      search_text={text}, status={envelope status}, owner_name={username},
        #      owner_email={email}

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testUpdateAccountFolder()
    {
        # PUT /accounts/{accountId}/folders/{folderId}

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountGroups()
    {
        # GET /accounts/{accountId}/groups

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testCreateAccountGroups()
    {
        # POST /accounts/{accountId}/groups

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testUpdateAccountGroups()
    {
        # PUT /accounts/{accountId}/groups

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountGroupBrands()
    {
        # GET /accounts/{accountId}/groups/{groupId}/brands

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testCreateAccountGroupBrands()
    {
        # PUT /accounts/{accountId}/groups/{groupId}/brands

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testDeleteAccountGroupBrands()
    {
        # DELETE /accounts/{accountId}/groups/{groupId}/brands

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountGroupUsers()
    {
        # GET /accounts/{accountId}/groups/{groupId}/users

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testCreateAccountGroupUsers()
    {
        # PUT /accounts/{accountId}/groups/{groupId}/users

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testDeleteAccountGroupUsers()
    {
        # DELETE /accounts/{accountId}/groups/{groupId}/users

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountPermissionProfiles()
    {
        # GET /accounts/{accountId}/permission_profiles

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountRecipientNames()
    {
        # GET /accounts/{accountId}/recipient_names

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountSettings()
    {
        # GET /accounts/{accountId}/settings

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testUpdateAccountSettings()
    {
        # PUT /accounts/{accountId}/settings

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetListOfUnsupportedFileTypesForAccount()
    {
        # GET /accounts/{accountId}/unsupported_file_types

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testGetAccountProvisioning()
    {
        # GET /accounts/provisioning

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Test Retreiving Billing Plans
     *
     * Returns the plans associated with a distributor. To execute
     * this function you need to have a Distributor Code and Distributor
     * Password. Please contact your account administrator if you do
     * not have them.
     */
    public function testGetDistributorBillingPlans()
    {
        # GET /billing_plans

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Test Retreiving Billing Plan by ID
     *
     * Returns details on a particular plan id. To execute this
     * function you need to have a Distributor Code and Distributor
     * Password. Please contact your account administrator if you
     * do not have them.
     */
    public function testGetDistributorBillingPlanByID()
    {
        # GET /billing_plans/{planId}

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}