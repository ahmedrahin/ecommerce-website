<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class ShopController extends Controller
{   
    // show product in shop page
    public function allProducts(){
        return view('frontend.pages.shop.shop');
    }

    // product details page
    public function productDetails(string $slug)
    {
        if ($slug) {
            $product = Product::where('slug', $slug)
                ->with([
                    'category:id,name',
                    'brand:id,name',
                    'galleryImages:id,product_id,image',
                    'tags:id,product_id,name',
                    'productStock:id,product_id',
                    'productStock.attributeOptions:id,product_stock_id,attribute_id,attribute_value_id'
                ])
                ->first();

            // Check if the product exists and is active
            if (!$product || $product->status == 0 || $product->status == 2) {
                // Redirect to the shop page with a message
                return redirect()->route('shop')->with('error', 'The product is unavailable.');
            }
        }

        return view('frontend.pages.product.details', compact('product'));
    }

    // product wishlist
    public function wishlist(){
        return view('frontend.pages.shop.wishlist');
    }

}
