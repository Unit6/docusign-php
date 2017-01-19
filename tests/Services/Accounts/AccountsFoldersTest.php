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
 * Tests for account folders.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class AccountsFoldersTest extends \PHPUnit_Framework_TestCase
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
    public function testGetFolders()
    {
        $response = Service\Accounts::getFolders();

        $this->assertResponseIsOK($response);

        // NOTE: first result (at zero index) is a report
        // folder with filters attached.
        $folder = $this->getOneOf('folders', $response, $index = 1)

        $this->assertArrayHasKey('ownerUserName', $folder);
        $this->assertArrayHasKey('ownerEmail', $folder);
        $this->assertArrayHasKey('ownerUserId', $folder);
        $this->assertArrayHasKey('type', $folder);
        $this->assertArrayHasKey('name', $folder);
        $this->assertArrayHasKey('uri', $folder);
        $this->assertArrayHasKey('folderId', $folder);

        return $folder;
    }

    /**
     * @depends testGetFolders
     */
    public function testGetFolderById($folder)
    {
        $folderId = $folder['folderId'];

        $criteria = [
            'owner_name'     => $folder['ownerUserName'],
            'owner_email'    => $folder['ownerEmail']
        ];

        $response = Service\Accounts::getFolder($folderId, $criteria);

        $this->assertResponseIsOK($response);

        $json = $response['json'];

        $this->assertArrayHasKey('resultSetSize', $json);
        $this->assertArrayHasKey('startPosition', $json);
        $this->assertArrayHasKey('endPosition', $json);
        $this->assertArrayHasKey('totalSetSize', $json);
        $this->assertArrayHasKey('previousUri', $json);
        $this->assertArrayHasKey('nextUri', $json);
        $this->assertArrayHasKey('folderItems', $json);

        $folderItems = $json['folderItems'];

        return $folderItems;
    }

    /**
     * @depends testGetFolderById
     */
    public function testFolderItemsIsValid($folderItems)
    {
        $this->assertNotEmpty($folderItems);

        $folder = $folderItems[0];

        $this->assertArrayHasKey('ownerName', $folder);
        $this->assertArrayHasKey('envelopeId', $folder);
        $this->assertArrayHasKey('envelopeUri', $folder);
        $this->assertArrayHasKey('status', $folder);
        $this->assertArrayHasKey('senderName', $folder);
        $this->assertArrayHasKey('senderEmail', $folder);
        $this->assertArrayHasKey('createdDateTime', $folder);
        $this->assertArrayHasKey('sentDateTime', $folder);
        $this->assertArrayHasKey('completedDateTime', $folder);
        $this->assertArrayHasKey('subject', $folder);
    }

    /**
     * @depends testGetFolders
     */
    public function testMoveEnvelopeToRecycleBin($folder)
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

        $fromFolderId = $folder['folderId'];
        $folderId = Model\Folder::TYPE_RECYCLE_BIN;

        $envelopeIds = array();

        var_dump($folderId, $fromFolderId, $envelopeIds, 'testMoveEnvelopeToRecycleBin'); exit;

        $response = Service\Accounts::updateFolder($folderId, $fromFolderId, $envelopeIds);

        var_dump($response, 'testMoveEnvelopeToRecycleBin'); exit;
    }
}