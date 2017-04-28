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
            ->where('lang_id', user_lang())
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
}