<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\DataTables\BrandsDataTable;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator; // Add this line

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BrandsDataTable $dataTable)
    {
        return $dataTable->render('pages.apps.brand.list');
    }
    
    /**
     * Get the list of brands for the API.
     */
    public function getBrand()
    {
        try {
            $brands = Brand::select('id','name','slug','image')->get();
            // Check if brands exist
            if ($brands->isEmpty()) {
                return response()->json([
                    'message' => 'No brands found.',
                ], Response::HTTP_NOT_FOUND);
            }

            // Return success response with brand data
            return response()->json([
                'success' => 'Brands retrieved successfully.',
                'data' => $brands,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve brands.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
