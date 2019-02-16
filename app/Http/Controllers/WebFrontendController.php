<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Syscover\Ups\Entities\Service;
use Syscover\Ups\Facades\Rate;

class WebFrontendController extends Controller
{
    public function home()
    {
        // First we will see if we have a cache configuration file. If we do, we'll load
        // the configuration items from that file so that it is very quick. Otherwise
        // we will need to spin through every configuration file and load them all.



        $exitCode = Artisan::call('migrate');

        dd($exitCode);

        if (env('APP_ENV') === 'production') {
            $path = 'vendor/syscover/pulsar-core/src/version.php';
        }
        else {
            $path = 'workbench/syscover/pulsar-core/src/version.php';
        }

        if (file_exists(base_path($path))) {
            $version = require base_path($path);
            dd($version);
        }

        return view('web.content.home');
    }

    public function forms()
    {
        return view('web.content.forms');
    }

    public function ups()
    {

        $espana = 'ES';
        $espanaZip = '28055';

        $islandia = 'IS';
        $islandiaZip = '104';

        $argentina = 'AR';
        $argentinaZip = '1640';

        $brasil = 'BR';
        $brasilZip = '28650-000';

        $chile = 'CL';
        $chileZip = '7591538';

        $colombia = 'CO';
        $colombiaZip = '110231';

        $nuevaZelanda = 'NZ';
        $nuevaZelandaZip = '0620';

        $australia = 'AU';
        $australiaZip = '3008';

        $japon = 'JP';
        $japonZip = '100-0401';


//        $response = RateService::getRate(
//            'ES',
//            '28020',
//            'US',
//            '10010',
//            '0.5'
//        );

        return Rate::addUpsSecurity()
            ->addRequest()
            ->addShipper(
                'ES',
                '28020'
            )
            ->addShipFrom(
                'ES',
                '28020'
            )
            ->addShipTo(
                $espana,
                $espanaZip
            )
            ->addService(
               Service::S_STANDARD
            )
            ->addPackage()
            ->addPackageWeight(
                '0.5'
            )
            ->addShipmentRatingOptions()
            ->send();
    }
}
