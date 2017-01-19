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
 * Parameters class for validating DocuSign models.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Parameters
{
    public static $typeOptions = [
        'boolean',
        'integer',
        'float',
        'string',
        'array',
        'object',
        'object',
        'null'
    ];

    // pg.
    public static $recipientIntermediary = [];

    // pg. 60
    // A complex type that contains the social information.
    public static $socialAccountInformation = [
        // The users email address.
        'email' => 'string',
        // The social account provider (Facebook, Yahoo, etc.).
        'provider' => 'string',
        //
        'socialId' => 'string',
        // The full user name for the account.
        'userName' => 'string'
    ];

    // pg. 60, 79
    // A complex type that contains the following information
    // for entering referral and discount information.
    public static $referralInformation = [
        'advertisementId' => 'string',
        'enableSupport' => 'string',
        'groupMemberId' => 'string',
        'idType' => 'string',
        'includedSeats' => 'string',
        'industry' => 'string',
        'planStartMonth' => 'string',
        'promoCode' => 'string',
        'publisherId' => 'string',
        'referralCode' => 'string',
        'referrerName' => 'string',
        'shopperId' => 'string',
        // Following reserved for DoucSign use only:
        'saleDiscountPercent' => 'string',
        'saleDiscountAmount' => 'string',
        'saleDiscountFixedAmount' => 'string',
        'saleDiscountPeriods' => 'string',
        'saleDiscountSeatPriceOverride' => 'string',
    ];

    // pg. 324-
    // Tab Types and Parameters
    // Tabs are used to indicate locations in a document where the recipient
    // should take some action. Tabs are associated with a specific recipient
    // and are only used by the recipient types In Person Signers and Signers.
    // There are 24 different tab types.
    //
    // Tab types share some common parameters, but the exact parameters
    // associated with a tab depend on the tab type. Tabs are associated
    // with a specific recipient and are only used by the recipient types
    // In Person Signers and Signers.
    //
    public static $tab = [
        // Specifies string searched for to place the tab in the document.
        'anchorString' => 'string',
        // This specifies tab location as XOffset position,
        // using the anchorUnits, from the anchorString.
        'anchorXOffset' => 'string',
        // This specifies tab location as YOffset position,
        // using the anchorUnits, from the anchorString.
        'anchorYOffset' => 'string',
        // True or false setting. If true, this tab is ignored if
        // anchorString is not found in the document.
        'anchorIgnoreIfNotPresent' => 'string',
        // Specifies units of the X and Y offset.
        // Units could be pixels, mms, cms or inches.
        'anchorUnits' => 'string',
        // Optional element. For conditional fields this is the TabLabel of
        // the parent tab that controls this tab’s visibility.
        'conditionalParentLabel' => 'string',
        // Optional element. For conditional fields this is the Value of
        // the parent tab that controls this tab’s visibility. If the
        // parent tab is a Checkbox, Radio button, Optional Signature,
        // or Optional Initial use 'on' as the value to show that the
        // parent tab is active.
        'conditionalParentValue' => 'string',
        // This is the document ID number that the tab is placed on.
        // This must refer to an existing Document's ID attribute.
        'documentId' => 'string',
        // This specifies the page number where the tab will be affixed.
        'pageNumber' => 'string',
        // This specifies the recipient associated with the tab.
        // Must refer to an existing recipient's ID attribute.
        'recipientId' => 'string',
        // Optional element. Used only when working with template tabs.
        // If true, the attributes of the tab cannot be changed by the sender.
        'templateLocked' => 'boolean',
        // Optional element. Used only when working with template tabs.
        // If true, the tab cannot be removed by the sender.
        'templateRequired' => 'boolean',
        // This indicates the horizontal offset of the tab on the page,
        // in a coordinate space that has left top corner of the
        // document as origin.
        'xPosition' => 'string',
        // This indicates the vertical offset of the tab on the page,
        // in a coordinate space that has left top corner of the
        // document as origin.
        'yPosition' => 'string',
        // The label used with the tab. This can be a maximum of 500 characters.
        // Notes: Making a tab’s TabLabel the same will cause the all like
        // fields to update when the user enters data.
        'tabLabel' => 'string',

        //
        // approveTabs, companyTabs, dateSignedTabs, dateTabs, declineTabs,
        // emailTabs, emailAddressTabs, firstNameTabs, formulaTabs, fullNameTabs,
        // lastNameTabs, listTabs, noteTabs, numberTabs, ssnTabs, textTabs,
        // titleTabs, zipTabs
        //

        // If true, the information in the tab is bold.
        'bold' => 'boolean',
        // The font type used for the information in the tab.
        // Possible values are: Arial, ArialNarrow, Calibri, CourierNew,
        // Garamond, Georgia, Helvetica, LucidaConsole, Tahoma,
        // TimesNewRoman, Trebuchet, and Verdana.
        'font' => 'string', // Font
        // The font color used for the information in the tab.
        // Possible values are: Black, BrightBlue, BrightRed, DarkGreen,
        // DarkRed, Gold, Green, NavyBlue, Purple, or White.
        'fontColor' => '', // FontColor
        // The font size used for the information in the tab.
        // Possible values are: Size7, Size8, Size9, Size10, Size11, Size12,
        // Size14, Size16, Size18, Size20, Size22, Size24, Size26, Size28,
        // Size36, Size48, or Size72.
        'fontSize' => '', // FontSize
        // If true, the information in the tab is italic.
        'italic' => 'boolean',
        // If true, the information in the tab is underlined.
        'underline' => 'boolean',
        // The text displayed in the tab. Only used in approveTabs and decineTabs.
        'buttonText' => 'string',
        // Height of the tab.
        'height' => 'string',
        // Width of the tab.
        'width' => 'string',

        //
        // companyTabs, dateSignedTabs, dateTabs, emailTabs, formulaTabs,
        // numberTabs, signerAttachmentTabs, textTabs, titleTabs, zipTabs
        //

        // The names associated with the tab type.
        'name' => 'string',
        // If true, the signer is required to fill out this tab.
        'required' => 'boolean',
        // This element specifies the value of the tab.
        'value' => 'string',

        //
        // initialHereTabs, signHereTabs
        //

        // When true, the Initial Here tab is optional and the recipient
        // is not required to add initials to complete an envelope.
        'optional' => 'boolean',
        // Sets the size for Initial Here tab. It can be value from
        // 0.5 to 1.0, where 1.0 represents full size and 0.5 is 50% size.
        'scaleValue' => 'string',

        //
        // companyTabs, dateTabs, emailTabs, formulaTabs, numberTabs,
        // ssnTabs, textTabs, titleTabs, zipTabs
        //

        // Optional element. If true the field appears normally while the
        // recipient is adding or modifying the information in the field,
        // but the data is not visible (the characters are hidden by asterisks)
        // to any other signer or the sender. When an envelope is completed
        // the information is available to the sender through the Form Data
        // link in the DocuSign Console.
        //
        // This setting applies only to text boxes and does not affect
        // list boxes, radio buttons, or check boxes.
        'concealValueOnDocument' => 'boolean',
        // Disables the auto sizing of single line text boxes in the signing
        // screen when the signer enters data. If disabled users will only be
        // able enter as much data as the text box can hold. By default this
        // is false. This property only affects single line text boxes.
        'disableAutoSize' => 'boolean',
        // If true, the Signer cannot change the data in the tab.
        'locked' => 'boolean',


        //
        // checkboxTabs, dateTabs, emailTabs, formulaTabs, listTabs,
        // numberTabs, ssnTabs, textTabs, zipTabs
        //

        // Reserved for future use.
        'mergeFieldXml' => 'string',
        // Optional element for field markup. When set to true it
        // requires the signer to initial when they modify a shared field.
        'requireInitialOnSharedChange' => 'boolean',
        // Optional element for field markup. When set to true,
        // enables field markup for the field.
        'shared' => 'boolean',

        //
        // checkboxTabs
        //

        // If true, the checkbox is selected.
        'selected' => 'boolean',

        //
        // listTabs
        //

        // Only used with list tabs. These are the possible selections for a dropdown list.
        // Each selection has three parts:
        //  - selected: Sets if this is the default selection shown to a signer.
        //              Use true/false to show the value is selected or not.
        //              Only one selection can be true.
        //  - text: The text shown in the dropdown list.
        //  - value: The value used when the selected.
        'listItems' => [],

        //
        // radioGroupTabs
        //

        // The group name for radio buttons that are grouped together.
        // This can be a maximum of 500 characters. It works in conjunction
        // with the radios parameter.
        'groupName' => 'string',
        // This sets the locations and status for radio buttons that are
        // grouped together.
        'radios' => [],

        //
        // textTabs
        //

        // Message to be displayed to the signer if the validation rule
        // from validationPattern fails. This is optional and if not
        // provided the default DocuSign message will be displayed. This
        // can be a maximum of 250 characters.
        'validationMessage' => 'string',
        // A regular expression that will be validated when data is entered
        // in the field. This is optional and if not provided the default
        // DocuSign validation rules will apply. This can be a maximum of
        // 250 characters. Javascript RegEx object is used for regular
        // expression validation. Regular expressions must be supported
        // by this object to resolve.
        'validationPattern' => 'string',
        // When true, sets this as a payment tab. Can only be used with Text,
        // Number, Formula or List tabs. The value of the tab must be a number.
        'isPaymentAmount' => 'boolean',
    ];

    // pg. 54-60
    public static $account = [
        // The account name for the new account.
        'accountName' => 'string',
        // The name/value pair information for account settings.
        // These determine the features available for the account.
        'accountSettings' => [],
        // Note: If country is US (United States) then State codes
        // are validated for US States. Otherwise, State is treated
        // as a non-validated string and serves the purpose of entering
        // a state/province/region.
        'addressInformation' => [
            'address1' => 'string',
            'address2' => 'string',
            'city' => 'string',
            'country' => 'string',
            'fax' => 'string',
            'phone' => 'string',
            'postalCode' => 'string',
            'state' => 'string'
        ],
        // The credit card used to pay for this account.
        'creditCardInformation' => [
            'cardNumber' => 'string',
            'cardType' => 'string',
            'expirationMonth' => 'string',
            'expirationYear' => 'string',
            'nameOnCard' => 'string'
        ],
        // The Distributor Code that identifies the billing plan groups
        // and plans for the new account.
        'distributorCode' => 'string',
        // The Distributor Password for the distributorCode.
        'distributorPassword' => 'string',
        // A complex type with the initial user information for the new account.
        'initialUser' => [], // Model\User
        // A complex type that sets the feature sets for the account.
        'planInformation' => [], // Model\Plan,
        // A complex type that contains the following information
        // for entering referral and discount information.
        'referralInformation' => [],
        // A complex type that contains social accounts.
        'socialAccountInformation' => []
    ];

    // pg. 59
    // pg. 79
    public static $plan = [
        // This is the ISO currency code for the account.
        'currencyCode' => 'string',
        // A complex type that sets the feature sets for the account.
        'planFeatureSets' => [],
        // The plan ID for the account. It uniquely identifies
        // a plan and is used to set plans in other functions.
        'planId' => 'string',
        // Reserved for DocuSign use only.
        'freeTrialDaysOverride' => 'string'
    ];

    // pg. 59
    // pg. 79
    public static $planFeature = [
        'currencyFeatureSetPrices' => [
            // This contains the currencyCode and currencySymbol
            // for each alternate currency values for envelopeFee,
            // fixedFee, seatFee that are configured for this plan
            // feature set.
            [
                'currencyCode' => 'string',
                'currencySymbol' => 'string',
                'envelopeFee' => 'string',
                'fixedFee' => 'string',
                'seatFee' => 'string'
            ]
        ],
        // An incremental envelope cost for plans with envelope
        // overages (when isEnabled=true).
        'envelopeFee' => 'string',
        // A unique ID for the feature set.
        'featureSetId' => 'string',
        // A one-time fee associated with the plan
        // (when isEnabled=true).
        'fixedFee' => 'string',
        // Determines if the feature set is actively set as
        // part of the plan.
        'isActive' => 'string',
        // Determines if the feature set is actively enabled as
        // part of the plan.
        'isEnabled' => 'string',
        // The name of the feature set.
        'name' => 'string',
        // An incremental seat cost for seat-based plans
        // (when isEnabled=true).
        'seatFee' => 'string'
    ];

    // pg. 60-66
    public static $accountSettings = [
        // When true, the account allows in process envelopes
        // to be corrected. (Admin)
        'allowEnvelopeCorrect' => 'boolean',
        // When true, the account allows In Person Signing.
        // Authorization Required: SysAdmin
        'allowInPerson' => 'boolean',
        // When true, the account can use Offline Signing and
        // envelopes signed using offline signing on mobile devices
        // are synchronized with this account. This option and the
        // inSessionEnabled option must both be enabled (true) for
        // a caller to use offline signing.
        // Authorization Required: Admin
        'allowOfflineSigning' => 'boolean',
        // When true, senders are allowed to use the DocuSign Express
        // digital signatures.
        // Authorization Required: Admin
        'allowExpressSignerCertificate' => 'boolean',
        // When true, senders are allowed to use the OpenTrust
        // digital signatures.
        // Authorization Required: Admin
        'allowOpenTrustSignerCertificate' => 'boolean',
        // When true, senders are allowed to use the SAFE BioPharma
        // digital signatures.
        // Authorization Required: Admin
        'allowSafeBioPharmaSignerCertificate' => 'boolean',
        // When true, the account allows users to share custom tags (fields).
        // Note: This setting is only shown when getting account settings.
        // It cannot be modified.
        // Authorization Required: Admin
        'allowSharedTabs' => 'boolean',
        // When true, the account allows signers to reassign an
        // envelope.
        // Authorization Required: Admin
        'allowSignerReassign' => 'boolean',
        // When true, envelope documents are included as a PDF file
        // attachment for signing completed emails.
        // Authorization Required: SysAdmin
        'attachCompletedEnvelope' => 'boolean',
        // The auto-navigation rule for the account.
        // Authorization Required: Admin
        'autoNavRule' => [
            'Off',
            'RequiredFields',
            'RequiredAndBlankFields',
            'AllFields',
            'PageThenRequiredFields',
            'PageThenRequiredAndBlankFields',
            'PageThenAllFields'
        ],
        // When true, account administrators can self-brand their sending
        // console through the DocuSign Console.
        // Authorization Required: SysAdmin
        'canSelfBrandSend' => 'boolean',
        // When true, account administrators can self-brand their signing
        // console through the DocuSign Console.
        // Authorization Required: SysAdmin
        'canSelfBrandSign' => 'boolean',
        // When true, signers cannot use the upload signature/initials
        // image option when signing a document.
        // Authorization Required: Admin
        'disableUploadSignature' => 'boolean',
        // When true, the auto-navigation is enabled for the account.
        // Authorization Required: SysAdmin or EnableAutoNavByDSAdmin is set
        'enableAutoNav' => 'boolean',
        // When true, the account allows bulk sending of envelopes.
        // Authorization Required: Admin
        'enableBulkRecipient' => 'boolean',
        // When true, this account can use the Calculated Fields feature.
        // Authorization Required: Admin & AllowExpression is set
        'enableCalculatedFields' => 'boolean',
        // When true, PowerForm access is enabled for the account.
        // Authorization Required: SysAdmin
        'enableDSPro' => 'boolean',
        // When true, senders for this account can choose to
        // have the envelope ID stamped in the document
        // margins.
        // Authorization Required: SysAdmin or account has EnableEnvelopeStampingByDSAdmin set)
        'enableEnvelopeStampingByAccountAdmin' => 'boolean',
        // When true, Payment Processing is enabled for the account.
        // Authorization Required: Admin & AllowPaymentProcessing is set
        'enablePaymentProcessing' => 'boolean',
        // When true, PowerForm access is enabled for the account.
        // Authorization Required: SysAdmin
        'enablePowerForm' => 'boolean',
        // When true, the account can use the requireSignOnPaper option.
        // Authorization Required: Admin
        'enableRequireSignOnPaper' => 'boolean',
        // When true, an account administrator can reserve web domain and users.
        // Authorization Required: SysAdmin
        'enableReservedDomain' => 'boolean',
        // When true, this account can use the Agent Recipient Type.
        // Authorization Required: SysAdmin
        'enableSendToAgent' => 'boolean',
        // When true, this account can use the Intermediary Recipient Type.
        // Authorization Required: Admin & AllowSendToIntermediary is set
        'enableSendToIntermediary' => 'boolean',
        // When true, this account can use the Editor Recipient Type.
        // Authorization Required: Admin
        'enableSendToManage' => 'boolean',
        // When true, the account can define the routing order of
        // recipients for envelopes sent using the DocuSign API.
        // Authorization Required: SysAdmin
        'enableSequentialSigningAPI' => 'boolean',
        // When true, the account can define the routing order of
        // recipients for envelopes sent using the DocuSign console.
        // Authorization Required: SysAdmin
        'enableSequentialSigningUI' => 'boolean',
        // When true, a user can request attachments from a signer.
        // Authorization Required: Admin
        'enableSignerAttachments' => 'boolean',
        // When true, a user can allow signers to use the sign on paper option.
        // Authorization Required: Admin
        'enableSignOnPaper' => 'boolean',
        // When true, a user can override the default account setting
        // for the sign on paper option.
        // Authorization Required: Admin
        'enableSignOnPaperOverride' => 'boolean',
        // When true, Transaction Point is enabled for this account.
        // Authorization Required: SysAdmin
        'enableTransactionPoint' => 'boolean',
        // When true, this account can use electronic vaulting for documents.
        // Authorization Required: SysAdmin
        'enableVaulting' => 'boolean',
        // Shows the envelope integration rule for the account.
        // Authorization Required: SysAdmin
        'envelopeIntegrationAllowed' => ['NotAllowed', 'Full', 'IntegrationSendOnly'],
        // When true, envelope integration is enabled for the account.
        // Authorization Required: Admin & EnvelopeIntegrationAllowed is set
        'envelopeIntegrationEnabled' => 'boolean',
        // When true, envelope integration is enabled for the account.
        // Authorization Required: Admin & EnvelopeIntegrationAllowed is set
        'envelopeIntegrationEnabled' => 'boolean',
        // When true, envelopes sent by this account automatically
        // have the envelope ID stamped in the margins, unless the
        // sender selects not to have them stamped.
        // Authorization Required: GET only
        'envelopeStamplingDefaultValue' => 'boolean',
        // Indicates when a user’s authentication expires.
        // Variable uses the value in IDCheckExpireDays.
        // Authorization Required: Admin
        'iDCheckExpire' => ['Always', 'Never', 'Variable'],
        // The number of days before a user’s authentication expires.
        // This is only active if the IDCheckExpire value is Variable.
        // Authorization Required: Admin
        'iDCheckExpireDays' => 'integer',
        // Indicates if authentication is required by envelope signers.
        // Optional means the authentication is determined by the sender.
        // Authorization Required: Admin
        'iDCheckRequired' => ['Always', 'Never', 'Optional'],
        // The default question used by the In Person signing host
        // for an In Person signing session.
        // Authorization Required: Admin
        'inPersonIDCheckQuestion' => 'string',
        // When true, the account can use In Session (embedded) and
        // offline signing. This option and the allowOfflineSigning
        // option must both be enabled (true) for a caller to use
        // offline signing.
        // Authorization Required: Admin
        'inSessionEnabled' => 'boolean',
        // Sets the amount of idle activity time, in minutes,
        // before a mobile user is automatically logged off of
        // the system. If the setting is 0, then DocuSign mobile
        // application users are never automatically logged off
        // the system. The minimum setting is 1 minute and the
        // maximum setting is 120 minutes.
        // Note: This setting only applies to the DocuSign for
        // iOS v2.8.2 or later mobile app.
        // Authorization Required: Admin
        'mobileSessionTimeout' => 'string',
        // When true, senders can select to allow the recipient
        // to provide a phone number for the Phone Authentication process.
        // Authorization Required: Admin
        'phoneAuthRecipientMayProvidePhoneNumber' => 'boolean',
        // The policy for adding a digital certificate to downloaded,
        // printed and emailed documents.
        // Authorization Required: Admin
        'pkiSignDownloadedPDFDocs' => ['NoSign', 'NoSignAllowUserOverride', 'YesSign'],
        // The RSA account name.
        // Note: Modifying this value might inadvertently disrupt
        // your ID Check capability. Ensure you have the correct
        // value before changing this.
        // Authorization Required: Admin
        'rsaVeridAccountName' => 'string',
        // The password used with the RSA account.
        // Note: Modifying this value might inadvertently disrupt
        // your ID Check capability. Ensure you have the correct
        // value before changing this.
        // Authorization Required: Admin
        'rsaVeridPassword' => 'string',
        // The RSA rule set used with the account.
        // Note: Modifying this value might inadvertently disrupt
        // your ID Check capability. Ensure you have the correct
        // value before changing this.
        // Authorization Required: Admin
        'rsaVeridRuleset' => 'string',
        // The user ID for the RSA account.
        // Note: Modifying this value might inadvertently disrupt
        // your ID Check capability. Ensure you have the correct
        // value before changing this.
        // Authorization Required: Admin
        'rsaVeridUserId' => 'string',
        // This sets the account setting for how self-signed
        // documents are presented to the email recipients. Enumeration values are:
        // Authorization Required: Admin
        'selfSignedRecipientEmailDocument' => [
            // With this setting a PDF of the completed
            // document is attached to the email
            'include_pdf',
            // With this setting a secure link to the
            // self-signed documents is included in the email.
            'include_link'
        ],
        // When true the selfSignedRecipientEmailDocument
        // userSetting can be set for an individual user.
        // The userSetting will override the account setting.
        // Authorization Required: Admin
        'selfSignedRecipientEmailDocumentUserOverride' => 'boolean',
        // The amount of idle activity time, in minutes, before
        // a user is automatically logged out of the system.
        // The minimum setting is 20 minutes and the maximum
        // setting is 120 minutes.
        // Authorization Required: Admin
        'sessionTimeout' => 'integer',
        // The date/time format applied to Date Signed fields for the account.
        // Authorization Required: Admin
        'signDateFormat' => 'string',
        // When true, the Certificate of Completion is included
        // in the envelope documents PDF when it is downloaded.
        // Authorization Required: AccountAdmin & account is selected in AccountSigningSettings
        'signerAttachCertificateToEnvelopePDF' => 'boolean',
        // When true, the signer without a DocuSign account
        // can create a DocuSign account after signing.
        // Authorization Required: AccountAdmin & account is selected in AccountSigningSettings
        'signerCanCreateAccount' => 'boolean',
        // When true, signers can use the DocuSign mobile signing user interface.
        // Authorization Required: AccountAdmin & account is selected in AccountSigningSettings
        'signerCanSignOnMobile' => 'boolean',
        // When true, an envelope complete email is sent to an
        // In Session (embedded) or offline signer after DocuSign
        // processes the envelope.
        // Authorization Required: Admin
        'signerInSessionUseEnvelopeCompleteEmail' => 'boolean',
        // When true, senders can only send an envelope to
        // a recipient that has a DocuSign account.
        // Authorization Required: AccountAdmin & account is selected in AccountSigningSettings
        'signerMustHaveAccount' => 'boolean',
        // When true, an envelope signer must log in to the
        // DocuSign console to sign an envelope.
        // Authorization Required: AccountAdmin & account is selected in AccountSigningSettings
        'signerMustLoginToSign' => 'boolean',
        // When true, the initial value of all SecureFields
        // is written to the document when sent.
        // Authorization Required: AccountAdmin & account is selected in AccountSigningSettings
        'signerShowSecureFieldInitialValues' => 'boolean',
        // When true, the content of notification emails is
        // determined at the account level.
        // Authorization Required: AccountAdmin & account is selected in AccountSigningSettings
        'useAccountLevelEmail' => 'boolean',
        // When true, the account can use the DocuSign API.
        // Authorization Required: SysAdmin
        'usesAPI' => 'boolean'
    ];

    // pg. 66-67
    public static $billingPlan = [
        // Note: If country is US (United States) then State codes
        // are validated for US States. Otherwise, State is treated
        // as a non-validated string and serves the purpose of entering
        // a state/province/region.
        'billingAddress' => [
            'address1' => 'string',
            'address2' => 'string',
            'city' => 'string',
            'country' => 'string',
            'fax' => 'string',
            'phone' => 'string',
            'postalCode' => 'string',
            'state' => 'string'
        ],
        // The credit card used to pay for this account.
        'creditCardInformation' => [
            'cardNumber' => 'string',
            'cardType' => 'string',
            'expirationMonth' => 'string',
            'expirationYear' => 'string',
            'nameOnCard' => 'string'
        ],
        // If true, the plan has support enabled.
        'enableSupport' => 'boolean',
        // The number of seats included in the plan.
        'includeSeats' => 'string',
        // A complex type that sets the feature sets for the account.
        'planInformation' => [], // Model\Plan
    ];

    // pg. 75-76
    public static $connect = [];

    // pg. 103-105
    public static $document = [
        // The name of the document. This can be a maximum of
        // 100 characters. If the document is encrypted, this
        // is the unencrypted name of the document.
        'name' => 'string',
        // The unique Id for the document in this specific envelope.
        'documentId' => 'string',
        // A numerical value that sets the order documents are
        // presented in the envelope. This is only applicable
        // when adding documents to a draft envelope. When
        // creating and sending an envelope the documents use
        // the order in which they are listed in the request.
        'order' => 'string',
        // Optional element. When set to true PDF form field
        // data will be transformed into document tab values
        // when the PDF form field name matches the DocuSign
        // custom tab TabLabel. The resulting PDF form data
        // will also be returned in the PDF meta data when
        // requesting the document PDF.
        'transformPdfFields' => 'string',
        // If true, the document is been already encrypted
        // by the sender for use with the DocuSign Key Manager
        // security appliance.
        'encryptedWithKeyManager' => 'string',
        // An optional array of name-value strings that allows
        // the sender to provide custom data for a document.
        // This information is returned in the envelope status
        // but otherwise not used by DocuSign.
        // The array of DocumentField contains the elements:
        // Name – A string that can be a maximum of 50 characters.
        // Value – A string that can be a maximum of 200 characters.
        'documentFields' => [],
        // The total number of pages in the document.
        'pages' => 'string',
        // Optional element. File extension type of the document.
        // If the document is non-PDF it will be converted to PDF.
        'fileExtension' => 'string',
        // [CUSTOM]
        // The MIME-Type of the file.
        'mimeType' => 'string',
        // The document byte stream. This allows putting a base64
        //version of document bytes into an envelope.
        'documentBase64' => 'string',
        // Optional element. Only used when uploading and editing
        // templates. Matchboxes are used to define areas in a
        // document for document matching when creating envelopes.
        'matchboxes' => [
            // The document page number that the matchbox should be on.
            'pageNumber' => 'integer',
            'xPosition' => 'integer',
            'yPosition' => 'integer',
            'width' => 'integer',
            'height' => 'integer',
        ],
        'remoteUrl' => 'string',
    ];


    // pg. 99-103
    // pg. 126-132
    public static $envelope = [
        // An optional element that can only be used if Document Accessibility
        // is enabled for the account. This sets the document reading zones
        // for screen reader applications.
        // Note: This information is currently generated from the DocuSign
        // web console by setting the reading zones when creating a template,
        // exporting the reading zone string information, and adding it here.
        'accessibility' => 'string',
        // If true, Document Markup is enabled for envelope. Account must
        // have Document Markup enabled to use this.
        'allowMarkup' => 'string',
        // If true, the recipient can redirect an envelope to a more
        // appropriate recipient.
        'allowReassign' => 'string',
        // When set to true, this enables the Recursive Recipients feature
        // and allows a recipient to appear more than once in the routing order
        'allowRecipientRecursion' => 'string',
        // If true, will queue the envelope for processing and the envelope
        // status will have a value of ‘Processing’. Additionally, get status
        // calls will return ‘Processing’ until completed.
        'asynchronous' => 'string',
        // Specifies the Authoritative copy feature. If set to true the
        // Authoritative copy feature is enabled.
        'authoritativeCopy' => 'string',
        // If true, auto-navigation is enabled for the envelope. The
        // auto-navigation method used is determined by the account setting.
        'autoNavigation' => 'string',
        // This sets the brand profile format used for the envelope. The
        // value in the string is the brandId associated with the profile.
        // Account branding must be enabled for the account to use this option.
        'brandId' => 'string',
        // Optional element. This is the same as the email body. If specified
        // it is included in email body for all envelope recipients. This can
        // be a maximum of 10000 characters.
        'emailBlurb' => 'string',
        // The subject of the email that will be sent to all recipients.
        // This can be a maximum of 100 characters.
        'emailSubject' => 'string',
        // If true, the signer is allowed to print the document and sign it
        // on paper.
        'enableWetSign' => 'string',
        // It true, the signer is required to have a signature or initial
        // tab on the document or that the document has no signers in order
        // to view it. Account must have Document Visibility enabled to use this.
        'enforceSignerVisibility' => 'string',
        // If true, Envelope ID Stamping is enabled.
        'envelopeIdStamping' => 'string',
        // If true, prevents senders from changing the emailBlurb and
        // emailSubject for the envelope. Additionally, this prevents
        // users from making changes to the emailBlurb and emailSubject
        // when correcting envelopes However, if the messageLock node is
        // set to True and the emailSubject is empty, senders and correctors
        // are able to add a subject to the envelope.
        'messageLock' => 'string',
        // An optional complex element that specifies the notification
        // options for the envelope. It consists of:
        'notification' => [
            // When true, the account default notification settings
            // are used for the envelope.
            'useAccountDefaults' => 'boolean',
            // A complex element that specifies reminder settings
            // for the envelope. It consists of:
            'reminders' => [
                // When true a reminder message is sent to the recipient.
                'reminderEnabled' => 'boolean',
                // An interger that sets the number of days after the
                // recipient receives the envelope that reminder emails
                // are sent to the recipient.
                'reminderDelay' => 'integer',
                // An interger that sets the interval, in days, between
                // reminder emails.
                'reminderFrequency' => 'integer',
            ],
            // A complex element that specifies the expiration settings
            // for the envelope. It consists of:
            'expirations' => [
                // When true the envelope expires (is no longer available
                // for signing) in the set number of days.
                'expireEnabled' => 'boolean',
                // An integer that sets the number of days the envelope
                // is active.
                'expireAfter' => 'integer',
                // An integer that sets the number of days before
                // envelope expiration that an expiration warning
                // email is sent to the recipient. If set to 0 (zero),
                // no warning email is sent.
                'expireWarn' => 'integer',
            ],
        ],
        // If true, prevents senders from changing, correcting,
        // or deleting the recipient information for the envelope.
        'recipientsLock' => 'string',
        // Specifies the physical location where the signing takes place.
        // It can have two enumeration values; InPerson and Online.
        // The default value is Online.
        'signingLocation' => 'string',
        // Sets envelope status. There are two possible values: sent and created.
        // If status = sent, the envelope is sent to the recipients.
        // If status = created, the envelope is saved as a draft and
        // can be modified and sent later.
        'status' => 'string',
        // An optional element that can be used to identify an envelope.
        // The id is a sender-generated value and is valid in the DocuSign
        // system for 7 days. It is recommended that a transactionId is
        // used for offline signing to ensure that an envelope is not sent
        // multiple times. The transactionId can be used determine if an
        // envelope status (i.e. was created or not) for cases where an
        // internet connection was lost before the envelope status could
        // be returned.
        'transactionId' => 'string',
        // When set to 'false', the Electronic Record and Signature Disclosure
        // is not shown to any envelope recipients. When set to 'true', the
        // disclosure is shown to recipients in accordance with the account's
        // Electronic Record and Signature Disclosure frequency setting. If
        // there is no setting for use useDisclosure, then the account's normal
        // disclosure setting is used and the useDisclosure setting is not
        // returned in responses when getting envelope information.
        'useDisclosure' => 'boolean',
        // A complex element that can be used to record information about
        // the envelope, help search for envelopes and track information.
        // See the section on getting Custom Fields for more information
        // about and descriptions of the custom fields.
        'customFields' => [],
        // Complex element contains the details on the documents in the envelope.
        'documents' => [], // Collection of DocuSign\Model\Document
        // Specifies the envelope recipients.
        'recipients' => [], // Collection of DocuSign\Model\Recipient
        // This optional complex element allows a message to be sent a specified
        // URL when the envelope or recipient changes status. It is similar to
        // DocuSign Connect. For example, if an envelope changes from "Sent"
        // to "Delivered", a message containing the updated envelope status
        // and optionally the documents is sent to the URL.
        //
        // When an eventNotification is attached to an envelope using the API, it
        // only applies to the envelope (treating the envelope as the sender).
        // This is different from envelopes created through the console user
        // interface, where the user is treated as the sender.
        'eventNotification' => [
            // The endpoint where envelope updates are sent. This will
            // accept XML unless “useSoapInterface” is set to true.
            'url' => 'string',
            // When set to true, logging is turned on for envelope
            // events on the Web Console Connect page.
            'loggingEnabled' => 'boolean',
            // When set to true, the DocuSign Connect service checks
            // that the message was received and retries on failures.
            'requireAcknowledgment' => 'boolean',
            // When set to true, this tells the Connect service that
            // the user’s endpoint has implemented a SOAP interface.
            'useSoapInterface' => 'boolean',
            // This lists the namespace in the SOAP listener provided.
            'soapNameSpace' => 'boolean',
            // When set to true, this tells the Connect service to send
            // the DocuSign signedby certificate as part of the outgoing
            // SOAP xml. This appears in the XML as wsse:BinarySecurityToken.
            'includeCertificateWithSoap' => 'boolean',
            // When set to true, messages are signed with an X509 certificate.
            // This provides support for 2-way SSL in the envelope.
            'signMessageWithX509Cert' => 'boolean',
            // When set to true, the PDF documents are included in the
            // message along with the updated XML.
            'includeDocuments' => 'boolean',
            // When true, Connect will include the voidedReason for voided
            // envelopes.
            'includeEnvelopeVoidReason' => 'boolean',
            // When set to true, the envelope time zone information
            // is included in the message.
            'includeTimeZone' => 'boolean',
            // When set to true, the sender account ID is included as
            // a envelope custom field in the data.
            'includeSenderAccountAsCustomField' => 'boolean',
            // When set to true, this tells the Connect Service to include
            // the Document Fields associated with the envelope. Document
            // Fields are optional custom name-value pairs added to documents
            // using the API.
            'includeDocumentFields' => 'boolean',
            // When set to true, this tells the Connect Service to include
            // the Certificate of Completion with completed envelopes.
            'includeCertificateOfCompletion' => 'boolean',
            // The list of envelope-level events statuses that will
            // trigger Connect to send updates to the url. It can be
            // a two-part list with:
            //  - envelopeEventStatus: The envelope status, this can
            //          be Sent, Delivered, Signed, Completed, Declined,
            //          or Voided.
            'envelopeEvents' => [],
            // The list of recipient event statuses that will trigger
            // Connect to send updates to the url. It can be a two-part
            // list with:
            //  - recipientEventStatus: The recipient status, this can
            //          be AuthenticationFailed, AutoResponded, Completed,
            //          Declined, Delivered or Sent.
            'recipientEvents' => [],
        ],
        // This optional complex element allows sender to override some
        // envelope email setting information. This can be used to override
        // the Reply To email address and name associated with the envelope
        // and to override the BCC email addresses to which an envelope is sent.
        //
        // When the emailSettings information is used for an envelope,
        // it only applies to that envelope.
        //
        // IMPORTANT: The emailSettings information is not returned in the
        // GET for envelope status. Use GET /email_settings to return
        // information about the emailSettings.
        'emailSettings' => [
            // The Reply To email used for the envelope. DocuSign will verify
            // a correct email format is used, but does not verify that the email
            // is active. This can be a maximum of 100 characters.
            'replyEmailAddressOverride' => 'string',
            // The name associated with the Reply To email address. This can be
            // a maximum of 100 characters.
            'replyEmailNameOverride' => 'string',
            // Only users with canManageAccount setting can use this option.
            // This is an array of up to 5 email addresses the envelope is sent
            // to as a BCC email.
            //      - email: The BCC email address. DocuSign verifies that
            //               the email format is correct, but does not verify
            //               that the email is active. This can be a maximum
            //               of 100 characters. Using this overrides the BCC
            //               for Email Archive information setting for this
            //               envelope.
            //
            // Example: if your account has BCC for Email Archive set up for
            // the email address 'archive@mycompany.com' and you send an envelope
            // using the BCC Email Override to send a BCC email to
            // 'salesarchive@mycompany.com', then a copy of the envelope is only
            // sent to the 'salesarchive@mycompany.com' email address.
            'bccEmailAddresses' => [],
        ],
    ];

    // pg. 166-167
    public static $view = [
        // A sender created value that shows the recipient is embedded
        // (captive). This can be a maximum of 100 characters.
        'clientUserId' => 'string',
        // The convention used to authenticate the end-user.
        'authenticationMethod' => 'string',
        // A unique identifier of the authentication event executed by
        // the client application.
        'assertionId' => 'string',
        // The date/time that the end-user was authenticated.
        'authenticationInstant' => 'string', // DateTime
        // The domain to which the user authenticated.
        'securityDomain' => 'string',
        // Specifies the email of the recipient.
        // Note: You can use either email and userName or userId to
        // identify the recipient.
        'email' => 'string',
        // The recipient ID for the recipient.
        'recipientId' => 'string',
        // The URL the recipient is directed to on certain events.
        // DocuSign sends returns to the URL and includes an event
        // parameter that can be used to redirect the recipient to
        // another location.
        'returnUrl' => 'string',
        // Specifies the user ID of the recipient.
        // Note: You can use with userId or email and userName to identify
        // the recipient. If userId is used and a clientUserId is provided,
        // the userId must match a recipientId (which can be retrieved with
        // a GET recipients call) for the envelope. If userId is used and
        // a clientUserId is not provided, the userId match the userId of
        // the authenticating user.
        'userId' => 'string',
        // Specifies the username of the recipient.
        // Note: You can use either email and userName  or userId to
        // identify the recipient.
        'userName' => 'string',
    ];

    // pg. 177
    public static $group = [
        // The DocuSign group ID for the group (required).
        'groupId' => 'string',
        // The name for the group.
        'groupName' => 'string',
        // The type of group.
        'groupType' => 'string',
        // The ID number of the permission profile that the group
        // is associated with. See Get a List of Permission Profiles
        // for information on retrieving a list of IDs
        'permissionProfileId' => 'string',
    ];

    // pg. 179-180
    public static $brand = [
        // The brandId of the brand profile being added to the group.
        'brandId' => 'string',
        // The brand name associated with the brand profile.
        'brandName' => 'string',
        // The brand company associated with the brand profile.
        'brandCompany' => 'string'
    ];

    // pg. 264-270
    public static $template = [
        'accessibility' => 'string',
    ];

    // pg. 213-216
    public static $user = [
        // The activation code the new user must enter
        // when activating their account.
        'activationAccessCode' => 'string',
        // The user’s email address for the associated account.
        // This can be a maximum of 100 characters.
        'email' => 'string',
        // Sets if the user is enabled for updates from
        // DocuSign Connect. This is a true/false setting.
        'enableConnectForUser' => 'string',
        // The user’s first name. This can be a maximum of 50 characters.
        'firstName' => 'string',
        // A complex element that has up to four Question/Answer pairs
        // for forgotten password information.
        'forgottenPasswordInfo' => [
            'forgottenPasswordAnswer1' => 'string',
            'forgottenPasswordAnswer2' => 'string',
            'forgottenPasswordAnswer3' => 'string',
            'forgottenPasswordAnswer4' => 'string',
            'forgottenPasswordQuestion1' => 'string',
            'forgottenPasswordQuestion2' => 'string',
            'forgottenPasswordQuestion3' => 'string',
            'forgottenPasswordQuestion4' => 'string',
        ],
        // A list of the group information for groups to add the user to.
        'groupList' => [],
        // The user's last name. This can be a maximum of 50 characters.
        'lastName' => 'string',
        // The user's middle name This can be a maximum of 50 characters.
        'middleName' => 'string',
        // The user's password for the associated account. This can be a
        // maximum of 50 characters.
        'password' => 'string',
        // Sets if another activation email is sent to the user if the
        // fail a log on before activating their account. This is a
        // true/false setting.
        'sendActivationOnInvalidLogin' => 'string',
        // The suffix for the user's name. This can be a maximum of 50 characters.
        'suffixName' => 'string',
        // The user's title. This can be a maximum of 10 characters.
        'title' => 'string',
        // The full user name associated with the account. This can be a
        // maximum of 100 characters.
        'userName' => 'string',
        // The name/value pair information for user settings. These determine
        // the actions that a user can take in the account. The userSettings
        // are listed and described below.
        'userSettings' => [],
        // For user related requests.
        'userId' => 'string',
        'userType' => 'string',
        'userStatus' => 'string',
        'uri' => 'string',
        'createdDateTime' => 'string',
    ];

    // pg. 301-303
    public static $userSettings = [
        // When true, this user can use the bulk send functionality.
        // Authorization Required: Admin
        'allowBulkRecipients' => 'boolean',
        // When true, this provides the sender with the option to set
        // the language used in the standard email format for a
        // recipient when creating an envelope.
        // Authorization Required: Admin
        'allowRecipientLanguageSelection' => 'boolean',
        // When true, this user can send envelopes ‘on behalf of’
        // other users through the API.
        // Authorization Required: Admin
        'allowSendOnBehalfOf' => 'boolean',
        // When true, this user can send and manage envelopes for
        // the entire account using the DocuSign API.
        // Authorization Required: Admin
        'apiAccountWideAccess' => 'boolean',
        // This element sets the address book usage and management
        // rights for the user.
        // Authorization Required: Admin
        'canEditSharedAddressBook' => [
            'None',
            'UseOnlyShared',
            'UsePrivateAndShared',
            'Share'
        ],
        // When true, this user can manage account settings, manage
        // user settings, add users, and remove users.
        // Authorization Required: Admin & not setting for self
        'canManageAccount' => 'boolean',
        // This element sets the template usage and management rights
        // for the user.
        // Authorization Required: Admin & not setting for self
        'canManageTemplates' =>  ['None', 'Use', 'Create', 'Share'],
        // Only needed if Integrator Key is not used. When true, this
        // user can send and manage envelopes using the DocuSign API.
        // Authorization Required: Admin & Account:UsesAPI is set
        'canSendAPIRequests' => 'boolean',
        // When true, this user can send envelopes though the DocuSign Console.
        // Authorization Required: Admin & not setting for self
        'canSendEnvelope' => 'boolean',
        // When true, this user can send and manage envelopes from
        // the DocuSign Desktop Client.
        // Authorization Required: SysAdmin
        'enableDSPro' => 'boolean',
        // When true, this user can define the routing order of recipients
        // for envelopes sent using the DocuSign API.
        // Authorization Required: SysAdmin
        'enableSequentialSigningAPI' => 'boolean',
        // When true, this user can define the routing order of recipients
        // while sending documents for signature.
        // Authorization Required: SysAdmin
        'enableSequentialSigningUI' => 'boolean',
        // When true, this user can add requests for attachments from
        // signers while sending documents.
        // Authorization Required: Admin
        'enableSignerAttachments' => 'boolean',
        // When true, this user can override the account setting that
        // determines if signers may sign their documents on paper as
        // an option to signing electronically.
        // Authorization Required: Admin
        'enableSignOnPaperOverride' => 'boolean',
        // When true, this user can select an envelope from their
        // member console and upload the envelope documents to
        // TransactionPoint.
        // Authorization Required: SysAdmin
        'enableTransactionPoint' => 'boolean',
        // When true, this user can use electronic vaulting for documents.
        // Authorization Required: Admin
        'enableVaulting' => 'boolean',
        // This sets the default language for the user. The supported
        // languages, with the language value shown in parenthesis are:
        // Authorization Required: Admin
        'locale' => [
            'zh_CN',    // Chinese Simplified
            'zh_TW',    // Chinese Traditional
            'nl',       // Dutch
            'en',       // English US
            'fr',       // French
            'de',       // German
            'it',       // Italian
            'ja',       // Japanese
            'ko',       // Korean
            'pt',       // Portuguese
            'pt_BR',    // Portuguese (Brazil)
            'ru',       // Russian
            'es',       // Spanish
        ],
        // When true, this user can create, manage and download the
        // PowerForms documents.
        // Authorization Required: Admin
        'powerFormAdmin' => 'boolean',
        // When true, this user can view and download PowerForms documents
        // Authorization Required: Admin
        'powerFormUser' => 'boolean',
        // This sets the user setting for how self-signed documents
        // are presented to the email recipients. This will
        // override the account setting. This can only be changed
        // if the selfSignedRecipientEmail DocumentUserOverride
        // accountSetting is true.
        // Authorization Required: Admin
        'selfSignedRecipientEmailDocument' => [
            // With this setting a PDF of the completed document
            // is attached to the email
            'include_pdf',
            // With this setting a secure link to the self-signed
            // documents is included in the email.
            'include_link'
        ],
        // This element sets the electronic vaulting mode for the user.
        // Authorization Required: Admin
        'vaultingMode' => ['None', 'eStored', 'electronicOriginal'],
    ];

    // pg. 237
    public static $signature = [
        // The font type for the signature, if the signature
        // is not drawn. It must be one of the supported font types.
        'signtaureFont' => 'string',
        // The initials associated with the signature.
        'signatureInitials' => 'string',
        // The signature's name in the system.
        'signatureName' => 'string',
    ];

    // pg. 228-230
    public static $profile = [];

    // Recipient Types
    // This section has the parameter information for the different
    // recipient types. There are seven possible recipient types:
    // Agents, Carbon Copies, Certified Deliveries, Editors, In Person Signers,
    // Intermediaries, and Signers. Recipient types share some common parameters,
    // but the exact parameters associated with a recipient depend on the
    // recipient type. Refer to the specific recipient type below for more
    // information.
    //
    //  - Agents Recipient Type (pg. 259-268)
    //      This recipient can add name and email information for recipients
    //      that appear after the recipient in routing order. This recipient
    //      type can only be used if enabled for your account.
    //
    // - Carbon Copies Recipient Type (pg. 268-277):
    //      Use this action if the recipient should get a copy of the envelope,
    //      but the recipient does not need to sign, initial, date or add
    //      information to any of the documents. This type of recipient can be
    //      placed in any order in the recipient list. The recipient receives
    //      a copy of the envelope when the envelope reaches the recipient's
    //      order in the process flow and when the envelope is completed.
    //
    // - Certified Deliveries Recipient Type (pg. 277-286):
    //      Use this action if the recipient must receive the completed documents
    //      for the envelope to be completed, but the recipient does not need to
    //      sign, initial, date or add information to any of the documents.
    //      This recipient type can only be used if enabled for your account.
    //
    // - Editors Recipient Type (pg. 286-295):
    //      This recipient has the same management and access rights for the
    //      envelope as the sender and can make changes to the envelope as if
    //      they were using the Advanced Correct feature. This recipient can
    //      add name and email information, add or change the routing order and
    //      set authentication options for the remaining recipients. Additionally,
    //      this recipient can edit signature/initial tabs and data fields for
    //      the remaining recipients. The recipient must have a DocuSign account
    //      to be an editor. This recipient type can only be used if enabled
    //      for your account.
    //
    //  - In-Person Signers Recipient Type (pg. 295-304):
    //      Use this action if the signer is in the same physical location as a
    //      DocuSign user who will act as a Signing Host for the transaction.
    //      The recipient added is the Signing Host and new separate Signer
    //      Name field appears after Sign in person is selected. This recipient
    //      type can only be used if enabled for your account.
    //
    //  - Intermediaries Recipient Type (pg. 304-313)
    //      This recipient can, but is not required to, add name and email
    //      information for recipients at the same or subsequent level in the
    //      routing order (until subsequent Agents, Editors or Intermediaries
    //      recipient types are added). This recipient type can only be used
    //      if enabled for your account.
    //
    // - Signers Recipient Type (pg. 313-323):
    //      Use this action if your recipient must sign, initial, date or add
    //      data to form fields on the documents in the envelope.
    public static $recipient = [
        // Email of the recipient. Notification will be sent to
        // this email id. This can be a maximum of 100 characters.
        'email' => 'string',
        // The full legal name of the recipient. This can be a
        // maximum of 100 characaters.
        'name'  => 'string',
        // This optional element specifies the access code a recipient
        // has to enter to validate the identity. This can be a
        // maximum of 50 characters.
        'accessCode' => 'string',
        // This optional attribute indicates that the access code
        // will be added to the email sent to the recipient; this
        // nullifies the Security measure of Access Code on the recipient.
        'addAccessCodeToEmail' => 'boolean',
        // This specifies if the recipient is embedded or remote.
        // If the clientUserId is not null then the recipient is embedded.
        // Note: This is required if the signer is an offline signer.
        'clientUserId' => 'string',
        // An optional array of strings that allows the sender to provide
        // custom data about the recipient. This information is returned
        // in the envelope status but otherwise not used by DocuSign.
        // Each customField string can be a maximum of 100 characters.
        'customFields' => [],
        // An optional complex type that has information for setting the
        // language for the recipient’s email information.
        // IMPORTANT: If this is enabled for one recipient, it overrides
        // the Envelope Subject and EmailBlurb. Also, you must enable
        // emailNotification for all recipients.
        'emailNotification' => [
            'emailBody' => 'string',
            'emailSubject' => 'string',
            'supportedLanguage' => 'string',
        ],
        // Specifies the documents that are not visibile to this recipient.
        // Document Visibility must be enabled for the account to use this.
        'excludeDocuments' => 'string',
        // Specifies authentication check by name. The names used here must
        // be the same as the authentication type names used by the account
        // (these name can also be found in the web console sending interface
        // in the Identify list for a recipient).
        // This overrides any default authentication setting.
        //
        // Example: Your account has ID Check and SMS Authentication available
        // and in the web console Identify list these appear as 'ID Check $'
        // and 'SMS Auth $'. To use ID check in an envelope, the
        // iDCheckConfigurationName should be 'ID Check $'.
        //
        // If you wanted to use SMS, it would be 'SMS Auth $' and you would
        // need to add you would need to add phone number information to
        // the smsAuthentication node.
        'idCheckConfigurationName' => 'string',
        // This complex element contains input information related to a
        // recipient ID check. It can include the following information.
        // addressInformationInput: Used to set recipient address information
        // and consists of:
        'idCheckInformationInput' => [
            'addressInformationInput' => [
                // consists of six elements, with stree2 and zipPlus4 being optional.
                // The elements are: street1, street2, city, state, zip, zipPlus4.
                // The maximum number of characters in each element are:
                // street1/street2 = 150 characters, city = 50 characters,
                // state = 2 characters, and zip/zipPlus4 = 20 characters.
                'addressInformation' => [],
                // Specifies the display level for the recipient. Values are:
                // ReadOnly, Editable, or DoNotDisplay
                'displayLevelCode' => 'string',
                // A Boolean element that specifies if the information needs
                // to be returned in the response.
                'receiveInResponse' => 'boolean',
            ],
            // Used to set recipient date of birth information and consists of
            'dobInformationInput' => [
                // Specifies the recipient’s date, month and year of birth.
                'dateOfBirth' => 'string',
                // Specifies the display level for the recipient. Values are:
                // ReadOnly, Editable, or DoNotDisplay
                'displayLevelCode' => 'string',
                // A Boolean element that specifies if the information needs
                // to be returned in the response.
                'receiveInResponse' => 'boolean',
            ],
            // Used to set the last four digits of the recipient's SSN
            // information and consists of
            'ssn4InformationInput' => [
                // Specifies the last four digits of the recipient's SSN.
                'ssn4' => 'string',
                // Specifies the display level for the recipient. Values are:
                // ReadOnly, Editable, or DoNotDisplay
                'displayLevelCode' => 'string',
                // A Boolean element that specifies if the information needs
                // to be returned in the response.
                'receiveInResponse' => 'boolean',
            ],
            // Used to set the recipient's SSN information. Note that
            // the ssn9 information can never be returned in the response.
            // The ssn9 input consists of:
            'ssn9InformationInput' => [
                // Specifies the last four digits of the recipient's SSN.
                'ssn9' => 'string',
                // Specifies the display level for the recipient. Values are:
                // ReadOnly, Editable, or DoNotDisplay
                'displayLevelCode' => 'string',
                // [?] - not specified in documentation.
                // A Boolean element that specifies if the information needs
                // to be returned in the response.
                'receiveInResponse' => 'boolean',
            ],
        ],
        // Optional element. If true and the recipient creates a DocuSign
        // account after signing, the Manage Account Email Notification
        // settings are used as the default settings for the recipient's account.
        'inheritEmailNotificationConfiguration' => 'boolean',
        // A note that will be unique to this recipient. This note will be
        // sent to the recipient via the signing email. This note will display
        // in the signing UI near the upper left corner of the document on the
        // signing screen. This can be a maximum of 1000 characters.
        'note' => 'string',
        // Recipient Phone Authentication
        'phoneAuthentication' => [
            // If true then recipient can use whatever phone number they want.
            'RecipMayProvideNumber' => 'boolean',
            // A list of phone numbers the recipient may use.
            'SenderProvidedNumbers' => 'string',
            // Reserved.
            'RecordVoicePrint' => '',
            // Reserved.
            'ValidateRecipProvideNumber' => '',
        ],
        // It would be possible to send attachments with recipients. This
        // complex element contains data in base64Binary. It also contains
        // label and type for the attachment.
        'recipientAttachment' => [],
        // Unique for the recipient. It is used by the tab element to
        // indicate which recipient is to sign the Document.
        'recipientId' => 'string',
        // If set true then the recipient is required to use the specified
        // ID check method (including Phone and SMS authentication) to
        // validate their identity
        'requireIdLookup' => 'boolean',
        // Optional element. This is the role name associated with the recipient.
        // Note: This is required when working with template recipients.
        'roleName' => 'string',
        // This specifies the routing order of the recipient in the envelope.
        'routingOrder' => 'string',
        // Optional element, account must be set up to use SSO to use this.
        // Contains the name/value pair information for the SAML assertion
        // attributes:
        //  - name: The name of the SAML assertion attribute.
        //  - value: The value associated with the named SAML assertion attribute.
        'samlAuthentication' => [], // samlAssertion Attributes
        // Optional element. senderProvidedNumbers. Contains the element:
        'smsAuthentication' => [
            // Array with a list of phone numbers the
            // recipient may use for SMS text authentication.
            'senderProvideNumbers' => []
        ],
        // Lists the social ID type that can be used for recipient authentication.
        'socialAuthentications' => 'boolean',
        // Optional element. Used only when working with template recipients.
        // If true and TemplateLocked = true, the sender must enter an access code.
        'templateAccessCodeRequired' => 'boolean',
        // Optional element. Used only when working with template recipients.
        // If true, the sender cannot change any attributes of the recipient.
        'templateLocked' => 'boolean',
        // Optional element. Used only when working with template recipients.
        // If true, the sender may not remove the recipient.
        'templateRequired' => 'boolean',

        //
        // Agents, Editors and Intermediary Recipient Types
        //

        // Optional element only used with recipient types Agents and Editors.
        // If true, the Agent or Editor Recipient associated with this Recipient
        // can change the Recipient's pre-populated Email address.
        // This element is only active if enabled for the account.
        'canEditRecipientEmail' => 'boolean',
        // Optional element only used with recipient types Agents and Editors.
        // If true, the Agent or Editor Recipient associated with this recipient
        // can change the recipient's pre-populated name (UserName).
        // This element is only active if enabled for the account.
        'canEditRecipientName' => 'boolean',

        //
        // In Person Signers Recipient Type
        //

        // Specifies the email for the signing host. This can be a maximum of 100 characters.
        // Required element for In Person Signers recipient Type.
        'hostEmail' => 'string',
        // Specifies the name of the signing host. This can be a maximum of 100 characters.
        // Required element for In Person Signers recipient Type.
        'hostName' => 'string',
        // Optional element only used with recipient types In Person Signers
        // and Signers. The full legal name of a signer for an InPersonSigner
        // recipient Type. This can be a maximum of 100 characters.
        'signerName' => 'SignerName',

        //
        // Signers Recipient Type
        //

        // Sets the type of signer certificate required for signing. If left
        // blank, no certificate is required. Only one type of certificate
        // can be set for a signer. The possible values are:
        //  - docusign_express: Requires a DocuSign Express certificate.
        //  - docusign_personal: Requires a DocuSign Personal certificate.
        //                       Note: This option currently is not active.
        //  - safe: Requires a SAFE-BioPharma certificate.
        'requireSignerCertificate' => 'string',
        // Optional element only used with recipient types In Person Signers
        // and Signers. Specifies if the auto navigation setting is on or off
        // for recipient.
        'autoNavigation' => 'boolean',
        // If true, this is the default recipient for the envelope. This option
        // is used with the CreateEnvelopeFromTemplatesAnd Forms method.
        'defaultRecipient' => 'boolean',
        // If set to true and the feature is enabled in the sender’s account,
        // then the signing recipient is required to draw signatures and
        // initials at each signature/initial tab (instead of adopting a
        // signature/initial style or only drawing a signature/initial once).
        'signInEachLocation' => 'boolean',
        // Optional element only used with recipient types In Person Signers
        // and Signers. Allows the sender to pre-specify the signature name,
        // signature initials and signature font used in the signature stamp
        // for the recipient.
        'signatureInfo' => 'SignatureInfo',
        // Optional element only used with recipient types In Person Signers
        // and Signers. Specifies the Tabs associated with the recipient.
        // See the Tab Parameters section for more information about tabs.
        'tabs' => [], // Tab
        // Sets if the signer is an offline signer.
        // The only accepted value is: offline.
        // Note: This is required if the signer is an offline signer.
        'deliveryMethod' => 'string',
        // Optional item if the signer is an offline signer. If this is not
        // included, DocuSign will set it to the signedDateTime value.
        // The date/time setting that specifies when the envelope was
        // delivered to the recipient. The 'sent' date for the recipient
        // is set to the same value. Dates are formatted using ISO 8601 format.
        // It is recommended that you include a time value. If no time value
        // is included, the time will default to Pacific Time.
        'deliveredDateTime' => 'DateTime',
        // The date/time setting that specifies when the recipient signed
        // the envelope. Dates are formatted using ISO 8601 format. It is
        // recommended that you include a time value. If no time value is
        // included, the time will default to Pacific Time.
        // Note: This is required if the signer is an offline signer.
        'signedDateTime' => 'DateTime',
        // Optional structure that contains attributes about the device used
        // and location for an offline signer. You can include none, some or all
        // of the attributes. This information is added to the Offline
        // Signing section of the Certificate of Completion.
        // The possible attributes are:
        'offlineAttributes' => [
            // Information about the type of device used for offline signing.
            'deviceName' => 'string',
            // Information about the model of the device used for offline signing.
            'deviceModel' => 'string',
            // Latitude of the device location at the time of signing.
            'gpsLatitude' => 'string',
            // Longitude of the device location at the time of signing.
            'gpsLongitude' => 'string',
            // GUID of the account. This can be retrieved with the
            // Get Consumer Disclosure call.
            'accountEsignId' => 'string',
        ],
    ];
}