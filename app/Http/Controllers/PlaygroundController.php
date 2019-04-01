<?php namespace App\Http\Controllers;


use Syscover\Admin\Models\Country;
use Syscover\Admin\Models\User;
use Syscover\Core\Services\SchemaService;
use Techedge\InnovaConcrete\Models\Monument;

class PlaygroundController extends Controller
{
    public function index()
    {

       $user = Monument::where('peoples', 1)->get();

        //dd($user);




        $object = Country::find(1);
        dd($object->only('id', 'sort', 'prefix', 'zones'));

        Country::where('id', 'ES')
            ->update($object->only('id', 'sort', 'prefix', 'zones'));

        // dd(SchemaService::hasIndex('admin_lang', 'ix01_admin_lang'));

        // dd(now()->toDateTimeString());
        // First we will see if we have a cache configuration file. If we do, we'll load
        // the configuration items from that file so that it is very quick. Otherwise
        // we will need to spin through every configuration file and load them all.



        // $exitCode = Artisan::call('migrate');




//        if (env('APP_ENV') === 'production') {
//            $path = 'vendor/syscover/pulsar-admin/src/version.php';
//        }
//        else {
//            $path = 'workbench/syscover/pulsar-admin/src/version.php';
//        }
//
//        if (file_exists(base_path($path))) {
//            $version = require base_path($path);
//        }

        dd('ok');
    }
}
