<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Syscover\Market\Models\Order;
use Syscover\Market\Models\PaymentMethod;
use Syscover\Market\Services\OrderRowService;
use Syscover\Market\Services\OrderService;
use Syscover\Market\Services\PaymentMethodService;
use Syscover\Market\Services\PayPalPaymentService;
use Syscover\Market\Services\RedsysService;
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
    public function products()
    {
        // Get all active products
        $response['products'] = Product::builder()
            ->where('market_product_lang.lang_id', user_lang())
            ->where('market_product.active', true)
            ->where('market_product.parent_id', null) // discard children products
            ->orderBy('market_product.sort', 'asc')
            ->get()
            ->load('categories', 'attachments'); // lazy load categories and attachments
        
        return view('web.content.products', $response);
    }

    /**
     * function to show product
     */
    public function product(Request $request)
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
        if($response['product'] == null) abort(404);

        $response['product']->load('categories'); // lazy load categories;

        return view('web.content.product', $response);
    }

    public function order(Request $request)
    {
        // get parameters from url route
        $parameters = $request->route()->parameters();

        $response = [];

        $response['order'] = Order::builder()->find($parameters['id']);

        // check that product exist
        if($response['order'] == null)
            return view('errors.common', ['message' => 'Error! Product not exist']);

        return view('web.content.order', $response);
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
        CartProvider::instance()->setShipping([
            'has_shipping'          => $request->has('has_shipping'),
            'name'                  => $request->input('name'),
            'surname'               => $request->input('surname'),
            'country_id'            => $request->input('country_id'),
            'country'               => $request->has('country_id')? Country::where('id', $request->input('country_id'))->where('lang_id', user_lang())->first() : null,
            'territorial_area_1_id' => $request->input('territorial_area_1_id'),
            'territorial_area_1'    => $request->has('territorial_area_1_id')? TerritorialArea1::where('id', $request->input('territorial_area_1_id'))->first() : null,
            'territorial_area_2_id' => $request->input('territorial_area_2_id'),
            'territorial_area_2'    => $request->has('territorial_area_2_id')? TerritorialArea2::where('id', $request->input('territorial_area_2_id'))->first() : null,
            'territorial_area_3_id' => $request->input('territorial_area_3_id'),
            'territorial_area_3'    => $request->has('territorial_area_3_id')? TerritorialArea3::where('id', $request->input('territorial_area_3_id'))->first() : null,
            'cp'                    => $request->input('cp'),
            'locality'              => $request->input('locality'),
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
        $response['shipping']           = CartProvider::instance()->getShipping();

        return view('web.content.checkout_02', $response);
    }

    public function postCheckout02(Request $request)
    {
        CartProvider::instance()->setInvoice([
            'has_invoice'           => $request->has('has_invoice'),
            'company'               => $request->input('company'),
            'tin'                   => $request->input('tin'),
            'name'                  => $request->input('name'),
            'surname'               => $request->input('surname'),
            'country_id'            => $request->input('country_id'),
            'country'               => $request->has('country_id')? Country::where('id', $request->input('country_id'))->where('lang_id', user_lang())->first() : null,
            'territorial_area_1_id' => $request->input('territorial_area_1_id'),
            'territorial_area_1'    => $request->has('territorial_area_1_id')? TerritorialArea1::where('id', $request->input('territorial_area_1_id'))->first() : null,
            'territorial_area_2_id' => $request->input('territorial_area_2_id'),
            'territorial_area_2'    => $request->has('territorial_area_2_id')? TerritorialArea2::where('id', $request->input('territorial_area_2_id'))->first() : null,
            'territorial_area_3_id' => $request->input('territorial_area_3_id'),
            'territorial_area_3'    => $request->has('territorial_area_3_id')? TerritorialArea3::where('id', $request->input('territorial_area_3_id'))->first() : null,
            'cp'                    => $request->input('cp'),
            'locality'              => $request->input('locality'),
            'address'               => $request->input('address'),
            'comments'              => $request->input('comments'),
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
        $response['shipping']           = CartProvider::instance()->getShipping();
        $response['invoice']            = CartProvider::instance()->getInvoice();

        $response['paymentMethods']     = PaymentMethod::builder()
            ->where('lang_id', user_lang())
            ->where('active', true)
            ->orderBy('sort', 'asc')
            ->get();

        return view('web.content.checkout_03', $response);
    }

    public function postCheckout03(Request $request)
    {
        // check that there are items in shopping cart
        if(CartProvider::instance()->getCartItems()->count() == 0)
        {
            return redirect()
                ->route('getCheckout03-' . user_lang())
                ->withErrors(['Error, shopping cart is empty']);

        }

        // check if there isn't a customer loged
        if(auth('crm')->guest())
        {
            return redirect()
                ->route('getCheckout03-' . user_lang())
                ->withErrors(['Error, there isn\'t any customer loged']);

        }

        //********************************
        //* get data for create order
        //********************************
        $data       = $request->all();
        $customer   = auth('crm')->user();
        $cart       = CartProvider::instance();
        $invoice    = CartProvider::instance()->getInvoice();
        $shipping   = CartProvider::instance()->getShipping();
        $items      = CartProvider::instance()->getCartItems();

        // order
        $order      = OrderService::orderBuilder($data, $customer, $cart, $shipping, $invoice, $request->ip());
        $order      = OrderService::create($order);

        // order rows
        $orderRows  = OrderRowService::orderRowBuilder(user_lang(), $order->id, $items);
        OrderRowService::insert($orderRows);

        // destroy shopping cart
        CartProvider::instance()->destroy();

        // launch request to payment method for launch payment
        PaymentMethodService::managePaymentMethod($request, $order);
    }

    public function marketRedsysSuccessful(Request $request)
    {
        $order = RedsysService::successful($request);

        dd('marketRedsysSuccessful');
        dd($order);
        dd($request->all());

        return redirect()
            ->route('home-' . user_lang());
    }

    public function marketRedsysError(Request $request)
    {
        $order = RedsysService::error($request);

        dd('marketRedsysError');
        dd($order);
        dd($request->all());

        return redirect()
            ->route('home-' . user_lang());
    }

    public function marketPayPalSuccessful(Request $request)
    {
        //$order = PayPalPaymentService::successful($request);
        dd('marketPayPalSuccessful');
        dd($order);
        dd($request->all());
    }

    public function marketPayPalError(Request $request)
    {
        $order = PayPalPaymentService::error($request);
        dd('marketPayPalError');
        dd($order);
        dd($request->all());
    }
}