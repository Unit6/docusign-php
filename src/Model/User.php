<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign\Model;

use Unit6\DocuSign;

/**
 * DocuSign User Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class User extends DocuSign\Model
{
    // userSettings:canEditSharedAddressBook
    const ADRESS_BOOK_ACL_NONE                   = 'None';
    const ADRESS_BOOK_ACL_USE_ONLY_SHARED        = 'UseOnlyShared';
    const ADRESS_BOOK_ACL_USE_PRIVATE_AND_SHARED = 'UsePrivateAndShared';
    const ADRESS_BOOK_ACL_SHARE                  = 'Share';

    // userSettings:canManageTemplates
    const TEMPLATE_ACL_NONE   = 'None';
    const TEMPLATE_ACL_USE    = 'Use';
    const TEMPLATE_ACL_CREATE = 'Create';
    const TEMPLATE_ACL_SHARE  ='Share';

    // userSettings:vaultingMode
    const VAULTING_MODE_NONE = 'None';
    const VAULTING_MODE_ESTORED = 'eStored';
    const VAULTING_MODE_ELETRONIC_ORIGINAL = 'electronicOriginal';

    // authenticationMethods
    const AUTH_METHOD_PHONE   = 'PhoneAuth';
    const AUTH_METHOD_STAN    = 'STAN';
    const AUTH_METHOD_ISCHECK = 'ISCheck';
    const AUTH_METHOD_OFAC    = 'OFAC';
    const AUTH_METHOD_CODE    = 'AccessCode';
    const AUTH_METHOD_AGE     = 'AgeVerify';
    const AUTH_METHOD_SSO     = 'SSOAuth';

    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }

    public function setId($id)
    {
        $this->setUserId($id);
    }

    public function getId()
    {
        return $this->getUserId();
    }

    public function setSettings(array $information)
    {
        $item = [];

        // parse the information against the whitelist.
        foreach ($information as $key => $value) {
            if (isset(DocuSign\Parameters::$userSettings[$key])) {
                $format = DocuSign\Parameters::$userSettings[$key];
                if (   (is_string($format) && gettype($value) === $format)
                    || (is_array($format)  && in_array($value, $format))) {
                    $item[$key] = $value;
                }
            }
        }

        $this->setUserSettings($item);
    }

    public function setForgottenPassword($information)
    {
        $list = [];

        foreach ($information as $i => $row) {
            $num = $i + 1;
            $prefix = 'forgottenPassword';
            $aKey = sprintf('%sAnswer%d', $prefix, $num);
            $qKey = sprintf('%sQuestion%d', $prefix, $num);
            $list[$qKey] = $row['question'];
            $list[$aKey] = $row['answer'];
        }

        $this->setForgottenPasswordInfo($list);
    }

    public function setGroups($information)
    {
        $list = [];

        foreach ($information as $group) {
            $this->filterData($group, [
                'groupId',
                'groupName',
                'permissionProfileId',
                'groupType'
            ]);

            $list[] = $group;
        }

        $this->setGroupList($list);
    }
}