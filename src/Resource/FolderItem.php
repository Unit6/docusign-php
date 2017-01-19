<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign\Resource;

use Unit6\DocuSign;
use Unit6\DocuSign\Model;
use Unit6\DocuSign\Service;

/**
 * DocuSign Folder Item Resource Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class FolderItem extends DocuSign\Resource
{
    public function __construct(array $response = array())
    {
        parent::__construct($response);

        $this->prepareRecipients();
    }

    public function prepareRecipients()
    {
        foreach ($this->data['recipients'] as $type => &$rows) {
            if (empty($rows) || ! is_array($rows)) {
                continue;
            }

            foreach ($rows as $i => &$row) {
                $recipient = new Recipient($row);

                $recipient->setType($type);

                $row = $recipient;
            }
        }
    }

    public function getEnvelope()
    {
        return $this->get($this->getEnvelopeUri());
    }

    // avoid conflict with $this->data['recipients'];
    public function _getRecipients()
    {
        return $this->get($this->getRecipientsUri());
    }
}