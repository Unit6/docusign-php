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
 * DocuSign Recipient Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Recipient extends DocuSign\Model
{
    // Recipient Types pg. 259-324
    const TYPE_AGENTS               = 'agents';
    const TYPE_CARBON_COPIES        = 'carbonCopies';
    const TYPE_CERTIFIED_DELIVERIES = 'certifiedDeliveries';
    const TYPE_EDITORS              = 'editors';
    const TYPE_IN_PERSON_SIGNERS    = 'inPersonSigners';
    const TYPE_INTERMEDIARIES       = 'intermediaries';
    const TYPE_SIGNERS              = 'signers';

    // Tab Types pg. 324-392
    const TAB_APPROVE           = 'approveTabs';
    const TAB_CHECKBOX          = 'checkboxTabs';
    const TAB_COMPANY           = 'companyTabs';
    const TAB_DATE              = 'dateTabs';
    const TAB_DATE_SIGNED       = 'dateSignedTabs';
    const TAB_DECLINE           = 'declineTabs';
    const TAB_EMAIL             = 'emailTabs';
    const TAB_EMAIL_ADDRESS     = 'emailAddressTabs';
    const TAB_ENVELOPE_ID       = 'envelopeIdTabs';
    const TAB_FIRST_NAME        = 'firstNameTabs';
    const TAB_FORMULA           = 'formulaTabs';
    const TAB_FULL_NAME         = 'fullNameTabs';
    const TAB_INITIAL_HERE      = 'initialHereTabs';
    const TAB_LAST_NAME         = 'lastNameTabs';
    const TAB_LIST              = 'listTabs';
    const TAB_NOTE              = 'noteTabs';
    const TAB_NUMBER            = 'numberTabs';
    const TAB_RADIO_GROUP       = 'radioGroupTabs';
    const TAB_SIGN_HERE         = 'signHereTabs';
    const TAB_SIGNER_ATTACHMENT = 'signerAttachmentTabs';
    const TAB_SSN               = 'ssnTabs';
    const TAB_TEXT              = 'textTabs';
    const TAB_TITLE             = 'titleTabs';
    const TAB_ZIP               = 'zipTabs';

    // embeddedRecipientStartURL
    const SIGN_AT_DOCUSIGN = 'SIGN_AT_DOCUSIGN';

    // displayLevelCode
    const DISPLAY_LEVEL_RO   = 'ReadOnly';
    const DISPLAY_LEVEL_EDIT = 'Editable';
    const DISPLAY_LEVEL_DND  = 'DoNotDisplay';

    // requireSignerCertificate
    const SIGNER_CERT_EXPRESS  = 'docusign_express';
    const SIGNER_CERT_PERSONAL = 'docusign_personal';
    const SIGNER_CERT_SAFE     = 'safe';

    // deliveryMethod
    const DELIVER_METHOD_OFFLINE = 'offline';

    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }

    public function __call($name, $arguments)
    {
        // adding tab helpers.
        if (preg_match('/(addTab)([A-Z]{1}[\S]+)/', $name, $matches)) {
            list($name, $prefix, $property) = $matches;

            $underscore = preg_replace('/([a-z0-9])([A-Z])/', '$1_$2', $property);

            $const = @constant('self::TAB_' . strtoupper($underscore));

            if ( ! is_null($const)  && isset($arguments[0])) {
                return $this->addTabTo($const, $arguments[0]);
            }
        }

        return parent::__call($name, $arguments);
    }

    public function addTabTo($type, Tab $tab)
    {
        $this->data['tabs'][$type][] = $tab->getData();
    }

    /**
     * Sign at DocuSign
     *
     * source: http://stackoverflow.com/a/28815901/
     *
     * Usually specifying a clientUserId causes the recipient to be an
     * "embedded" signer. Alternatively, embeddedRecipientStartURL causes
     * the recipient to also receive an official DocuSign email inviting
     * them to sign the documents.
     *
     * The embeddedRecipientStartURL parameter is intended to be a
     * URL that DocuSign can redirect the signer to within your app,
     * and the idea is that you take care of any necessary authentication.
     * However, rather than supply a URL to your own app, you can instead
     * supply a magic value of "SIGN_AT_DOCUSIGN". In effect, this causes
     * the recipient to be both embedded and receive an official
     * "please sign" email from DocuSign."
     */
    public function setSignAtDocuSign()
    {
        $this->data['embeddedRecipientStartURL'] = self::SIGN_AT_DOCUSIGN;
    }
}