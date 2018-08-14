<?php namespace App\Listeners;

use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        // reset tax_rules session variable
        session(['pulsar-market.tax_rules' => null]);
    }
}