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
        $response = [];

        // Option 1 - get products by categories
        /*$response['products'] = Product::productsByCategories([
                config('web.productsListCategories.tarjetas'),
                config('web.productsListCategories.escapadas'),
                config('web.productsListCategories.experiencias')
            ])
            ->where('lang_id_112', user_lang())
            ->where('active_111', true)
            ->orderBy('sorting_111', 'asc')
            ->get();*/

        // Option 2 - get products

        // Get all active products
        $response['products'] = Product::builder()
            ->where('lang_id', user_lang())
            ->where('product.active', true)
            ->orderBy('product.sort', 'asc')
            ->get();



        // Get all categories from products
//        $productsCategories = ProductsCategories::builder(user_lang())
//            ->whereIn('product_id', $response['products']->pluck('id'))
//            ->get();





        // get product class from all products to calculate taxes

        /*
        $productClasses = collect();
        foreach ($response['products'] as $product)
        {
            if($product->product_class_tax_id_111 != null && ! $productClasses->contains($product->product_class_tax_id_111))
                $productClasses->push($product->product_class_tax_id_111);
        }
        */

        // get tax rules from all kind of product to calculate your tax
        // like this, with only one query, get data to calculate tax from all products
        /*
        $taxRules = TaxRule::builder()
            ->where('country_id_103', config('market.taxCountry')) // this parameter is instanced in middleware TaxRule
            ->where('customer_class_tax_id_106', config('market.taxCustomerClass')) // this parameter is instanced in middleware TaxRule
            ->whereIn('product_class_tax_id_107', $productClasses->toArray())
            ->orderBy('priority_104', 'asc')
            ->get();
        */

        // We add properties to products, including each category at your product
        /*
        $response['products']->transform(function ($product, $key) use ($productsCategories, $taxRules) {
            // add category to create slug
            $product->mappedCategory = $productsCategories->where('product_id_113', $product->id_111)->first();
            // add tax rules for this product
            $product->taxRules = $taxRules->where('product_class_tax_id_107', $product->product_class_tax_id_111);
            return $product;
        });
        */

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