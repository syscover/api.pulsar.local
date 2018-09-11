<?php namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Syscover\Market\Services\TaxRuleService;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        if(auth('crm')->check())
        {
            // save tax rules in customer instance
            auth('crm')->user()->tax_rules = TaxRuleService::getCustomerTaxRules(
                    auth('crm')->user()->class_taxes->count() > 0 ? auth('crm')->user()->class_taxes->first()->id : null,
                    auth('crm')->user()->country_id,
                    auth('crm')->user()->territorial_area_1_id,
                    auth('crm')->user()->territorial_area_2_id,
                    auth('crm')->user()->territorial_area_3_id,
                    auth('crm')->user()->zip
                );

            // calculate prices in shopping cart
            TaxRuleService::taxCalculateOverShoppingCart(auth('crm')->user()->tax_rules);

            // set tax_rules session variable, to calculate prices
            TaxRuleService::setTaxRules(auth('crm')->user()->tax_rules);
        }
    }
}