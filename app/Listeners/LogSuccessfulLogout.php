<?php namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Syscover\Market\Services\TaxRuleService;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        if(! auth('crm')->check())
        {
            // get default tax rules
            $taxRules = TaxRuleService::getCustomerTaxRules();

            // calculate prices in shopping cart with default values
            TaxRuleService::taxCalculateOverShoppingCart($taxRules);

            // reset tax_rules session variable
            TaxRuleService::setTaxRules($taxRules);
        }
    }
}