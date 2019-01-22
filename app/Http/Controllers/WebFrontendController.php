<?php namespace App\Http\Controllers;

use Syscover\Admin\Models\Country;
use Syscover\Core\Services\SQLService;
use Syscover\Ups\Entities\Service;
use Syscover\Ups\Facades\Rate;
use Syscover\Wine\Models\Wine;

class WebFrontendController extends Controller
{
    public function home()
    {
        dd(Wine::builder()->get()->first()->price);


//        $test = [
//            'filter' => [
//                'type'  => 'and',
//                'sql'   => [
//                    [
//                        'type'  => 'and',
//                        'sql'   => [
//                            [
//                                'column' => 'prefix',
//                                'operator' => '>',
//                                'value' => 40
//
//                            ],
//                            [
//                                'column' => 'prefix',
//                                'operator' => '<',
//                                'value' => 50
//                            ]
//                        ],
//                    ],
//                    [
//                        'type'  => 'or',
//                        'sql'   => [
//                            [
//                                'column' => 'lang_id',
//                                'operator' => '=',
//                                'value' => 'es'
//
//                            ],
//                            [
//                                'raw' => 'CASE `market_product`.`product_class_tax_id` WHEN 1 THEN (`market_product`.`subtotal` * 1.21) > 8 END'
//                            ]
//
//                        ]
//                    ]
//                ]
//            ]
//        ];
//
//        $query = Country::builder();
//        $query  = SQLService::setGroupQueryFilter($query, $test['filter']);
//        dd($query->toSql());

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