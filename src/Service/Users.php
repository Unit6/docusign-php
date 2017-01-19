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
 * DocuSign Users Service Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Users extends DocuSign\Service
{
    public $userId;

    /**
    * Constructs the internal representation of the DocuSign Users service.
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get User List
     *
     * This returns a list of users for the specified account.
     *
     * GET /accounts/{accountId}/users?additional_info={true/false}
     *
     * @param boolean $additionalInfo When true, the full list of user information
     *                                is returned for each user in the account.
     */
    public static function getUsers($additionalInfo = false)
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers,
            'query' => [
                'additionalInfo' => ($additionalInfo ? 'true' : 'false')
            ]
        ];

        return DocuSign\Request::get('users', $options);
    }

    /**
     * Add User to Account
     *
     * This adds new users to your account.
     *
     * @param array $users Collection of Model\User instances.
     */
    public function addUsers(array $users = array())
    {
        # POST /accounts/{accountId}/users
    }

    /**
     * Close a User
     *
     * This closes one or more user records in the account. Users are
     * never deleted from an account, but closing a user prevents them
     * from using account functions.
     *
     * @param array $users List of userId and userName.
     */
    public function closeUsers(array $users = array())
    {
        $data = array(
            array('userId' => '', 'userName' => ''),
            array('userId' => '', 'userName' => ''),
        );

        # DELETE /accounts/{accountId}/users
    }

    /**
     * Get User Information
     *
     * This retrieves the user information for specified user.
     */
    public function getUser()
    {
        # GET /accounts/{accountId}/users/{userId}
    }

    /**
     * Get Custom User Settings
     *
     * This retrieves a list of custom user settings for a single user.
     *
     * Custom settings are a flexible way to store and retrieve custom
     * user information that can be used in your own system.
     *
     * Note: Custom user settings are not the same as user account settings.
     */
    public function getUserCustomSettings()
    {
        # GET /accounts/{accountId}/users/{userId}/custom_settings
    }

    /**
     * Add or Modify Custom User Settings
     *
     * This allows you to add or update custom user settings for a single user.
     *
     * @param array $settings List of settings with name and value keys.
     */
    public function updateUserCustomSettings(array $settings = array())
    {
        $data = array(
            'customSettings' => array(
                array( 'name' => '', 'value' => '' ),
                array( 'name' => '', 'value' => '' ),
            )
        );

        # PUT /accounts/{accountId}/users/{userId}/custom_settings
    }

    /**
     * Delete Custom User Settings
     *
     * This deletes the specified custom user settings for a single user.
     *
     * @param array $settings List of settings with name and value keys.
     */
    public function deleteUserCustomSettings(array $settings = array())
    {
        # DELETE /accounts/{accountId}/users/{userId}/custom_settings
    }

    /**
     * Get User Profile
     *
     * This returns user profile information, the privacy settings and
     * personal information (address, phone number, etc.).
     */
    public function getUserProfile()
    {
        # GET /accounts/{accountId}/users/{userId}/profile
    }

    /**
     * Modify User Profile
     *
     * This sets the user's detail information, profile information,
     * privacy settings and personal information in the user ID card.
     *
     * This can also be used to change a user's name by changing the
     * information in the user details (userDetails). When changing a
     * user's name, you can either change the information in the userName
     * OR change the information in firstName, middleName, lastName,
     * suffixName and title. Changes to firstName, middleName, lastName,
     * suffixName and title take precedence over changes to the userName.
     *
     * Note: The userId specified in the uri must match the authenticated
     * user'∂s userId and the user must be a member of the account.
     */
    public function updateUserProfile()
    {
        # PUT /accounts/{accountId}/users/{userId}/profile
    }

    /**
     * Get User Profile Image
     *
     * This returns the user profile picture. The image is returned
     * in the same format as uploaded.
     */
    public function getUserProfileImage()
    {
        # GET /accounts/{accountId}/users/{userId}/profile/image
    }

    /**
     * Modify User Profile Image
     *
     * This uploads an image to the user profile. The supported image
     * formats for this file are: gif, png, jpeg, and bmp. The file
     * must be less than 200K. For best viewing results, DocuSign
     * recommends that the image is no more than 79 pixels wide and high.
     *
     * Note: The userId specified in the uri must match the authenticated
     * user's userId and the user must be a member of the account.
     */
    public function updateUserProfileImage()
    {
        # PUT /accounts/{accountId}/users/{userId}/profile/image
    }

    /**
     * Delete User Profile Image
     *
     * This removes the image from the user profile.
     */
    public function deleteUserProfileImage()
    {
        # DELETE /accounts/{accountId}/users/{userId}/profile/image
    }

    /**
     * Get User Account Settings
     *
     * This returns the account settings list for the specified user.
     */
    public function getUserAccountSettings()
    {
        # GET /accounts/{accountId}/users/{userId}/settings
    }

    /**
     * Modify User Account Settings
     *
     * This updates the account settings list for the specified user.
     */
    public function updateUserAccountSettings()
    {
        # PUT /accounts/{accountId}/users/{userId}/settings
    }

    /**
     * Get a List of User Signature Definitions
     *
     * This returns the signature definitions for the specified user.
     *
     * Note: The userId specified in the uri must match the authenticated
     * user’s userId and the user must be a member of the account.
     *
     * Since the {signatureName} is a string name of a user that likely
     * includes spaces, you might need to URL encode the signatureName
     * before using the URL. For example: "Bob Smith" to "Bob%20Smith"
     */
    public function getUserSignatures()
    {
        # GET /accounts/{accountId}/users/{userId}/signatures
    }

    /**
     * Setting User Signature and Initials Images when Creating a Signature
     *
     * This allows user signature and/or initials images to be set when
     * a signature is created. The rules and processes associated with
     * this are:
     *      - If Content-Type is set to application/json, then default behavior
     *        for creating a default signature image, based on the name and a
     *        DocuSign font, is used.
     *
     *      - If Content-Type is set to multipart/form-data, then the request
     *        must contain a first part with the user signature information,
     *        followed by parts that contain the images.
     *
     *        For each Image part, the Content-Disposition header has a "filename"
     *        value that is used to map to the "signatureName" and/or
     *        "signatureInitials" in the JSON to the image. For example:
     *        Content-Disposition: file; filename="Ron Test20121127083900"
     *
     *        If no matching image (by filename value) is found then the image
     *        is not set. One, both or neither of the signature and initials
     *        images can be set with this call.
     *
     *        The Content-Transfer-Encoding: base64 header, set in the header
     *        for the part containing the image, can be set to indicate that
     *        the images are formatted as base64 instead of as binary.
     *
     *      - If successful, 200-OK is returned, and a JSON structure containing
     *        the signature information is provided, note that the signatureId
     *        can change with each API POST, PUT or DELETE since the changes to
     *        the signature structure cause the current signature to be closed,
     *        and a new signature record to be created.
     *
     * @param array $signatures Collection of Model\Signature instances.
     */
    public function createUserSignatures(array $signatures = array())
    {
        # POST /accounts/{accountId}/users/{userId}/signatures
    }

    /**
     * Get User Signature Information
     *
     * This returns the structure of a single signature with a
     * known signature name.
     *
     * Note: The userId specified in the uri must match the authenticated
     * user's userId and the user must be a member of the account.
     *
     * The {signatureIdOrName} accepts signature ID or signature name.
     * DocuSign recommends you use signature ID (signatureId), since some
     * names contain characters that don’t properly URL encode. If you use
     * the user name, it is likely that the name includes spaces and you
     * might need to URL encode the name before using the URL.
     * For example: "Bob Smith" to "Bob%20Smith"
     *
     * @param string $signatureIdOrName
     */
    public function getUserSignature($signatureIdOrName)
    {
        # GET /accounts/{accountId}/users/{userId}/signatures/{signatureIdOrName}
    }

    /**
     * Modify a User Signature
     *
     * This creates or modifies the signature font and initials for an
     * existing signature. When creating a signature, you would use this
     * resource to create the signature name and then put the signature
     * and initials images into the signature.
     *
     * Note: This will also create a default signature for the user when
     * one does not exist.
     *
     * @param string          $signatureIdOrName
     * @param Model\Signature $signature
     * @param boolean         $closeExistingSignature
     */
    public function updateUserSignature($signatureIdOrName, Model\Signature $signature, $closeExistingSignature = false)
    {
        # PUT /accounts/{accountId}/users/{userId}/signatures/{signatureIdOrName}
        # ? close_existing_signature={true or false}
    }

    /**
     * Close a User Signature
     *
     * This removes the signature information for the user.
     *
     * @param string $signatureIdOrName
     */
    public function closeUserSignature($signatureIdOrName)
    {
        # DELETE /accounts/{accountId}/users/{userId}/signatures/{signatureIdOrName}
    }

    /**
     * Get a User Initials Image
     *
     * This returns a specific user initials image. The image is returned
     * in the same format as uploaded. In the request you can specify if
     * the chrome (the added line and identifier around the initial image)
     * is returned with the image.
     *
     * @param string  $signatureIdOrName
     * @param boolean $includeChrome Older envelopes might only have chromed
     *                               images. If getting the non-chromed image
     *                               fails, try getting the chromed image.
     */
    public function getUserSignatureInitialsImage($signatureIdOrName, $includeChrome = false)
    {
        # GET /accounts/{accountId}/users/{userId}/signatures/{signatureIdOrName}/initials_image
        # ?include_chrome={true}
    }

    /**
     * Set a User Initials Image
     *
     * This updates the user initials image. The supported image formats for
     * this file are: gif, png, jpeg, and bmp. The file must be less than 200K.
     *
     * @param string $signatureIdOrName
     * @param string $image
     * @param string $contentType
     */
    public function updateUserSignatureInitialsImage($signatureIdOrName, $image, $contentType)
    {
        # Content-Type: image/gif
        # <image content>
        # PUT /accounts/{accountId}/users/{userId}/signatures/{signatureIdOrName}/initials_image
    }

    /**
     * Delete a User Initials Image
     *
     * This deletes a specific user initials image.
     *
     * Note: The user signature image associated with this user is not deleted.
     *
     * @param string $signatureIdOrName
     */
    public function deleteUserSignatureInitialsImage($signatureIdOrName)
    {
        # DELETE /accounts/{accountId}/users/{userId}/signatures/{signatureIdOrName}/initials_image
    }

    /**
     * Get a User Signature Image
     *
     * This returns a specific user signature image. The image is returned
     * in the same format as uploaded. In the request you can specify if the
     * chrome (the added line and identifier around the initial image) is
     * returned with the image.
     *
     * @param string  $signatureIdOrName
     * @param boolean $includeChrome Older envelopes might only have chromed
     *                               images. If getting the non-chromed image
     *                               fails, try getting the chromed image.
     */
    public function getUserSignatureImage($signatureIdOrName, $includeChrome = false)
    {
        # GET /accounts/{accountId}/users/{userId}/signatures/{signatureIdOrName}/signature_image
    }

    /**
     * Set a User Signature Image
     *
     * This updates the user signature image. The supported image formats for
     * this file are: gif, png, jpeg, and bmp. The file must be less than 200K.
     *
     * @param string $signatureIdOrName
     * @param string $image
     * @param string $contentType
     */
    public function updateUserSignatureImage($signatureIdOrName, $image, $contentType)
    {
        # Content-Type: image/gif
        # <image content>
        # PUT /accounts/{accountId}/users/{userId}/signatures/{signatureIdOrName}/signature_image
    }

    /**
     * Delete a User Signature Image
     *
     * This deletes a specific user signature image.
     *
     * Note: The user initials image associated with this user is not
     * deleted by this.
     *
     * @param string $signatureIdOrName
     */
    public function deleteUserSignatureImage($signatureIdOrName)
    {
        # DELETE /accounts/{accountId}/users/{userId}/signatures/{signatureIdOrName}/signature_image
    }

    /**
     * Get User Social Accounts
     *
     * This returns a list of social accounts linked to a user's account.
     */
    public function getUserSocialAccounts()
    {

        # GET /accounts/{accountId}/users/{userId}/social
    }

    /**
     * Add a User Social Account
     *
     * This adds a new social account to a user’s account.
     *
     * @param string $provider The name of the social account provider.
     *                         For example: Google, Facebook, Yahoo, etc.
     * @param string $email    The user's email address for the social account.
     * @param string $userName The full user name in the social account.
     */
    public function addUserSocialAccount($provider, $email, $userName)
    {
        $data = array(
            'provider' => $provider,
            'email'    => $email,
            'userName' => $userName,
        );

        # PUT /accounts/{accountId}/users/{userId}/social
    }

    /**
     * Remove a User Social Account
     *
     * This removes a social account from a user’s account.
     *
     * @param string $provider The name of the social account provider.
     *                         For example: Google, Facebook, Yahoo, etc.
     * @param string $email    The user's email address for the social account.
     * @param string $userName The full user name in the social account.
     */
    public function deleteUserSocialAccount($provider, $email, $userName)
    {
        $data = array(
            'provider' => $provider,
            'email'    => $email,
            'userName' => $userName,
        );

        # DELETE /accounts/{accountId}/users/{userId}/social
    }
}