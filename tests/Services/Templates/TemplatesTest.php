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
 * Tests for templates.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class TemplatesTest extends \PHPUnit_Framework_TestCase
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

    public function testAccountLogin()
    {
        global $config;

        $client = new Client($config);
        $client->authenticate();
        $this->assertFalse($client->hasError());
    }

    /**
     * @depends testAccountLogin
     */
    public function testCreateTemplate()
    {
        $template = new Model\Template([
            'accessibility' => '',
            'allowMarkup' => '',
            'allowReassign' => '',
            'allowRecipientRecursion' => '',
            'asynchronous' => '',
            'authoritativeCopy' => '',
            'autoNavigation' => '',
            'randId' => '',
            'emailBlurb' => '',
            'emailSubject' => '',
            'enableWetSign' => '',
            'enforceSignerVisibility' => '',
            'envelopeIdStamping' => '',
            'messageLock' => '',
            'recipientsLock' => '',
            'signingLocation' => ''
        ]);

        // envelopeTemplateDefinition
        $template->setEnvelopeDefinition([
            'templateId' => '',
            'name' => '',
            'shared' => '',
            'password' => '',
            'description' => '',
            'lastModified' => '',
            'pageCount' => '',
            'folderName' => '',
            'folderId' => '',
            'owner' => [
                'userName' => '',
                'email' => '',
                'userId' => '',
                'userType' => '',
                'userStatus' => ''
            ]
        ]);

        // eventNotification
        $template->setEventNotification([
        ]);


        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

        $response = Service\Templates::createTemplates($template);

        var_dump($response); exit;
    }

    /**
     * @depends testCreateTemplate
     */
    public function testGetTemplates()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @depends testGetTemplates
     */
    public function testGetTemplate()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @depends testGetTemplate
     */
    public function testSetTemplateGroup()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @depends testSetTemplateGroup
     */
    public function testDeleteTemplateGroup()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @depends testGetTemplate
     */
    public function testGetTemplateDocumentCustomFields()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @depends testGetTemplate
     */
    public function testAddTemplateDocumentCustomFields()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @depends testGetTemplate
     */
    public function testUpdateTemplateDocumentCustomFields()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @depends testGetTemplate
     */
    public function testDeleteTemplateDocumentCustomFields()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}