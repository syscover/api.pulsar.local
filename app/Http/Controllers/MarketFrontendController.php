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
            ->where('product_lang.lang_id', user_lang())
            ->where('product.active', true)
            ->orderBy('product.sort', 'asc')
            ->get()
            ->load('categories'); // lazy load categories


        // get atachments to products
        /*
        $response['attachments'] = Attachment::builder()
            ->where('lang_id', user_lang())
            ->where('resource_id', 'market-product')
            ->where('family_id', config('web.attachmentsFamily.productList'))
            ->orderBy('sorting', 'asc')
            ->get()
            ->keyBy('object_id');
        */
        
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
            ->where('product_lang.lang_id', user_lang())
            ->where('product_lang.slug', $parameters['slug'])
            ->where('product.active', true)
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
}