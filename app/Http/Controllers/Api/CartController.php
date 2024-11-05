<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class CartController extends Controller
{
    private function getCart()
    {
        return session()->get('cart', []);
    }

    private function saveCart($cart)
    {
        session()->put('cart', $cart);
    }

    public function addToCart(Request $request)
    {
        try {
            $product = Product::findOrFail($request->input('id'));
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Product not found',
                'message' => 'The product with the specified ID does not exist.'
            ], 404);
        }

        $cart = $this->getCart();

        // Generate a unique key for the product based on its ID, color, and size
        $key = $product->id . '-' . $request->input('color') . '-' . $request->input('size');

        // Check if the product with the same color and size already exists in the cart
        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->input('quantity');
        } else {
            $cart[$key] = [
                'id' => $product->id,
                'name' => $product->name,
                'color' => $request->input('color'),
                'size' => $request->input('size'),
                'quantity' => $request->input('quantity'),
                'unit_price' => $product->base_price,
                'discount_type' => getDiscountType($product->discount_option),
                'discount_percentage_or_flat_amount' => $product->discount_percentage_or_flat_amount,
                'discount_amount' => $product->discount_amount,
                'unit_discounted_price' => $product->offer_price,
            ];
        }

        // Save the updated cart back to the session
        $this->saveCart($cart);

        // Fetch all products in the cart
        $productIds = array_column($cart, 'id');
        $products = Product::whereIn('id', $productIds)->get();

        $groupedProducts = [];
        foreach ($cart as $key => $cartItem) {
            $product = $products->firstWhere('id', $cartItem['id']);
            $galleryImages = $product->galleryImages->pluck('image')->toArray();
            if ($product) {
                $groupedProducts[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'product_sku_code'=>$key,
                    'sku' => $product->sku_code,
                    'color' => $request->input('color'),
                    'size' => $request->input('size'),
                    'min_quantity' => 0,
                    'max_quantity' => 0,
                    'quantity' => $cartItem['quantity'],
                    'available_quantity' => $product->quantity,
                    'unit_price' => $product->base_price,
                    'discount_type' => getDiscountType($product->discount_option),
                    'discount_percentage_or_flat_amount' => $product->discount_percentage_or_flat_amount,
                    'discount_amount' => $product->discount_amount,
                    'unit_discounted_price' => $product->offer_price,
                    'delivery_charge' => 0,
                    'slug' => $product->slug,
                    'thumb_image' => $product->thumb_image,
                    'back_image' => $product->back_image,
                    'image' => $galleryImages,
                ];
            }
        }

        $response = [
            'session_id' => session()->getId(),
            'user_id' => Auth::id() ?: null,
            'shops' => ['products' => $groupedProducts],
            'item_count' => count($cart),
        ];

        return response()->json($response);
    }
}