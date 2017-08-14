<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Syscover\Market\Models\Product;
use Syscover\Market\Models\ProductsCategories;

/**
 * Class MarketFrontendController
 * @package App\Http\Controllers
 */

class MarketFrontendController extends Controller
{
    /**
     * Function to show product list
     */
    public function getProductsList()
    {
        // Get all active products
        $response['products'] = Product::builder()
            ->where('market_product_lang.lang_id', user_lang())
            ->where('market_product.active', true)
            ->where('market_product.parent_product_id', null) // discard children products
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

    public function getCheckout01(Request $request)
    {
        dd('getCheckou01');
    }
}