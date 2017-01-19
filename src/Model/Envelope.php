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
 * DocuSign Envelope Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Envelope extends DocuSign\Model
{
    // EnvelopeStatusChange
    const STATUS_VOIDED     = 'voided';
    const STATUS_CHANGED    = 'changed';
    const STATUS_CREATED    = 'created'; // saved as a draft can be modified and sent later.
    const STATUS_DELETED    = 'deleted';
    const STATUS_SENT       = 'sent'; // created and sent to recipients.
    const STATUS_DELIVERED  = 'delivered';
    const STATUS_SIGNED     = 'signed';
    const STATUS_COMPLETED  = 'completed';
    const STATUS_DECLINED   = 'declined';
    const STATUS_TIMED_OUT  = 'timedout';
    const STATUS_PROCESSING = 'processing';

    // Authoritative Copy Status of the envelope.
    const AC_UNKNOWN            = 'Unknown';
    const AC_ORIGINAL           = 'Original';
    const AC_TRANSFERRED        = 'Transferred';
    const AC_AUTHORITATIVE_COPY = 'AuthoritativeCopy';
    const AC_AUTHORITATIVE_COPY_EXPORT_PENDING = 'AuthoritativeCopyExportPending';
    const AC_AUTHORITATIVE_COPY_EXPORTED = 'AuthoritativeCopyExported';
    const AC_DEPOSIT_PENDING    = 'DepositPending';
    const AC_DEPOSITED          = 'Deposited';
    const AC_DEPOSITED_EO       = 'DepositedEO';
    const AC_DEPOSITED_FAILED   = 'DepositFailed';

    // search_folder
    const SEARCH_FOLDER_DRAFTS    = 'drafts';
    const SEARCH_FOLDER_AWAITING  = 'awaiting_my_signature';
    const SEARCH_FOLDER_COMPLETED = 'completed';
    const SEARCH_FOLDER_OUT       = 'out_for_signature';

    // order_by
    const ORDER_ACTION_REQUIRED = 'action_required';
    const ORDER_CREATED         = 'created';
    const ORDER_COMPLETED       = 'completed';
    const ORDER_SENT            = 'sent';
    const ORDER_SIGNER_LIST     = 'signer_list';
    const ORDER_STATUS          = 'status';
    const ORDER_SUBJECT         = 'subject';

    // order
    const SORT_ASCENDING  = 'asc';
    const SORT_DESCENDING = 'desc';

    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }

    public function addRecipientTo($type, Recipient $recipient)
    {
        $this->data['recipients'][$type][] = $recipient->getData();
    }

    public function addRecipientAgent(Recipient $recipient)
    {
        $this->addRecipientTo(Recipient::TYPE_AGENTS, $recipient);
    }

    public function addRecipientCertifiedDelivery(Recipient $recipient)
    {
        $this->addRecipientTo(Recipient::TYPE_CERTIFIED_DELIVERIES, $recipient);
    }

    public function addRecipientEditor(Recipient $recipient)
    {
        $this->addRecipientTo(Recipient::TYPE_EDITORS, $recipient);
    }

    public function addRecipientIntermediary(Recipient $recipient)
    {
        $this->addRecipientTo(Recipient::TYPE_INTERMEDIARIES, $recipient);
    }

    public function addRecipientSigner(Recipient $recipient)
    {
        $this->addRecipientTo(Recipient::TYPE_SIGNERS, $recipient);
    }

    public function hasRecipientSigners()
    {
        $recipients = $this->getRecipients();
        $type = Recipient::TYPE_SIGNERS;
        return (count($recipients[$type]));
    }

    public function addDocument(Document $document)
    {
        $this->data['documents'][] = $document->getData();
    }

    public function addDocuments(array $documents = array())
    {
        foreach ($documents as $document) {
            $this->addDocument($document);
        }
    }
}