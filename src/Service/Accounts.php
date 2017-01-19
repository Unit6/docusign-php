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

    /**
     * Get Account Information
     *
     * This returns the account information for the specified account.
     *
     * GET /accounts/{accountId}
     */
    public static function getAccount($accountId = null)
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        // when requesting as a distributor, allow the specifing of accountId
        $uri = ($accountId ? sprintf('accounts/%s', $accountId) : '/');

        return DocuSign\Request::get($uri, $options);
    }

    /**
     * Get Account Billing Plan
     *
     * This returns the billing plan information for the specified account.
     *
     * GET /accounts/{accountId}/billing_plan
     */
    public static function getAccountBillingPlan($accountId = null)
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        // when requesting as a distributor, allow the specifing of accountId
        $uri = ($accountId ? sprintf('accounts/%s/', $accountId) : '')
            . 'billing_plan';

        return DocuSign\Request::get($uri, $options);
    }

    /**
     * Get Brand Profile Information
     *
     * This returns a list of brand profiles associated with the account and
     * the default brand profiles. The Account Branding feature (accountSettings
     * "canSelfBrandSend" and "canSelfBrandSend" are true) must be enabled for
     * the account to use this.
     *
     * GET /accounts/{accountId}/brands
     */
    public static function getBrandProfiles()
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        return DocuSign\Request::get('brands', $options);
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
     * POST /accounts/{accountId}/brands
     *
     * @param string $zipPath The path to the combined .zip file.
     */
    public static function uploadBrandProfiles($zipPath)
    {
        $headers = self::getClientHeaders();
        $headers['Content-Type'] = 'application/zip';

        $fh = (is_readable($zipPath) ? fopen($zipPath, 'r') : '');

        $options = [
            'headers' => $headers,
            'body' => $fh
        ];

        return DocuSign\Request::post('brands', $options);
    }

    /**
     * Delete Brand Profiles
     *
     * This deletes one or more brand profiles from an account.
     * The Account Branding feature (accountSettings "canSelfBrandSend"
     * and "canSelfBrandSend" are true) must be enabled for the account
     * to use this.
     *
     * DELETE /accounts/{accountId}/brands
     *
     * @param array $brands List of brand IDs to be deleted.
     */
    public static function deleteBrandProfiles(array $brandsList = array())
    {
        $brands = [];

        foreach ($brandsList as $brand) {
            if ($brand instanceof Model\Brand) {
                // only the GroupId is needed for deleting.
                $brands[] = ['brandId' => $brand->getId()];
            }
        }

        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'json' => [
                'brands' => $brands
            ]
        ];

        var_dump('deleteBrandProfiles', $options); exit;

        return DocuSign\Request::delete('brands', $options);
    }

    /**
     * Delete Captive Recipient Signature
     *
     * This deletes the signature for one or more captive recipient
     * records; it is primarily used for testing. This provides a way
     * to reset the signature associated with a clientUserId so a new
     * signature can be created the next time the clientUserId is used.
     *
     * DELETE /accounts/{accountId}/captive_recipients/signature
     *
     * @param array $recipients List of recipients
     */
    public static function deleteCaptiveRecipientSignature(array $recipients = array())
    {
        $captiveRecipients = [];

        foreach ($recipients as $recipient) {
            if ($recipient instanceof Model\Recipient) {
                $captiveRecipients[] = [
                    'email' => $recipient->getEmail(),
                    'userName' => $recipient->getUserName(),
                    'clientUserId' => $recipient->getClientUserId()
                ];
            }
        }

        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'json' => [
                'captiveRecipients' => $captiveRecipients
            ]
        ];

        var_dump('deleteCaptiveRecipientSignature', $options); exit;

        return DocuSign\Request::delete('captive_recipients/signature', $options);
    }

    /**
     * Get Consumer Disclosure
     *
     * This returns the consumer disclosure, with html formatting,
     * associated with the account. You can use an optional query
     * string to set the language for the consumer disclosure.
     *
     * The supported languages, with the language code shown in parenthesis, are:
     *      Arabic (ar), Bulgarian (bg), Czech (cs), Chinese
     *      Simplified (zh-CN), Chinese Traditional (zhTW),
     *      Croatian (hr), Danish (da), Dutch (nl),
     *      English US (en), English UK (en-GB), Estonian (et),
     *      Farsi (fa), Finnish (fi), French (fr), French Canada (fr-CA),
     *      German (de), Greek (el), Hebrew (he), Hindi (hi),
     *      Hungarian (hu), Bahasa Indonesia (id), Italian (it),
     *      Japanese (ja), Korean (ko), Latvian (lv), Lithuanian (lt),
     *      Bahasa Melayu (ms), Norwegian (no), Polish (pl),
     *      Portuguese (pt), Portuguese Brazil (pt-BR), Romanian (ro),
     *      Russian (ru), Serbian (sr), Slovak (sk), Slovenian (sl),
     *      Spanish (es),Spanish Latin America (es-MX), Swedish (sv),
     *      Thai (th), Turkish (tr), Ukrainian (uk) and Vietnamese (vi).
     *
     * Additionally, the value can be set to 'browser' to automatically
     * detect the browser language being used by the viewer and display
     * the consumer disclosure in that language.
     *
     * GET /accounts/{accountId}/consumer_disclosure?langCode={value}
     *
     * @param string $langCode The simple type enumeration the
     *                         language used in the response.
     */
    public static function getConsumerDisclaimer($langCode = '')
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'query' => []
        ];

        if ( ! empty($langCode)) {
            $options['query']['langCode'] = $langCode;
        }

        return DocuSign\Request::get('consumer_disclosure', $options);
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
     *
     * GET /accounts/{accountId}/custom_fields
     */
    public static function getCustomFields()
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        return DocuSign\Request::get('custom_fields', $options);
    }

    /**
     * Get Folder List
     *
     * Returns a list of the folders for the account, including the
     * folder hierarchy. There is an option to include the list of
     * template folders and templates.
     *
     * GET /accounts/{accountId}/folders?template={string}
     *
     * @param string $template The two possible values are "include" or "only."
     *                  - include: The folder list will return normal
     *                             folders plus template folders.
     *                  - only: Only the list of template folders are returned.
     */
    public static function getFolders($template = '')
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'query' => []
        ];

        if ( ! empty($template)) {
            $options['query']['template'] = $template;
        }

        return DocuSign\Request::get('folders', $options);
    }

    /**
     * Get Folder Envelope List
     *
     * Returns a list of the envelopes in the specified folder.
     * You can narrow the query by adding some optional items.
     *
     * GET /accounts/{accountId}/folders/{folderId}/?{query:criteria}
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
    public static function getFolder($folderId, array $criteria = array())
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'query' => $criteria
        ];

        $uri = sprintf('folders/%s', $folderId );

        return DocuSign\Request::get($uri, $options);
    }

    /**
     * Move Envelope
     *
     * This moves an envelope from its current folder to selected folder.
     *
     * Note: This can be used to delete envelopes by using "recyclebin" as folderId.
     *
     * PUT /accounts/{accountId}/folders/{folderId}
     *
     * @param string $folderId
     * @param string $fromFolderId The folder ID the envelope is being moved from.
     * @param array  $envelopeIds  The envelope ID for the envelope that is being moved.
     */
    public static function updateFolder($folderId, $fromFolderId, array $envelopeIds = array())
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'json' => [
                'envelopeIds'  => $envelopeIds,
                'fromFolderId' => $fromFolderId
            ]
        ];

        $uri = sprintf('folders/%s', $folderId );

        return DocuSign\Request::put($uri, $options);
    }

    /**
     * Get Group Information
     *
     * This retrieves information about groups associated with the account.
     *
     * GET /accounts/{accountId}/groups
     */
    public static function getGroups()
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        return DocuSign\Request::get('groups', $options);
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
     * POST /accounts/{accountId}/groups
     *
     * @param array $groups Collection of Model\Group
     */
    public static function addGroups(array $groupsList = array())
    {
        $groups = [];

        foreach ($groupsList as $group) {
            if ($group instanceof Model\Group) {
                $groups[] = $group->getData();
            }
        }

        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'json' => [
                'groups' => $groups
            ]
        ];

        return DocuSign\Request::post('groups', $options);
    }

    /**
     * Modify Group Information
     *
     * This lets you modify a group name and modify, or set, the
     * permission profile for the group.
     *
     * PUT /accounts/{accountId}/groups
     *
     * @param array $groups Collection of Model\Group
     */
    public static function updateGroups(array $groupsList = array())
    {
        $groups = [];

        foreach ($groupsList as $group) {
            if ($group instanceof Model\Group) {
                $groups[] = $group->getData();
            }
        }

        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'json' => [
                'groups' => $groups
            ]
        ];

        return DocuSign\Request::put('groups', $options);
    }

    /**
     * Delete Group Information
     *
     * This deletes an existing user group.
     *
     * DELETE /accounts/{accountId}/groups
     *
     * @param array $groups Collection of Model\Group
     */
    public static function deleteGroups(array $groupsList = array())
    {
        $groups = [];

        foreach ($groupsList as $group) {
            if ($group instanceof Model\Group) {
                // only the GroupId is needed for deleting.
                $groups[] = ['groupId' => $group->getId()];
            }
        }

        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'json' => [
                'groups' => $groups
            ]
        ];

        return DocuSign\Request::delete('groups', $options);
    }

    /**
     * Get Group Brand ID Information
     *
     * This returns information about the brands associated with
     * the requested group.
     *
     * GET /accounts/{accountId}/groups/{groupId}/brands
     *
     * @param string $groupId
     */
    public static function getGroupBrands($groupId)
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        $uri = sprintf('groups/%s/brands', $groupId);

        return DocuSign\Request::get($uri, $options);
    }

    /**
     * Add Group Brand ID Information
     *
     * This adds brand information to a group.
     *
     * PUT /accounts/{accountId}/groups/{groupId}/brands
     *
     * @param string $groupId
     * @param array  $brands  Collection of Model\Brand
     */
    public static function addGroupBrands($groupId, array $brandsList = array())
    {
        $brands = [];

        foreach ($brandsList as $brand) {
            if ($brand instanceof Model\Brand) {
                $brands[] = $brand->getData();
            }
        }

        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'json' => [
                'brands' => $brands
            ]
        ];

        $uri = sprintf('groups/%s/brands', $groupId);

        return DocuSign\Request::put($uri, $options);
    }

    /**
     * Delete Group Brand ID Information
     *
     * This removes brand information from the requested group.
     *
     * DELETE /accounts/{accountId}/groups/{groupId}/brands
     *
     * @param string $groupId
     * @param array $brands The brandId of the brand profile being removed
     *                      from the group.
     */
    public static function deleteGroupBrands($groupId, array $brandsList = array())
    {
        $brands = [];

        foreach ($brandsList as $brand) {
            if ($brand instanceof Model\Brand) {
                $brands[] = ['brandId' => $brand->getId()];
            }
        }

        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'json' => [
                'brands' => $brands
            ]
        ];

        $uri = sprintf('groups/%s/brands', $groupId);

        return DocuSign\Request::delete($uri, $options);
    }

    /**
     * Get List of Users in a Group
     *
     * This retrieves a list of users in a group.
     *
     * GET /accounts/{accountId}/groups/{groupId}/users
     *
     * @param string $groupId
     */
    public static function getGroupUsers($groupId)
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        $uri = sprintf('groups/%s/users', $groupId);

        return DocuSign\Request::get($uri, $options);
    }

    /**
     * Add Users to a Group
     *
     * This adds one or more users to an existing group.
     *
     * PUT /accounts/{accountId}/groups/{groupId}/users
     *
     * @param string $groupId
     * @param array  $users   The user ID number for a user being added
     *                        to the group.
     */
    public static function addGroupUsers($groupId, array $usersList = array())
    {
        $users = [];

        foreach ($usersList as $user) {
            if ($user instanceof Model\User) {
                $users[] = ['userId' => $user->getId()];
            }
        }

        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'json' => [
                'users' => $users
            ]
        ];

        $uri = sprintf('groups/%s/users', $groupId);

        return DocuSign\Request::put($uri, $options);
    }

    /**
     * Remove Users from a Group
     *
     * This removes one or more users from a group.
     *
     * DELETE /accounts/{accountId}/groups/{groupId}/users
     *
     * @param string $groupId
     * @param array  $users    The user ID number for a user being removed
     *                         from the group.
     */
    public static function deleteGroupUsers($groupId, array $usersList = array())
    {
        $users = [];

        foreach ($usersList as $user) {
            if ($user instanceof Model\User) {
                $users[] = ['userId' => $user->getId()];
            }
        }

        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'json' => [
                'users' => $users
            ]
        ];

        $uri = sprintf('groups/%s/users', $groupId);

        return DocuSign\Request::delete($uri, $options);
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
     *
     * GET /accounts/{accountId}/permission_profiles
     */
    public static function getPermissionProfiles()
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        return DocuSign\Request::get('permission_profiles', $options);
    }

    /**
     * Get Recipient Names
     *
     * This returns a list of recipients that are available for the given
     * email address.
     *
     * GET /accounts/{accountId}/recipient_names
     *
     * @param string $email The email address for the user.
     */
    public static function getRecipientNames($email)
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'query' => [
                'email' => $email
            ]
        ];

        return DocuSign\Request::get('recipient_names', $options);
    }

    /**
     * Get Account Settings
     *
     * This returns the account settings information for the specified account.
     *
     * GET /accounts/{accountId}/settings
     */
    public static function getSettings()
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        return DocuSign\Request::get('settings', $options);
    }

    /**
     * Modify Account Settings
     *
     * This updates the account settings list for the specified account.
     *
     * PUT /accounts/{accountId}/settings
     *
     * @param array $accountSettings The name/value pair information for
     *                               account settings. These determine the
     *                               features available for the account. See
     *                               the accountSettings list for more
     *                               information about the accountSettings.
     */
    public static function updateSettings(array $settingsList = array())
    {
        $settings = [];

        foreach ($settingsList as $name => $value) {
            $settings[] = ['name' => $name, 'value' => $value];
        }

        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'json' => $settings
        ];

        return DocuSign\Request::put('settings', $options);
    }

    /**
     * Get List of Unsupported File Types
     *
     * Retrieves a list of file types (mime-types and file-extensions)
     * that are not supported for upload through the DocuSign system.
     *
     * GET /accounts/{accountId}/unsupported_file_types
     */
    public static function getUnsupportedFileTypes()
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        return DocuSign\Request::get('unsupported_file_types', $options);
    }
}