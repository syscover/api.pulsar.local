<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Syscover\Market\Services\CouponService;
use Syscover\Market\Models\CartPriceRule;
use Syscover\Market\Models\Product;
use Syscover\Market\Models\TaxRule;

use Syscover\ShoppingCart\Exceptions\ShoppingCartNotCombinablePriceRuleException;
use Syscover\ShoppingCart\PriceRule;
use Syscover\ShoppingCart\TaxRule as TaxRuleShoppingCart;
use Syscover\ShoppingCart\Facades\CartProvider;
use Syscover\ShoppingCart\Item;

/**
 * Class ShoppingCartController
 * @package App\Http\Controllers
 */

class ShoppingCartController extends Controller
{
    /**
     * Show shopping cart
     */
    public function index()
    {
        // get cart items from shoppingCart
        $response['cartItems'] = CartProvider::instance()->getCartItems();

        return view('web.content.shopping_cart', $response);
    }

    /**
     * Add product to shopping cart
     */
    public function add($slug)
    {
        $product = Product::builder()
            ->where('lang_id', user_lang())
            ->where('slug', $slug)
            ->where('active', true)
            ->first()
            ->load('attachments');

        if($product === null) abort(404);

        //**************************************************************************************
        // Know if product is transportable
        // Options:
        // 1 - downloadable
        // 2 - transportable
        // 3 - transportable_downloadable
        // 4 - service
        //
        // You can change this value, if you have same product transportable and downloadable
        //
        //***************************************
        $isTransportable = $product->type_id == 2 || $product->type_id == 3? true : false;

        // create taxRule with format for shopping cart
//        $taxRulesShoppingCart = [];
//        foreach ($product->tax_rules as $taxRule)
//        {
//            $taxRulesShoppingCart[] = new TaxRuleShoppingCart(
//                Lang::has($taxRule->translation) ? trans($taxRule->translation) : $taxRule->name,
//                $taxRule->tax_rate_zones->sum('tax_rate'),
//                $taxRule->priority,
//                $taxRule->sort
//            );
//        }

        // when get price from product, internally calculate subtotal and total.
        // we don't want save this object on shopping cart, if login user with different prices and add same product,
        // will be different because the product will have different prices
        $cloneProduct = clone $product;

        try
        {
            // instance row to add product
            CartProvider::instance()->add(
                new Item(
                    $product->id,
                    $product->name,
                    1,
                    $product->price,
                    $product->weight,
                    $isTransportable,
                    [
                        'product' => $cloneProduct
                    ]
                )
            );
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
        
        return redirect()->route('web.shopping_cart-' . user_lang());
    }

    /**
     * Update shopping cart quantity and apply coupon code, this method is call from shopping cart view
     */
    public function update(Request $request)
    {
        // check idf exist coupon code
        if($request->has('apply_coupon_code'))
        {
            CouponService::addCoupon(CartProvider::instance(), $request->input('apply_coupon_code'), user_lang(), auth('crm'));
        }

        $cartItems = CartProvider::instance()->getCartItems();

        foreach($cartItems as $item)
        {
            if(is_numeric($request->input($item->rowId)))
            {
                CartProvider::instance()->setQuantity($item->rowId, (int)$request->input($item->rowId));
            }
        }

        return redirect()->route('web.shopping_cart-' . user_lang());
    }

    /**
     * Delete product from shopping cart
     */
    public function delete(Request $request)
    {
        // get parameters from url route
        $parameters = $request->route()->parameters();

        CartProvider::instance()->remove($parameters['rowId']);

        return redirect()->route('web.shopping_cart-' . user_lang());
    }

    /**
     * Check if coupon code is correct
     */
    public function checkCoupon()
    {
        return response()
            ->json(CouponService::checkCoupon(request('coupon_code'), user_lang(), auth('crm')));
    }
}