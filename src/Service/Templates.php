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
 * DocuSign Templates Service Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Templates extends DocuSign\Service
{
    public $templateId;

    /**
    * Constructs the internal representation of the DocuSign Templates service.
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get List of Templates
     *
     * Retrieves the list of templates for the specified account.
     * The request can be limited to a specific folder
     *
     * @param string  $folder            Optional. The query value can be
     *                                   a folder name or folder ID. The response
     *                                   will only return templates in the
     *                                   specified folder.
     * @param boolean $includeSubFolders Optional. When true, the response will
     *                                   include all subfolders.
     */
    public function getTemplates($folder = '', $includeSubFolders = false)
    {
        # GET /accounts/{accountId}/templates
        # ?  folder={string}, includeSubFolders={true or false}
    }

    /**
     * Post Template
     *
     * Saves a template definition using a multipart request.
     *
     * @param array $templates Collection of Model\Template
     */
    public function createTemplates(array $templates = array())
    {
        $data = array(
            'envelopeTemplates' => $templates
        );

        # POST /accounts/{accountId}/templates
    }

    /**
     * Get Template
     *
     * This retrieves the definition of the specified template.
     */
    public function getTemplate($templateId)
    {
        # GET /accounts/{accountId}/templates/{templateId}
    }

    /**
     * Get Custom Document Fields for a Template Document
     *
     * This returns the custom document fields for an existing document
     * in a template.
     *
     * @param string $documentId
     */
    public function getTemplateDocumentCustomFields($templateId, $documentId)
    {
        # GET /accounts/{accountId}/templates/{templateId}/documents/{documentId}/fields
    }

    /**
     * Add Custom Document Fields to a Template Document
     *
     * This adds custom document fields for an existing template document.
     *
     * @param string $documentId
     * @param array  $documentFields
     */
    public function addTemplateDocumentCustomFields($documentId, array $documentFields = array())
    {
        $data = array(
            'documentFields' => array(
                array( 'name' => '', 'value' => '' ),
                array( 'name' => '', 'value' => '' ),
            )
        );

        # POST /accounts/{accountId}/templates/{templateId}/documents/{documentId}/fields
    }

    /**
     * Modify Custom Document Fields for a Template Document
     *
     * This modifies existing custom document fields for an existing
     * template document.
     *
     * @param string $documentId
     * @param array  $documentFields
     */
    public function updateTemplateDocumentCustomFields($documentId, array $documentFields = array())
    {
        # PUT /accounts/{accountId}/templates/{templateId}/documents/{documentId}/fields
    }

    /**
     * Delete Custom Document Fields from a Template Document
     *
     * This deletes custom document fields for an existing template document.
     *
     * @param string $documentId
     * @param array  $documentFields
     */
    public function deleteTemplateDocumentCustomFields($documentId, array $documentFields = array())
    {
        # DELETE /accounts/{accountId}/templates/{templateId}/documents/{documentId}/fields
    }

    /**
     * Share a Template with a Group
     *
     * This shares a template with a group
     *
     * @param string $groupId
     */
    public function setTemplateGroup($templateId, $groupId)
    {
        # PUT /accounts/{accountId}/templates/{templateId}/groups
    }

    /**
     * Remove Template Sharing for a Group
     *
     * This removes template sharing for a group.
     */
    public function deleteTemplateGroup($templateId)
    {
        # DELETE /accounts/{accountId}/templates/{templateId}/groups
    }

}