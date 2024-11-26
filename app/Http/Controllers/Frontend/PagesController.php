<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class PagesController extends Controller
{
    public function home()
    {
        $categories = Category::withCount('product') 
            ->where('status', 1) 
            ->orderBy('product_count', 'desc')
            ->take(10) 
            ->get();

  
        $subcategories = Subcategory::withCount('products') 
            ->where('status', 1)
            ->orderBy('products_count', 'desc')
            ->take(10) 
            ->get();

        return view('frontend.pages.home', compact('categories', 'subcategories'));
    }

}
