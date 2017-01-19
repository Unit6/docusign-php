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
    const ADRESS_BOOK_ACL_USE_ONLY_SHARED,       = 'UseOnlyShared';
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
}