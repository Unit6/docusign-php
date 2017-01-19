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
 * DocuSign Documents Service Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Documents extends DocuSign\Service
{
    public $envelopeId;
    public $documentId;

    /**
    * Constructs the internal representation of the DocuSign Documents service.
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get List of Envelope Documents
     *
     * This returns a list of documents associated with the specified envelope.
     */
    public function getDocuments()
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/documents
    }

    /**
     * Add Documents to a Draft Envelope
     *
     * This can be used to add one or more documents to an existing
     * draft envelope or change the order of documents in a draft envelope.
     *
     * @param array $documents Collection of Model\Document instances.
     */
    public function addDocuments(array $documents = array())
    {
        # PUT /accounts/{accountId}/envelopes/{envelopeId}/documents
    }

    /**
     * Remove Documents from a Draft Envelope
     *
     * This removes one or more document from an existing draft envelope.
     *
     * @param array $documents Collection of Model\Document instances.
     */
    public function removeDocuments(array $documents = array())
    {
        # DELETE /accounts/{accountId}/envelopes/{envelopeId}/documents
    }

    /**
     * Get Envelope Certificate
     *
     * This retrieves a PDF document containing the certificate of
     * completion for the envelope.
     */
    public function getCertificate()
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/documents/certificate
    }

    /**
     * Get Envelope Documents and Certificate
     *
     * This retrieves a PDF containing the combined content of all
     * documents and the certificate. If the account has the Highlight
     * Data Changes feature enabled, there is an option to request
     * that any changes in the envelope be highlighted.
     *
     * @param boolean $certificate Optional. This option can remove the envelope signing
     *                             certificate from the download.
     * @param boolean $showChanges Optional. When set to true, any changed fields for
     *                             the returned PDF are highlighted in yellow and optional
     *                             signatures or initials outlined in red.
     * @param boolean $watermark   Optional. If the account has the watermark feature
     *                             enabled and the envelope is not complete, the watermark
     *                             for the account is added to the PDF documents. This
     *                             option can remove the watermark.
     */
    public function getCombinedCertificate($certificate = true, $showChanges = true, $watermark = true)
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/documents/combined
    }

    /**
     * Get Document from Envelope
     *
     * This retrieves the specified document from the envelope.
     * If the account has the Highlight Data Changes feature enabled,
     * there is an option to request that any changes in the envelope
     * be highlighted.
     *
     * @param boolean $showChanges Optional. When set to true, any changed fields
     *                             for the returned PDF are highlighted in yellow
     *                             and optional signatures or initials outlined in red.
     */
    public function getDocument($showChanges = true)
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/documents/{documentId}
        # ?show_changes=true
    }

    /**
     * Add a Document to a Draft Envelope
     *
     * This adds another document to an existing draft envelop.
     *
     * @param Model\Document $document
     */
    public function addDocument(Model\Document $document)
    {
        # PUT /accounts/{accountId}/envelopes/{envelopeId}/documents/{documentId}
    }


    /**
     * Get Custom Document Fields for an Envelope Document
     *
     * This returns the custom document field information for an existing envelope document.
     */
    public function getCustomFields()
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/documents/{documentId}/fields
    }

    /**
     * Add Custom Document Fields to an Envelope Document
     *
     * This adds custom document fields for an existing envelope document.
     *
     * @param array $documentFields { "documentFields": [ { "name": "string", "value": "string" } ] }
     */
    public function addCustomFields(array $documentFields = array())
    {
        # POST /accounts/{accountId}/envelopes/{envelopeId}/documents/{documentId}/fields
    }

    /**
     * Modify Custom Document Fields for an Envelope Document
     *
     * This modifies existing custom document fields for an existing envelope document.
     *
     * @param array $documentFields
     */
    public function modifyCustomFields(array $documentFields = array())
    {
        # PUT /accounts/{accountId}/envelopes/{envelopeId}/documents/{documentId}/fields
    }

    /**
     * Delete Custom Document Fields from an Envelope Document
     *
     * This deletes custom document fields for an existing envelope document.
     *
     * @param array $documentFields
     */
    public function deleteCustomFields(array $documentFields = array())
    {
        # DELETE /accounts/{accountId}/envelopes/{envelopeId}/documents/{documentId}/fields
    }

    /**
     * Remove a Page
     *
     * This removes a page from a document based on the page ID.
     *
     * @param integer $pageId
     */
    public function removePage($pageId)
    {
        # DELETE /accounts/{accountId}/envelopes/{envelopeId}/documents/{documentId}/pages/{pageId}
    }

    /**
     * Get a Page Image
     *
     * This returns a page image for display.
     *
     * @param integer $pageId
     * @param array   $dimenisons Image dimenisons, containing:
     *                          - dpi: Sets the target DPI for the image but is
     *                                 recalculated based on a max width or height.
     *                          - max_width: In pixels
     *                          - max_height: In pixels
     */
    public function getPageImage($pageId, array $dimenisons = array())
    {
        # GET /accounts/{accountId}/envelopes/{envelopeId}/documents/{documentId}/pages/{pageId}/page_image
    }

    /**
     * Rotate Page Image
     *
     * This rotates a page image for display. The page image can be rotated to the left or right.
     *
     * @param integer $pageId
     * @param string  $rotate Either 'left' or 'right'.
     */
    public function rotatePageImage($pageId, $rotate)
    {
        # PUT /accounts/{accountId}/envelopes/{envelopeId}/documents/{documentId}/pages/{pageId}/page_image
    }
}