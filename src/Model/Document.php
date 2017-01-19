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
 * DocuSign Document Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Document extends DocuSign\Model
{
    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }

    public function fromFile($path, $id)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        $this->setName(basename($path));
        $this->setDocumentBase64(base64_encode(file_get_contents($path)));
        $this->setFileExtension(pathinfo($path, PATHINFO_EXTENSION));
        $this->setMimeType(finfo_file($finfo, $path));

        $this->setDocumentId($id);
    }
}