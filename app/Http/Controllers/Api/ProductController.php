<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Services\ProductFilterService;
use App\Services\ProductDetailService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    protected $productFilterService;
    protected $productDetailService;

    // Inject the service class via the constructor
    public function __construct(ProductFilterService $productFilterService, ProductDetailService $productDetailService)
    {
        $this->productFilterService = $productFilterService;
        $this->productDetailService = $productDetailService;
    }

    // Use the service in your controller method
    public function index(Request $request)
    {
        try {
            $query = $request->get('query', '');
            $products = $this->productFilterService->filterProductsByQuery($query);

            return response()->json([
                'success' => 'Products retrieved successfully.',
                'data' => $products,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve products.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Use the service in your controller method
    public function getProductById($slug)
    {
        try {
            // Fetch product details using the productDetailService
            $productDetails = $this->productDetailService->getProductDetailsBySlug($slug);
            // Return product details in the response
            return response()->json([
                'success' => 'Product details retrieved successfully.',
                'data' => $productDetails,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'message' => 'Failed to retrieve product details.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}