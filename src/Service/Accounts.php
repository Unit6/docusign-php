<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign\Service;

use Unit6\DocuSign;
use Unit6\DocuSign\Model;
use Unit6\DocuSign\Exception;

/**
 * DocuSign Accounts Service Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Accounts extends DocuSign\Service
{
    /**
    * Constructs the internal representation of the DocuSign Accounts service.
    */
    public function __construct()
    {
        parent::__construct();
    }

    public function getResource($uri)
    {
        $resourceUri = ltrim($uri, '/');

        $url = $this->getEndpoint($resourceUri);

        return $this->request->get($url, $this->client->getHeaders());
    }

    /**
     * Create Account
     *
     * This creates a new account for using the DocuSign service.
     *
     * @param Model\Account $account
     */
    public function createAccount(Model\Account $account)
    {
        # POST /accounts
    }

    /**
     * Get Account Information
     *
     * This returns the account information for the specified account.
     */
    public function getAccount()
    {
        # GET /accounts/{accountId}
    }

    /**
     * Delete Account
     *
     * This deletes the specified account.
     */
    public function deleteAccount()
    {
        # DELETE /accounts/{accountId}
    }

    /**
     * Get Account Billing Plan
     *
     * This returns the billing plan information for the specified account.
     */
    public function getAccountBillingPlan()
    {
        # GET /accounts/{accountId}/billing_plan
    }

    /**
     * Update Account Billing Plan
     *
     * This updates the billing plan for the specified account.
     *
     * @param Model\BillingPlan $billingPlan
     */
    public function updateAccountBillingPlan(Model\BillingPlan $billingPlan)
    {
        # PUT /accounts/{accountId}/billing_plan
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
    public function updateAccountbillingPlanPurchasedEnvelopes(array $purchase = array())
    {
        # PUT /accounts/{accountId}/billing_plan/purchased_envelopes
    }

    /**
     * Get Brand Profile Information
     *
     * This returns a list of brand profiles associated with the account and
     * the default brand profiles. The Account Branding feature (accountSettings
     * "canSelfBrandSend" and "canSelfBrandSend" are true) must be enabled for
     * the account to use this.
     */
    public function getBrandProfile()
    {
        # GET /accounts/{accountId}/brands
    }

    /**
     * Upload Brand Profiles
     *
     * This is used to upload one or more brand profile files for the account.
     * The Account Branding feature (accountSettings "canSelfBrandSend"
     * and "canSelfBrandSend" are true) must be enabled for the account to
     * use this.
     *
     * When uploading brand profile files, if the brandId for a brand
     * profile already exisits for the account, an error is returned. If you
     * want to upload a new version of an existing brand profile, you should
     * delete the profile and then upload the newer version.
     *
     * When brand profile files are being uploaded, they must be combined
     * into one zip file and the ContentType must be application/zip.
     *
     * @param string $zipPath The path to the combined .zip file.
     */
    public function uploadBrandProfiles($zipPath)
    {
        # POST /accounts/{accountId}/brands
    }

    /**
     * Delete Brand Profiles
     *
     * This deletes one or more brand profiles from an account.
     * The Account Branding feature (accountSettings "canSelfBrandSend"
     * and "canSelfBrandSend" are true) must be enabled for the account
     * to use this.
     *
     * @param array $brands List of brand IDs to be deleted.
     */
    public function deleteBrandProfiles(array $brands = array())
    {
        $data = array(
            'brands' => array(
                array( 'brandId' => '' ),
                array( 'brandId' => '' ),
            )
        );

        # DELETE /accounts/{accountId}/brands
    }

    /**
     * Delete Captive Recipient Signature
     *
     * This deletes the signature for one or more captive recipient
     * records; it is primarily used for testing. This provides a way
     * to reset the signature associated with a clientUserId so a new
     * signature can be created the next time the clientUserId is used.
     *
     * @param array $recipients List of recipients
     */
    public function deleteCaptiveRecipientSignature(array $recipients = array())
    {
        $data = array(
            'captiveRecipients' => array(
                array( 'email' => '', 'userName' => '', 'clientUserId' => '', )
            )
        );
        # DELETE /accounts/{accountId}/captive_recipients/signature
    }

    /**
     * Get Consumer Disclosure
     *
     * This returns the consumer disclosure, with html formatting,
     * associated with the account. You can use an optional query
     * string to set the language for the consumer disclosure.
     *
     * @param string $langCode The simple type enumeration the
     *                         language used in the response.
     */
    public function getConsumerDisclaimer($langCode = '')
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
    }

    /**
     * Get List of Account Custom Fields
     *
     * This retrieves a list of envelope custom fields associated with the
     * account. These fields can be used in the envelopes for your account
     * to record information about the envelope, help search for envelopes
     * and track information. The envelope custom fields are shown in the
     * Envelope Settings section when a user is creating an envelope in
     * the DocuSign member console. The envelope custom fields are not
     * seen by the envelope recipients.
     *
     * There are two types of envelope custom fields, text and list. A text
     * custom field lets the sender enter the value for the field. The
     * list custom field lets the sender select the value of the field
     * from a premade list.
     */
    public function getCustomFields()
    {
        # GET /accounts/{accountId}/custom_fields
    }

    /**
     * Get Folder List
     *
     * Returns a list of the folders for the account, including the
     * folder hierarchy. There is an option to include the list of
     * template folders and templates.
     *
     * @param string $template The two possible values are "include" or "only."
     *                  - include: The folder list will return normal
     *                             folders plus template folders.
     *                  - only: Only the list of template folders are returned.
     */
    public function getFolders($template = '')
    {
        # GET /accounts/{accountId}/folders
        # ? template={string}
    }

    /**
     * Get Folder Envelope List
     *
     * Returns a list of the envelopes in the specified folder.
     * You can narrow the query by adding some optional items.
     *
     * @param string $folderId
     * @param array  $criteria Contains parameters:
     *                         - start_position={integer}
     *                         - from_date={date/time}
     *                         - to_date={date/time}
     *                         - search_text={text}
     *                         - status={envelope status}
     *                         - owner_name={username}
     *                         - owner_email={email}
     */
    public function getFolder($folderId, array $criteria = array())
    {
        # GET /accounts/{accountId}/folders/{folderId}
        # ? start_position={ integer}, from_date = {date/time}, to_date= {date/time},
        #      search_text={text}, status={envelope status}, owner_name={username},
        #      owner_email={email}
    }

    /**
     * Move Envelope
     *
     * This moves an envelope from its current folder to selected folder.
     *
     * Note: This can be used to delete envelopes by using "recyclebin" as folderId.
     *
     * @param string $folderId
     * @param string $fromFolderId The folder ID the envelope is being moved from.
     * @param array  $envelopeIds  The envelope ID for the envelope that is being moved.
     */
    public function updateFolder($folderId, $fromFolderId, array $envelopeIds = array())
    {
        $data = array(
            'envelopeIds'  => $envelopeIds,
            'fromFolderId' => $fromFolderId
        );

        # PUT /accounts/{accountId}/folders/{folderId}
    }

    /**
     * Get Group Information
     *
     * This retrieves information about groups associated with the account.
     */
    public function getGroups()
    {
        # GET /accounts/{accountId}/groups
    }

    /**
     * Add a New Group
     *
     * This adds one or more groups for the account. Groups can be used
     * to help manage users by associating users with a group. A group can be
     * associated with a Permission Profile, which sets the user permissions
     * for users in that group without having to set the userSettings for
     * each user. You are not required to set Permission Profiles for a group,
     * but this makes it easier to manage user permissions for a large number
     * of users. Groups can also be used with template sharing to limit user
     * access to templates.
     *
     * @param array $groups Collection of Model\Group
     */
    public function addGroups(array $groups = array())
    {
        $data = array(
            'groups' => $groups
        );

        # POST /accounts/{accountId}/groups
    }

    /**
     * Modify Group Information
     *
     * This lets you modify a group name and modify, or set, the
     * permission profile for the group.
     *
     * @param array $groups Collection of Model\Group
     */
    public function updateGroups(array $groups = array())
    {
        $data = array(
            'groups' => $groups
        );

        # PUT /accounts/{accountId}/groups
    }

    /**
     * Get Group Brand ID Information
     *
     * This returns information about the brands associated with
     * the requested group.
     *
     * @param string $groupId
     */
    public function getGroupBrands($groupId)
    {
        # GET /accounts/{accountId}/groups/{groupId}/brands
    }

    /**
     * Add Group Brand ID Information
     *
     * This adds brand information to a group.
     *
     * @param string $groupId
     * @param array  $brands  Collection of Model\Brand
     */
    public function addGroupBrands($groupId, $brands)
    {
        # PUT /accounts/{accountId}/groups/{groupId}/brands
    }

    /**
     * Delete Group Brand ID Information
     *
     * This removes brand information from the requested group.
     *
     * @param string $groupId
     * @param array $brands The brandId of the brand profile being removed
     *                      from the group.
     */
    public function deleteGroupBrands($groupId, array $brands = array())
    {
        $data = array(
            'brands' => array(
                array( 'brandId' => '' ),
                array( 'brandId' => '' ),
            )
        );

        # DELETE /accounts/{accountId}/groups/{groupId}/brands
    }

    /**
     * Get List of Users in a Group
     *
     * This retrieves a list of users in a group.
     *
     * @param string $groupId
     */
    public function getGroupUsers($groupId)
    {
        # GET /accounts/{accountId}/groups/{groupId}/users
    }

    /**
     * Add Users to a Group
     *
     * This adds one or more users to an existing group.
     *
     * @param string $groupId
     * @param array  $users   The user ID number for a user being added
     *                        to the group.
     */
    public function addGroupUsers($groupId, array $users = array())
    {
        $data = array(
            'users' => array(
                array( 'userId' => '' ),
                array( 'userId' => '' ),
            )
        );

        # PUT /accounts/{accountId}/groups/{groupId}/users
    }

    /**
     * Remove Users from a Group
     *
     * This removes one or more users from a group.
     *
     * @param string $groupId
     * @param array  $users    The user ID number for a user being removed
     *                         from the group.
     */
    public function deleteGroupUsers($groupId, array $users = array())
    {

        # DELETE /accounts/{accountId}/groups/{groupId}/users
    }

    /**
     * Get a List of Permission Profiles
     *
     * This retrieves list of Permission Profiles. Permission Profiles are
     * a standard set of user permissions that can be applied to individual
     * users or users in a Group. This makes it easier to manage user
     * permissions for a large number of users, without having to change
     * permissions on a user-by-user basis.
     *
     * Currently Permission Profiles can only be created and modified in
     * the DocuSign console.
     */
    public function getPermissionProfiles()
    {
        # GET /accounts/{accountId}/permission_profiles
    }

    /**
     * Get Recipient Names
     *
     * This returns a list of recipients that are available for the given
     * email address.
     *
     * @param string $email The email address for the user.
     */
    public function getRecipientNames($email)
    {
        # GET /accounts/{accountId}/recipient_names
    }

    /**
     * Get Account Settings
     *
     * This returns the account settings information for the specified account.
     */
    public function getSettings()
    {
        # GET /accounts/{accountId}/settings
    }

    /**
     * Modify Account Settings
     *
     * This updates the account settings list for the specified account.
     *
     * @param array $accountSettings The name/value pair information for
     *                               account settings. These determine the
     *                               features available for the account. See
     *                               the accountSettings list for more
     *                               information about the accountSettings.
     */
    public function updateSettings(array $accountSettings = array())
    {
        $data = array(
            'accountSettings' => array(
                array( 'name' => '', 'value' => '' ),
                array( 'name' => '', 'value' => '' )
            )
        );

        # PUT /accounts/{accountId}/settings
    }

    /**
     * Get List of Unsupported File Types
     *
     * Retrieves a list of file types (mime-types and file-extensions)
     * that are not supported for upload through the DocuSign system.
     */
    public function getUnsupportedFileTypes()
    {
        # GET /accounts/{accountId}/unsupported_file_types
    }

    /**
     * Get Account Provisioning Information
     *
     * This returns the account provisioning information.
     *
     * Note: This request requires a DocuSign Integrator Key and the
     * DocuSign AppToken information. The AppToken is used to determine
     * the account provisioning information that is returned and is
     * provided by the group provisioning the account.
     */
    public function getAccountProvisioning()
    {
        # GET /accounts/provisioning
    }

    /**
     * Get List of Billing Plans
     *
     * This returns the billing plans associated with a distributor.
     */
    public function getBillingPlans()
    {
        # GET /billing_plans
    }

    /**
     * Get Billing Plan Details
     *
     * This returns the billing plan details for the specified billing plan ID.
     *
     * @param string $planId
     */
    public function getBillingPlan($planId)
    {
        # GET /billing_plans/{planId}
    }
}