<?php namespace App\Http\Controllers;


use Syscover\Admin\Models\Country;
use Syscover\Admin\Models\User;
use Syscover\Admin\Services\CronService;
use Syscover\Core\Services\SchemaService;
use Techedge\InnovaConcrete\Models\Monument;

class PlaygroundController extends Controller
{
    public function index()
    {
        CronService::checkReports(2);
    }
}
