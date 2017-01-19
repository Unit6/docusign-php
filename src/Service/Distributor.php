<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign\Service;

use Unit6\DocuSign;
use Unit6\DocuSign\Model;
use Unit6\DocuSign\Exception;

/**
 * DocuSign Distributor / Reseller Service Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Distributor extends DocuSign\Service
{
    /**
    * Constructs the internal representation of the DocuSign Distributor service.
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create Account (Distributor only)
     *
     * This creates a new account for using the DocuSign service.
     *
     * @param Model\Account $account
     */
    public function createAccount(Model\Account $account)
    {
        # POST /accounts
    }

    /**
     * Get Account Information
     *
     * This returns the account information for the specified account.
     *
     * GET /accounts/{accountId}
     */
    public static function getAccount($accountId)
    {
        return Accounts::getAccount($accountId);
    }

    /**
     * Delete Account (Distributor only)
     *
     * This deletes the specified account.
     */
    public function deleteAccount()
    {
        # DELETE /accounts/{accountId}
    }

    /**
     * Get Account Billing Plan
     *
     * This returns the billing plan information for the specified account.
     *
     * GET /accounts/{accountId}/billing_plan
     */
    public static function getAccountBillingPlan($accountId)
    {
        return Accounts::getAccountBillingPlan($accountId);
    }

    /**
     * Update Account Billing Plan (Distributor only)
     *
     * This updates the billing plan for the specified account.
     *
     * @param Model\BillingPlan $billingPlan
     */
    public function updateAccountBillingPlan(Model\BillingPlan $billingPlan)
    {
        # PUT /accounts/{accountId}/billing_plan
    }

    /**
     * Purchase Additional Envelopes (Distributor only)
     *
     * IMPORTANT: At this time, this operation is limited to DocuSign
     * internal use only.
     *
     * This completes the purchase of envelopes for your account. The actual
     * purchase is done as part of an internal workflow interaction with
     * an envelope vendor.
     */
    public function updateAccountbillingPlanPurchasedEnvelopes(array $purchase = array())
    {
        # PUT /accounts/{accountId}/billing_plan/purchased_envelopes
    }

    /**
     * Get Account Provisioning Information (Distributor only)
     *
     * This returns the account provisioning information.
     *
     * Note: This request requires a DocuSign Integrator Key and the
     * DocuSign AppToken information. The AppToken is used to determine
     * the account provisioning information that is returned and is
     * provided by the group provisioning the account.
     *
     * GET /accounts/provisioning
     */
    public static function getAccountProvisioning($appToken)
    {
        $headers = self::getClientHeaders();
        $headers['X-DocuSign-AppToken'] = $appToken;

        $options = [
            'headers' => $headers
        ];

        return DocuSign\Request::get('accounts/provisioning', $options);
    }

    /**
     * Get List of Billing Plans (Distributor only)
     *
     * This returns the billing plans associated with a distributor.
     *
     * GET /billing_plans
     */
    public static function getBillingPlans()
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        return DocuSign\Request::get('billing_plans', $options);
    }

    /**
     * Get Billing Plan Details (Distributor only)
     *
     * This returns the billing plan details for the specified billing plan ID.
     *
     * GET /billing_plans/{planId}
     *
     * @param string $planId
     */
    public static function getBillingPlanInformation($planId)
    {
        $headers = self::getClientHeaders();

        $options = [
            'headers' => $headers
        ];

        $uri = sprintf('billing_plans/%s', $planId);

        return DocuSign\Request::get($uri, $options);
    }
}