<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Syscover\Market\Models\PaymentMethod;
use Syscover\Market\Services\OrderRowService;
use Syscover\Market\Services\OrderService;
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
            ->load('categories', 'attachments'); // lazy load categories and attachments
        
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

        // get customer from session
        $customer = auth('crm')->user();
        $invoice  = CartProvider::instance()->getInvoice();
        $shipping = CartProvider::instance()->getShipping();


        // build order
        $order = [
            'date'                                          => $request->input('date'),                                                                     // if date not exist create current date automatically
            'payment_method_id'                             => $request->input('payment_method_id'),
            'status_id'                                     => $request->input('status_id'),
            'ip'                                            => $request->ip(),
            'data'                                          => $request->input('data'),
            'comments'                                      => $request->input('comments'),

            //****************
            //* amounts
            //****************
            'discount_amount'                               => CartProvider::instance()->discountAmount,                                                        // total amount to discount, fixed plus percentage discounts
            'subtotal_with_discounts'                       => CartProvider::instance()->subtotalWithDiscounts,                                                 // subtotal with discounts applied
            'tax_amount'                                    => CartProvider::instance()->taxAmount,                                                             // total tax amount
            'cart_items_total_without_discounts'            => CartProvider::instance()->cartItemsTotalWithoutDiscounts,                                        // total of cart items. Amount with tax, without discount and without shipping
            'subtotal'                                      => CartProvider::instance()->subtotal,                                                              // amount without tax and without shipping
            'shipping_amount'                               => CartProvider::instance()->hasFreeShipping()? 0 :  CartProvider::instance()->shippingAmount,      // shipping amount
            'total'                                         => CartProvider::instance()->total,

            //****************
            //* gift
            //****************
            'has_gift'                                      => $request->has('has_gift'),
            'gift_from'                                     => $request->input('gift_from'),
            'gift_to'                                       => $request->input('gift_to'),
            'gift_message'                                  => $request->input('gift_message'),

            //****************
            //* customer
            //****************
            'customer_id'                                   => $customer->id,
            'customer_group_id'                             => $customer->group_id,
            'customer_company'                              => $customer->company,
            'customer_tin'                                  => $customer->tin,
            'customer_name'                                 => $customer->name,
            'customer_surname'                              => $customer->surname,
            'customer_email'                                => $customer->email,
            'customer_mobile'                               => $customer->mobile,
            'customer_phone'                                => $customer->phone,

            //****************
            //* invoice data
            //****************
            'has_invoice'                                   => $invoice->get('has_invoice'),
            'invoiced'                                      => $invoice->get('invoiced'),
            'invoice_number'                                => $invoice->get('number'),
            'invoice_company'                               => $invoice->get('company'),
            'invoice_tin'                                   => $invoice->get('tin'),
            'invoice_name'                                  => $invoice->get('name'),
            'invoice_surname'                               => $invoice->get('surname'),
            'invoice_email'                                 => $invoice->get('email'),
            'invoice_mobile'                                => $invoice->get('mobile'),
            'invoice_phone'                                 => $invoice->get('phone'),
            'invoice_country_id'                            => $invoice->get('country_id'),
            'invoice_territorial_area_1_id'                 => $invoice->get('territorial_area_1_id'),
            'invoice_territorial_area_2_id'                 => $invoice->get('territorial_area_2_id'),
            'invoice_territorial_area_3_id'                 => $invoice->get('territorial_area_3_id'),
            'invoice_cp'                                    => $invoice->get('cp'),
            'invoice_locality'                              => $invoice->get('locality'),
            'invoice_address'                               => $invoice->get('address'),
            'invoice_latitude'                              => $invoice->get('latitude'),
            'invoice_longitude'                             => $invoice->get('longitude'),
            'invoice_comments'                              => $invoice->get('comments'),

            //****************
            //* shipping data
            //****************
            'has_shipping'                                  => $shipping->get('has_shipping'),
            'shipping_company'                              => $shipping->get('company'),
            'shipping_name'                                 => $shipping->get('name'),
            'shipping_surname'                              => $shipping->get('surname'),
            'shipping_email'                                => $shipping->get('email'),
            'shipping_mobile'                               => $shipping->get('mobile'),
            'shipping_phone'                                => $shipping->get('phone'),
            'shipping_country_id'                           => $shipping->get('country_id'),
            'shipping_territorial_area_1_id'                => $shipping->get('territorial_area_1_id'),
            'shipping_territorial_area_2_id'                => $shipping->get('territorial_area_2_id'),
            'shipping_territorial_area_3_id'                => $shipping->get('territorial_area_3_id'),
            'shipping_cp'                                   => $shipping->get('cp'),
            'shipping_locality'                             => $shipping->get('locality'),
            'shipping_address'                              => $shipping->get('address'),
            'shipping_latitude'                             => $shipping->get('latitude'),
            'shipping_longitude'                            => $shipping->get('longitude'),
            'shipping_comments'                             => $shipping->get('comments'),
        ];

        dd($order);

        //$order = OrderService::create($order);


        //$orderRows = OrderRowService::create($order->id, CartProvider::instance());

        // TODO, set cart price rules

        // destroy shopping cart
        //CartProvider::instance()->destroy();

        //dd($orderRows);
    }
}