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
 * Tests for account group, branding.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class AccountsGroupsTest extends \PHPUnit_Framework_TestCase
{
    public function testAccountLogin()
    {
        global $config;

        $client = new Client($config);
        $client->authenticate();
        $this->assertFalse($client->hasError());
    }

    protected function assertResponseIsOK($response, $statusCode = 200)
    {
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('statusCode', $response);
        $this->assertArrayHasKey('json', $response);

        $this->assertEquals($statusCode, $response['statusCode']);
    }

    protected function getOneOf($key, $response, $index = 0)
    {
        $json = $response['json'];

        $this->assertArrayHasKey($key, $json);

        $list = $json[$key];

        $this->assertNotEmpty($list);

        return $list[$index];
    }

    /**
     * @depends testAccountLogin
     */
    public function testGetAccountUsers()
    {
        $response = Service\Users::getUsers();

        $this->assertResponseIsOK($response);

        $user = $this->getOneOf('users', $response);

        $this->assertArrayHasKey('userName', $user);
        $this->assertArrayHasKey('userId', $user);
        $this->assertArrayHasKey('userType', $user);
        $this->assertArrayHasKey('userStatus', $user);
        $this->assertArrayHasKey('uri', $user);
        $this->assertArrayHasKey('email', $user);
        $this->assertArrayHasKey('createdDateTime', $user);

        return $user;
    }

    /**
     * @depends testAccountLogin
     */
    public function testGetAccountSettings()
    {
        $response = Service\Accounts::getSettings();

        $this->assertResponseIsOK($response);

        $setting = $this->getOneOf('accountSettings', $response);

        $this->assertArrayHasKey('name', $setting);
        $this->assertArrayHasKey('value', $setting);

        return $response['json']['accountSettings'];
    }

    /**
     * @depends testGetAccountSettings
     */
    public function testAccountCanSelfBrand($settingList)
    {
        $settings = [];

        foreach ($settingList as $setting) {
            $settings[$setting['name']] = $setting['value'];
        }

        $this->assertArrayHasKey('canSelfBrandSign', $settings);
        $this->assertArrayHasKey('canSelfBrandSend', $settings);

        $this->assertEquals('true', $settings['canSelfBrandSign']);
        $this->assertEquals('true', $settings['canSelfBrandSend']);
    }

    /**
     * @depends testAccountCanSelfBrand
     */
    public function testUploadAccountBrandProfile()
    {
        return [
            'brandId' => 'ce173f6e-3549-4494-a8ea-f8f33a0dba64',
            'brandName' => 'ExampleBrand',
            'brandCompany' => 'Example Co. Ltd'
        ];

        /* TODO */

        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

        $zipPath = BRANDING_PATH;

        $response = Service\Accounts::uploadBrandProfiles($zipPath);

        var_dump($response); exit;
    }

    /**
     * @depends testUploadAccountBrandProfile
     */
    public function testDeleteBrandProfile($brandProfile)
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

        /* TODO */

        $brand = new Model\Brand($brandProfile);

        $brands = [$brand];

        $response = Service\Accounts::deleteBrandProfiles($brands);

        var_dump($response); exit;
    }

    /**
     * @depends testAccountLogin
     */
    public function testGetBrandProfiles()
    {
        $response = Service\Accounts::getBrandProfiles();

        $this->assertResponseIsOK($response);

        $brand = $this->getOneOf('brands', $response);

        $this->assertArrayHasKey('brandId', $brand);
        $this->assertArrayHasKey('brandName', $brand);
        $this->assertArrayHasKey('brandCompany', $brand);
    }

    /**
     * @depends testAccountLogin
     */
    public function testGetPermissionProfiles()
    {
        $response = Service\Accounts::getPermissionProfiles();

        $this->assertResponseIsOK($response);

        $profile = $this->getOneOf('permissionProfiles', $response);

        $this->assertArrayHasKey('permissionProfileId', $profile);
        $this->assertArrayHasKey('permissionProfileName', $profile);

        return $profile;
    }

    /**
     * @depends testGetPermissionProfiles
     */
    public function testAddGroup($profile)
    {
        return '562884';

        return [
            'groupId' => '562884',
            'groupName' => 'FooBarGroup',
            'permissionProfileId' => '204301',
            'groupType' => 'customGroup'
        ];

        /* TODO */

        $profileId = $profile['permissionProfileId'];

        $group = new Model\Group();
        $group->setName('FooBarGroup');
        $group->setPermissionProfileId($profileId);

        $groupList = [$group];

        $response = Service\Accounts::addGroups($groupList);

        $this->assertResponseIsOK($response, $statusCode = 201);

        $group = $this->getOneOf('groups', $response);

        $this->assertArrayHasKey('groupId', $group);
        $this->assertArrayHasKey('groupName', $group);
        $this->assertArrayHasKey('groupType', $group);

        $groupId = $group['groupId'];

        return $groupId;
    }

    /**
     * @depends testAddGroup
     * @depends testGetAccountUsers
     */
    public function testAddGroupUsers($groupId, $userInformation)
    {
        $user = new Model\User($userInformation);

        $usersList = [$user];

        return [
            'groupId' => $groupId,
            'user' => $userInformation
        ];

        /* TODO */

        $response = Service\Accounts::addGroupUsers($groupId, $usersList);

        $this->assertResponseIsOK($response);

        $addedUser = $this->getOneOf('users', $response);

        $this->assertArrayHasKey('userName', $addedUser);
        $this->assertArrayHasKey('userId', $addedUser);
        $this->assertArrayHasKey('userType', $addedUser);
        $this->assertArrayHasKey('userStatus', $addedUser);
        $this->assertArrayHasKey('uri', $addedUser);

        return [
            'groupId' => $groupId,
            'user' => $userInformation
        ];
    }

    /**
     * @depends testAddGroupUsers
     */
    public function testGetGroupUsers($groupUsers)
    {
        #$userInformation = $groupUsers['user'];
        $groupId = $groupUsers['groupId'];

        $response = Service\Accounts::getGroupUsers($groupId);

        $this->assertResponseIsOK($response);

        $user = $this->getOneOf('users', $response);

        $this->assertArrayHasKey('userName', $user);
        $this->assertArrayHasKey('userId', $user);
        $this->assertArrayHasKey('userType', $user);
        $this->assertArrayHasKey('userStatus', $user);
        $this->assertArrayHasKey('uri', $user);
    }

    /**
     * @depends testAddGroup
     */
    public function testGetGroups()
    {
        $response = Service\Accounts::getGroups();

        $this->assertResponseIsOK($response);

        $group = $this->getOneOf('groups', $response);

        $this->assertArrayHasKey('groupId', $group);
        $this->assertArrayHasKey('groupName', $group);
        $this->assertArrayHasKey('permissionProfileId', $group);
        $this->assertArrayHasKey('groupType', $group);

        return $group;
    }

    /**
     * @depends testAddGroup
     */
    public function testUpdateGroup($groupId)
    {
        var_dump('testUpdateGroup'); return; /* TODO */

        $updatedName = 'BarFooGroup';

        $group = new Model\Group();
        $group->setId($groupId);
        $group->setName($updatedName);

        $groupList = [$group];

        $response = Service\Accounts::updateGroups($groupList);

        $this->assertResponseIsOK($response);

        $group = $this->getOneOf('groups', $response);

        $this->assertArrayHasKey('groupId', $group);
        $this->assertArrayHasKey('groupName', $group);
        $this->assertArrayHasKey('permissionProfileId', $group);
        $this->assertArrayHasKey('groupType', $group);

        $this->assertEquals($updatedName, $group['groupName']);
    }

    /**
     * @depends testAddGroup
     * @depends testUploadAccountBrandProfile
     */
    public function testAddGroupBrands($groupId, $brandProfile)
    {
        $brand = new Model\Brand($brandProfile);

        $brandsList = [$brand];

        return [
            'brand' => $brand->getData(),
            'groupId' => $groupId
        ];

        /* TODO */

        $response = Service\Accounts::addGroupBrands($groupId, $brandsList);

        $this->assertResponseIsOK($response);

        $addedBrand = $this->getOneOf('brands', $response);

        $this->assertArrayHasKey('brandId', $addedBrand);

        // groupBranding.
        return [
            'brand' => $brand->getData(),
            'groupId' => $groupId
        ];
    }

    /**
     * @depends testAddGroupBrands
     */
    public function testGetGroupBrands($groupBranding)
    {
        #$brandProfile = $groupBranding['brand'];
        $groupId = $groupBranding['groupId'];

        $response = Service\Accounts::getGroupBrands($groupId);

        $this->assertResponseIsOK($response);

        $brand = $this->getOneOf('brands', $response);

        $this->assertArrayHasKey('brandId', $brand);
        $this->assertArrayHasKey('brandName', $brand);
        $this->assertArrayHasKey('brandCompany', $brand);
    }

    /**
     * @depends testAddGroupUsers
     */
    public function testDeleteGroupUsers($groupUsers)
    {
        var_dump('testDeleteGroupUsers'); return; /* TODO */

        $userInformation = $groupUsers['user'];
        $groupId = $groupUsers['groupId'];

        $user = new Model\User($userInformation);

        $usersList = [$user];

        $response = Service\Accounts::deleteGroupUsers($groupId, $usersList);

        $this->assertResponseIsOK($response);

        $user = $this->getOneOf('users', $response);

        $this->assertArrayHasKey('userName', $user);
        $this->assertArrayHasKey('userId', $user);
        $this->assertArrayHasKey('userType', $user);
        $this->assertArrayHasKey('userStatus', $user);
        $this->assertArrayHasKey('uri', $user);
    }

    /**
     * @depends testAddGroupBrands
     */
    public function testDeleteGroupBrands($groupBranding)
    {
        var_dump('testDeleteGroupBrands'); return; /* TODO */

        $brandProfile = $groupBranding['brand'];
        $groupId = $groupBranding['groupId'];

        $brand = new Model\Brand($brandProfile);

        $brandsList = [$brand];

        $response = Service\Accounts::deleteGroupBrands($groupId, $brandsList);

        $this->assertResponseIsOK($response);

        $deletedBrand = $this->getOneOf('brands', $response);

        $this->assertArrayHasKey('brandId', $deletedBrand);
    }

    /**
     * @depends testAddGroup
     */
    public function testDeleteGroup($groupId)
    {
        var_dump('testDeleteGroup'); return; /* TODO */

        $group = new Model\Group();
        $group->setId($groupId);

        $groupList = [$group];

        $response = Service\Accounts::deleteGroups($groupList);

        $this->assertResponseIsOK($response);

        $group = $this->getOneOf('groups', $response);

        $this->assertArrayHasKey('groupId', $group);
        $this->assertArrayHasKey('groupType', $group);

        $this->assertEquals($groupId, $group['groupId']);
        $this->assertEquals(Model\Group::TYPE_CUSTOM, $group['groupType']);
    }
}