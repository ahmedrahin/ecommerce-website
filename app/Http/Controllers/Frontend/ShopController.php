<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{   
    // show product in shop page
    public function allProducts(){
        return view('frontend.pages.product.shop');
    }

    // product details page
    public function productDetails(string $slug){
        if( $slug ){
            $product = Product::where('slug', $slug)->first();
        }
        return view('frontend.pages.product.details', compact('product'));
    }

}
