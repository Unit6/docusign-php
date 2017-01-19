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
 * DocuSign Recipients Service Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Recipients extends DocuSign\Service
{
    public $envelopeId;
    public $recipientId;

    public $imageValidExtensions = array(
        'gif', 'png', 'jpeg', 'bmp'
    );

    public $imageMaxFileSize = 200000; // 200K

    /**
    * Constructs the internal representation of the DocuSign Recipients service.
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get Envelope Recipient Status
     *
     * This returns the status for all recipients of a single envelope
     * and identifies the current routing order. The current routing order
     * is a number that matches up to the routingOrder for envelope recipients,
     * which shows that the envelope has been sent to a recipient, but the
     * recipient has not completed their actions.
     *
     * @param array $criteria Filtering criteria for recipients. Contains:
     *                          - include_tabs: (true|false)
     *                          - include_extended: (true|false)
     */
    public function getRecipients(array $criteria = array())
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/recipients
    }

    /**
     * Add Recipients to an Envelope
     *
     * This is used to add one or more recipeints to an envelope.
     *
     * For "In Process" envelopes (one that has been sent and is not
     * completed or voided), an email will be sent to a new recipient
     * when they are reached in the routing order. If the new recipient's
     * routing order is before or the same as the envelope's next
     * recipient, an email is only sent if the optional "resend_envelope"
     * query string is set to true
     *
     * @param array   $recipients     Collection of Model\Recipient
     * @param boolean $resendEnvelope Whether to resent the envelope.
     */
    public function addRecipients(array $recipients = array(), $resendEnvelope = false)
    {
        # POST /accounts/{accountId}/envelopes/{envelopeId}/recipients
        # ?resend_envelope={true or false}
    }

    /**
     * Modify or Correct and Resend Recipient Information
     *
     * This lets you modify recipients in a draft envelope or correct
     * recipient information for an in process envelope.
     *
     * For draft envelopes, you can edit: email, userName,
     * routingOrder, faxNumber, deliveryMethod, accessCode and requireIdLookup.
     *
     * Note: If you send information for a recipient that does not already
     * exist in a draft envelope, the recipient will be added to the
     * envelope (similar to the POST).
     *
     * Once an envelope has been sent, you can only edit: email,
     * userName, signerName, routingOrder, faxNumber, and deliveryMethod.
     * You can also select to resend an envelope by using the
     * resend_envelope option.
     *
     * @param array   $recipients     Collection of Model\Recipient
     * @param boolean $resendEnvelope Whether to resent the envelope.
     */
    public function updateRecipients(array $recipients = array(), $resendEnvelope = false)
    {
        # PUT /accounts/{accountId}/envelopes/{envelopeId}/recipients
        # ?resend_envelope={true or false}
    }

    /**
     * Delete Recipients from an Envelope
     *
     * This is used to delete one or more recipients from an envelope.
     * The recipients that need to be deleted are listed in the request,
     * with the recipientId being used as the key for deleting recipients.
     *
     * If the envelope is "In Process" (has been sent and is not completed
     * or voided), recipients that have completed their actions cannot be
     * deleted.
     */
    public function deleteRecipients(array $recipients = array())
    {
        $data = array(
            'signers' => $recipients
        );

        # DELETE /accounts/{accountId}/envelopes/{envelopeId}/recipients
    }

    /**
     * Set Initials Image for Accountless Signer
     *
     * This sets the initials image for an accountless signer.
     * The supported image formats for this file are:
     * gif, png, jpeg, and bmp. The file size must be less than 200K.
     *
     * Note: For the Authentication/Authorization for this call, the
     * credentials must match the sender of the envelope, the recipient
     * must be an accountless signer or inperson signer, the Account has
     * CanSendEnvelope enabled and the SendingUser does not have
     * ExpressSendOnly enabled.
     */
    public function updateRecipientInitialsImage()
    {
        // Content-Type: image/gif
        // <image content>

        # PUT /accounts/{accountId}/envelopes/{envelopeId}/recipients/{recipientId}/initials_image
    }

    /**
     * Get Signature Information for Accountless Signer
     *
     * This returns the structure of a single signature with a known
     * signature name.
     *
     * Note: For the Authentication/Authorization for this call, the
     * credentials must match the sender of the envelope, the recipient
     * must be an accountless signer or inperson signer, the Account has
     * CanSendEnvelope enabled and the SendingUser does not have
     * ExpressSendOnly enabled.
     */
    public function getRecipientSignature()
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/recipients/{recipientId}/signature
    }

    /**
     * Set Signature Image for Accountless Signer
     *
     * This sets the signature image for an accountless signer.
     * The supported image formats for this file are:
     * gif, png, jpeg, and bmp. The file size must be less than 200K.
     *
     * Note: For the Authentication/Authorization for this call, the
     * credentials must match the sender of the envelope, the recipient
     * must be an accountless signer or inperson signer, the Account has
     * CanSendEnvelope enabled and the SendingUser does not have
     * ExpressSendOnly enabled.
     */
    public function updateRecipientSignatureImage()
    {
        # PUT /accounts/{accountId}/envelopes/{envelopeId}/recipients/{recipientId}/signature_image

    }

    /**
     * Get Tab Information for a Recipient
     *
     * This retrieves information about the tabs associated with a
     * recipient in a draft envelope.
     */
    public function getRecipientTabs()
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/recipients/{recipientId}/tabs
    }

    /**
     * Add Tabs for a Recipient
     *
     * This adds one or more tabs for a recipient. If can be used to add
     * tabs to a draft envelope or to add tabs to an in process envelope.
     *
     * To add tabs to an in process envelope, the account must have envelope
     * correct enabled, the envelope status must be "Sent" and the recipient
     * status must be "Created" or "Sent". If these conditions are met, the
     * POST opens the envelope in correct mode, adds the tabs and exits
     * correct mode.
     *
     * @param array $tabs Collection of Model\Tab
     */
    public function addRecipientTabs(array $tabs = array())
    {
        # POST /accounts/{accountId}/envelopes/{envelopeId}/recipients/{recipientId}/tabs
    }

    /**
     * Modify Tabs for a Recipient
     *
     * This modifies one or more tabs for a recipient to a draft envelope.
     *
     * @param array $tabs Collection of tabIds
     */
    public function updateRecipientTabs(array $tabs = array())
    {
        # PUT /accounts/{accountId}/envelopes/{envelopeId}/recipients/{recipientId}/tabs
    }

    /**
     * Delete Tabs for a Recipient
     *
     * This deletes one or more tabs associated with a recipient in a
     * draft envelope.
     *
     * @param array $tabs Collection of tabIds
     */
    public function deleteRecipientTabs(array $tabs = array())
    {
        $data = array(
            'approveTabs' => array(
                array( 'tabId' => '' ),
                array( 'tabId' => '' )
            ),
            'titleTabs' => array(
                array( 'tabId' => '' )
            ),
            'signHereTabs' => array(
                array( 'tabId' => '' )
            ),
        )

        # DELETE /accounts/{accountId}/envelopes/{envelopeId}/recipients/{recipientId}/tabs
    }

}