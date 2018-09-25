<?php namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Syscover\Market\Services\TaxRuleService;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        // calculate tax rules for customer logged
        TaxRuleService::checkCustomerTaxRules(
            $event->user->class_tax->id ?? null,
            $event->user->country_id,
            $event->user->territorial_area_1_id,
            $event->user->territorial_area_2_id,
            $event->user->territorial_area_3_id,
            $event->user->zip,
            $event->guard
        );
    }
}