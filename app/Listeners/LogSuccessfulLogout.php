<?php namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Syscover\Market\Services\TaxRuleService;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        // get default tax rules
        $taxRules = TaxRuleService::getCustomerTaxRules();

        // calculate prices in shopping cart with default values
        TaxRuleService::taxCalculateOverShoppingCart($taxRules);

        // reset tax_rules session variable
        session(['pulsar-market.tax_rules' => $taxRules]);
    }
}