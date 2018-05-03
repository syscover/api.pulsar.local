<?php namespace App\Http\Controllers;

use Syscover\Admin\Models\FieldGroup;
use Syscover\Cms\Models\Article;
use Syscover\Cms\Models\Category;
use Syscover\Ups\Entities\Service;
use Syscover\Ups\Facades\Rate;
use Syscover\Ups\Facades\Tracking;

/**
 * Class WebFrontendController
 * @package App\Http\Controllers
 */

class WebFrontendController extends Controller
{
    public function home()
    {
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