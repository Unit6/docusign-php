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
 * DocuSign Folder Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Folder extends DocuSign\Model
{
    // Note: This can be used to delete envelopes
    // by using “recyclebin” as folderId. Placing
    // an in process envelope (envelope status of
    // sent or delivered) in the recycle bin will
    // void the envelope. This can also be used to
    // delete templates by using the templateId in
    // place of the envelopeId and using "recyclebin"
    // as folderId.
    const TYPE_RECYCLE_BIN = 'recyclebin';

    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }
}