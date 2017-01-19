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
 * DocuSign View Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class View extends DocuSign\Model
{
    // returnUrl events.
    const EVENT_CANCEL           = 'cancel';
    const EVENT_DECLINE          = 'decline';
    const EVENT_EXCEPTION        = 'exception';
    const EVENT_FAX_PENDING      = 'fax_pending';
    const EVENT_ID_CHECK_FAILD   = 'id_check_failed';
    const EVENT_SESSION_TIMEOUT  = 'session_timeout';
    const EVENT_SIGNING_COMPLETE = 'signing_complete';
    const EVENT_TTL_EXPIRED      = 'ttl_expired';
    const EVENT_VIEWING_COMPLETE = 'viewing_complete';

    // authenticationMethod
    const AUTH_METHOD_EMAIL = 'email';

    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }

    public function setAuthenticationMethodToEmail()
    {
        $this->setAuthenticationMethod(self::AUTH_METHOD_EMAIL);
    }
}