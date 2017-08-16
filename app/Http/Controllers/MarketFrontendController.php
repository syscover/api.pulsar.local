<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Syscover\ShoppingCart\Facades\CartProvider;
use Syscover\Admin\Models\Country;
use Syscover\Admin\Models\TerritorialArea1;
use Syscover\Admin\Models\TerritorialArea2;
use Syscover\Admin\Models\TerritorialArea3;
use Syscover\Market\Models\Product;

/**
 * Class MarketFrontendController
 * @package App\Http\Controllers
 */

class MarketFrontendController extends Controller
{
    /**
     * Function to show product list
     */
    public function getProducts()
    {
        // Get all active products
        $response['products'] = Product::builder()
            ->where('market_product_lang.lang_id', user_lang())
            ->where('market_product.active', true)
            ->where('market_product.parent_id', null) // discard children products
            ->orderBy('market_product.sort', 'asc')
            ->get()
            ->load('categories'); // lazy load categories
        
        return view('web.content.product_list', $response);
    }

    /**
     * function to show singular product
     *
     * @param   Request     $request
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProduct(Request $request)
    {
        // get parameters from url route
        $parameters = $request->route()->parameters();

        $response = [];

        $response['product'] = Product::builder()
            ->where('market_product_lang.lang_id', user_lang())
            ->where('market_product_lang.slug', $parameters['slug'])
            ->where('market_product.active', true)
            ->first();

        // check that product exist
        if($response['product'] == null)
            return view('errors.common', ['message' => 'Error! Product not exist']);

        $response['product']->load('categories'); // lazy load categories;


        // get atachments to product
        /*response['attachments'] = Attachment::builder()
            ->where('lang_id', user_lang())
            ->where('resource_id', 'market-product')
            ->where('object_id', $response['product']->id)
            ->where('family_id', config('www.attachmentsFamily.productSheet'))
            ->orderBy('sorting', 'asc')
            ->get();*/

        return view('web.content.product', $response);
    }

    // Set shipping data
    public function getCheckout01(Request $request)
    {
        // check if cart has shipping
        if(CartProvider::instance()->hasItemTransportable() === true)
        {
            $response['cartItems']  = CartProvider::instance()->getCartItems();
            $response['customer']   = auth('crm')->user();

            // todo, this amount has to be calculate with shipping rules
            $shippungPricePerUnit = 5.00;

            CartProvider::instance()->shippingAmount = CartProvider::instance()->transportableWeight * $shippungPricePerUnit;

            return view('web.content.checkout_01', $response);
        }
        else
        {
            return redirect()->route('getCheckout02-' . user_lang());
        }
    }

    public function postCheckout01(Request $request)
    {
        $response['cartItems']  = CartProvider::instance()->getCartItems();
        $response['customer']   = auth('crm')->user();

        // store shipping data on shopping cart
        CartProvider::instance()->setShippingData([
            'name'                  => $request->input('name'),
            'surname'               => $request->input('surname'),
            'country_id'            => $request->input('country_id'),
            'territorial_area_1_id' => $request->input('territorial_area_1_id'),
            'territorial_area_2_id' => $request->input('territorial_area_2_id'),
            'territorial_area_3_id' => $request->input('territorial_area_3_id'),
            'cp'                    => $request->input('cp'),
            'address'               => $request->input('address'),
            'comments'              => $request->input('comments'),
        ]);

        return redirect()->route('getCheckout02-' . user_lang());
    }

    /**
     * To set billing data
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCheckout02()
    {
        $response['cartItems']          = CartProvider::instance()->getCartItems();
        $response['customer']           = auth('crm')->user();
        $response['shippingData']       = CartProvider::instance()->getShippingData();

        $response['shippingCountry']    = Country::builder()
            ->where('lang_id', user_lang())
            ->where('id', $response['shippingData']['country_id'])
            ->first();

        if($response['shippingData']['territorial_area_1_id'] != null)
            $response['shippingTA1']    = TerritorialArea1::builder()->find($response['shippingData']['territorial_area_1_id']);
        if($response['shippingData']['territorial_area_2_id'] != null)
            $response['shippingTA2']    = TerritorialArea2::builder()->find($response['shippingData']['territorial_area_2_id']);
        if($response['shippingData']['territorial_area_3_id'] != null)
            $response['shippingTA3']    = TerritorialArea3::builder()->find($response['shippingData']['territorial_area_3_id']);

        return view('web.content.checkout_02', $response);
    }
}