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
 * DocuSign Plan Feature Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class PlanFeature extends DocuSign\Model
{
    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }

    /**
     * Add an alternative currency-specific price.
     */
    public function addCurencyPrice(array $price)
    {
        $list = $this->getCurrencyFeatureSetPrices();

        if (empty($list) || ! is_array($list)) {
            $list = [];
        }

        $this->filterData($price, [
            'currencyCode',
            'currencySymbol',
            'envelopeFee',
            'fixedFee',
            'seatFee'
        ]);

        $list[] = $price;

        $this->setCurrencyFeatureSetPrices($list);
    }

    public function setActive($state)
    {
        $this->setIsActive($state ? 'true' : 'false');
    }

    public function setEnabled($state)
    {
        $this->setIsEnabled($state ? 'true' : 'false');
    }
}