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
 * DocuSign Search Resource Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Search extends DocuSign\Resource
{
    public function __construct(array $response = array())
    {
        parent::__construct($response);

        $this->prepareFolderItems();
    }

    public function prepareFolderItems()
    {
        foreach ($this->data['folderItems'] as $i => &$folderItem) {
            $folderItem = new FolderItem($folderItem);
        }
    }
}