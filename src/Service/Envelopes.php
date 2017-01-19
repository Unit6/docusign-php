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
 * DocuSign Envelopes Service Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Envelopes extends DocuSign\Service
{
    /**
    * Constructs the internal representation of the DocuSign Documents service.
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get Envelope Status Changes
     *
     * This returns envelope status changes for all envelopes.
     * The information returned can be modified by adding query
     * strings to limit the request to check between certain
     * dates and times, or for certain envelopes, or for certain
     * status codes. It is recommended that you use one or more
     * of the query strings in order to limit the size of the
     * response.
     *
     * @param array $criteria Filtering criteria for envelopes. Contains:
     *                          - from_date: The date/time setting that specifies the date/time
     *                                       when the request begins checking for status
     *                                       changes for envelopes in the account.
     *                          - to_date:   Optional. Date/time setting that specifies the date/time
     *                                       when the request stops for status changes for envelopes
     *                                       in the account. If no entry, the system uses the time of
     *                                       the call as the to_date.
     *                          - from_to_status: This is the status type checked for in the date range
     *                                       specified with from_date/to_date.
     *                          - status:    The list of current statuses to include in the response.
     *                                       By default, all envelopes found are returned. If values
     *                                       are specified, then of the envelopes found, only those
     *                                       with the current status specified are returned in the results.
     *                          - ac_status: The Authoritative Copy Status for the envelopes.
     *                          - envelopeId: The envelope ID for the envelope.
     *                          - custom_field: The envelope custom field name and value searched for
     *                                       in the envelope information.
     *                          - transaction_ids: If included in the query string, this is a comma
     *                                       separated list of envelope transactionIds.
     *                          - name:
     */
    public function getEnvelopes(array $criteria = array())
    {
        # GET /accounts/{accountId}/envelopes
    }

    /**
     * Send an Envelope or Create a Draft Envelope
     *
     * This creates an envelope and sends it to recipients or saves
     * it as a draft envelope. Setting the status parameter sets
     * if the envelope is sent or if it is saved to the draft envelope
     * folder after the request. This is a multipart/form request.
     *
     * This resource is also used for sending an envelope from a template;
     * refer to Send an Envelope from a Template for information about
     * sending from a template.
     *
     * This resource can also be used with offline signing client
     * applications, see the Offline Signing section for more
     * information about offline signing.
     *
     * Envelope Event Notification: eventNotification is an optional
     * element that specifies a set of envelope and recipient status
     * codes, a URL and some other options. When the envelope or
     * recipient status changes to one of the specified status codes,
     * a message containing the updated status is sent to the URL.
     */
    public function createEnvelope(Model\Envelope $envelope)
    {
        # POST /accounts/{accountId}/envelopes

        $url = $this->getEndpoint('envelopes');

        $endOfLine = "\r\n";
        $boundary = sha1(microtime());

        $headers = $this->client->getHeaders(
            'Accept: application/json',
            'Content-Type: multipart/form-data; boundary=' . $boundary
        );

        $attchments = '';

        foreach ($envelope->getDocuments() as $row) {
            $attchments .= '--' . $boundary
                . $endOfLine
                . 'Content-Type: ' . $row['mimeType']
                . $endOfLine
                . 'Content-Transfer-Encoding: base64'
                . $endOfLine
                . 'Content-Disposition: file; '
                    . 'filename="' . $row['name'] . '"; '
                    . 'documentId=' . $row['documentId']
                . $endOfLine
                . $endOfLine
                . $row['documentBase64']
                . $endOfLine;
        }

        $jsonEnvelopeData = json_encode($envelope->getData());

        $data = $endOfLine
            . $endOfLine
            . '--' . $boundary
            . $endOfLine
            . 'Content-Type: application/json'
            . $endOfLine
            . 'Content-Disposition: form-data'
            . $endOfLine
            . $endOfLine
            . $jsonEnvelopeData
            . $endOfLine
            . $attchments
            . '--' . $boundary . '--';

        return $this->request->post($url, $headers, $params = array(), $data);
    }

    /**
     * Get Envelope Status for more than one envelope
     *
     * This returns envelope status for the requested envelopes.
     *
     * @param array $envelopes List of envelopeIds.
     */
    public function getStatus(array $envelopes = array())
    {
        $data = array(
            'envelopeIds' => $envelopes
        );

        # PUT /accounts/{accountId}/envelopes/status ?
    }

    /**
     * Get Individual Envelope Status
     *
     * This returns the overall status for a single envelope.
     */
    public function getEnvelope($envelopeId)
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}

        $url = $this->getEndpoint('envelopes/' . $envelopeId);

        return $this->request->get($url, $this->client->getHeaders());
    }

    /**
     * Send Draft Envelope
     *
     * This sends a single draft envelope.
     */
    public function sendDraftEnvelope()
    {
        # PUT /accounts/{accountId}/envelopes/{envelopeId}

        $url = $this->getEndpoint('envelopes/' . $envelopeId);

        $data = array(
            'status' => Model\Envelope::STATUS_SENT
        );

        return $this->request->put($url, $this->client->getHeaders(), array(), $data);
    }

    /**
     * Void Envelope
     *
     * This voids a single in-process envelope.
     */
    public function voidEnvelope($envelopeId, $voidedReason)
    {
        # PUT /accounts/{accountId}/envelopes/{envelopeId}

        $url = $this->getEndpoint('envelopes/' . $envelopeId);

        $data = array(
            'status'       => Model\Envelope::STATUS_VOIDED,
            'voidedReason' => $voidedReason,
        );

        $json = json_encode($data);

        return $this->request->put($url, $this->client->getHeaders(), array(), $json);
    }

    /**
     * Get Envelope Audit Events
     *
     * This returns the events for this envelope.
     */
    public function getAuditEvents()
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/audit_events
    }

    /**
     * Get Envelope Custom Field Information
     *
     * This returns the custom field information for a single envelope.
     * These fields can be used in the envelopes for your account to
     * record information about the envelope, help search for envelopes
     * and track information. The envelope custom fields are shown in
     * the Envelope Settings section when a user is creating an envelope
     * in the DocuSign member console. The envelope custom fields are not
     * seen by the envelope recipients.
     *
     * There are two types of envelope custom fields, text and list.
     * A text custom field lets the sender enter the value for the field.
     * With a list custom field, the sender selects the value of the
     * field from a pre- made list.
     */
    public function getCustomFields()
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/custom_fields
    }

    /**
     * Add Envelope Custom Fields to an Envelope
     *
     * This allows you to add envelope custom fields to draft and in-process envelopes.
     */
    public function addCustomFields(array $fields = array())
    {
        # POST /accounts/{accountId}/envelopes/{envelopeId}/custom_fields
    }

    /**
     * Modify Envelope Custom Fields for an Envelope
     *
     * This allows you to edit the envelope custom fields for draft
     * and in-process envelopes.
     */
    public function modifyCustomFields(array $fields = array())
    {
        # PUT /accounts/{accountId}/envelopes/{envelopeId}/custom_fields
    }

    /**
     * Remove Envelope Custom Fields from an Envelope
     *
     * This allows you to remove envelope custom fields for draft and in-process envelopes.
     */
    public function removeCustomFields(array $fields = array())
    {
        # DELETE /accounts/{accountId}/envelopes/{envelopeId}/custom_fields
    }

    /**
     * Get Envelope Notification Information
     *
     * This returns the reminder and expiration information for the envelope.
     */
    public function getNotificationInformation()
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/notification
    }

    /**
     * Get List of Templates Used in an Envelope
     *
     * This returns a list of the templates, name and ID, used in an envelope.
     * NOTE: This only returns information for server side templates.
     *
     * @param string $include Determines whether or not to return
     *                        template matching information for the template.
     */
    public function getTemplates($include = '')
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/templates
        # ?include=matching_applied
    }

    /**
     * Get List of Envelopes in Folders
     *
     * This returns a list of envelopes that match the criteria specified
     * in the query.
     *
     * Note: If the userId of the user making the call is the same as the
     * userId for any returned recipient, then the userId is added to the
     * returned information for those recipients.
     *
     * @param string $folderName Folder to search.
     * @param array  $params     Criteria contains:
     *                              - start_position={integer}
     *                              - count={integer}
     *                              - from_date={date/time}
     *                              - to_date={date/time}
     *                              - order_by={string}
     *                              - order={string}
     *                              - include_recipients={true/false}
     */
    public function getSearchInFolder($folderName, array $params = array())
    {
        # GET /accounts/{accountId}/search_folders/{search_folder}

        $url = $this->getEndpoint('search_folders/' . $folderName);

        return $this->request->get($url, $this->client->getHeaders(), $params);
    }
}