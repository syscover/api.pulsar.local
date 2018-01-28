<?php namespace App\Http\Controllers;

use Syscover\Ups\Entities\Service;
use Syscover\Ups\Facades\Rate;

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

        $islandia = 'IS';
        $islandiaZip = '104';


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
                $islandia,
                $islandiaZip
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




        return $response;
    }
}