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
 * DocuSign Plan Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Plan extends DocuSign\Model
{
    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }

    public function addFeature(PlanFeature $feaure)
    {
        $list = $this->getPlanFeatureSets();

        if (empty($list) || ! is_array($list)) {
            $list = [];
        }

        $list[] = $feaure->getData();

        $this->setPlanFeatureSets($list);
    }
}