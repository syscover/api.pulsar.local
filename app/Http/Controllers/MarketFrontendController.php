<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Syscover\Market\Models\PaymentMethod;
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
        // store shipping data on shopping cart
        CartProvider::instance()->setShippingData([
            'name'                  => $request->input('name'),
            'surname'               => $request->input('surname'),
            'country'               => $request->has('country_id')? Country::where('id', $request->input('country_id'))->where('lang_id', user_lang())->first() : null,
            'territorial_area_1'    => $request->has('territorial_area_1_id')? TerritorialArea1::where('id', $request->input('territorial_area_1_id'))->first() : null,
            'territorial_area_2'    => $request->has('territorial_area_2_id')? TerritorialArea2::where('id', $request->input('territorial_area_2_id'))->first() : null,
            'territorial_area_3'    => $request->has('territorial_area_3_id')? TerritorialArea3::where('id', $request->input('territorial_area_3_id'))->first() : null,
            'cp'                    => $request->input('cp'),
            'address'               => $request->input('address'),
            'comments'              => $request->input('comments'),
        ]);

        return redirect()->route('getCheckout02-' . user_lang());
    }

    // Set billing data
    public function getCheckout02()
    {
        $response['cartItems']          = CartProvider::instance()->getCartItems();
        $response['customer']           = auth('crm')->user();
        $response['shippingData']       = CartProvider::instance()->getShippingData();

        return view('web.content.checkout_02', $response);
    }

    public function postCheckout02(Request $request)
    {
        CartProvider::instance()->setInvoice([
            'company'               => $request->input('company'),
            'tin'                   => $request->input('tin'),
            'name'                  => $request->input('name'),
            'surname'               => $request->input('surname'),
            'country'               => $request->has('country_id')? Country::where('id', $request->input('country_id'))->where('lang_id', user_lang())->first() : null,
            'territorial_area_1'    => $request->has('territorial_area_1_id')? TerritorialArea1::where('id', $request->input('territorial_area_1_id'))->first() : null,
            'territorial_area_2'    => $request->has('territorial_area_2_id')? TerritorialArea2::where('id', $request->input('territorial_area_2_id'))->first() : null,
            'territorial_area_3'    => $request->has('territorial_area_3_id')? TerritorialArea3::where('id', $request->input('territorial_area_3_id'))->first() : null,
            'cp'                    => $request->input('cp'),
            'address'               => $request->input('address'),
        ]);

        return redirect()->route('getCheckout03-' . user_lang());
    }

    /**
     * To set payment method
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCheckout03()
    {
        $response['cartItems']          = CartProvider::instance()->getCartItems();
        $response['customer']           = auth('crm')->user();
        $response['shippingData']       = CartProvider::instance()->getShippingData();
        $response['invoice']            = CartProvider::instance()->getInvoice();

        $response['paymentMethods']     = PaymentMethod::builder()
            ->where('lang_id', user_lang())
            ->where('active', true)
            ->orderBy('sort', 'asc')
            ->get();

        return view('web.content.checkout_03', $response);
    }
}