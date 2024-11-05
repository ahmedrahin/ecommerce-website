<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\DataTables\CategoriesDataTable;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoriesDataTable $dataTable)
    {
        return $dataTable->render('pages.apps.category.list');
    }
    
    /**
     * Get the list of categories for the API.
     */
    public function getCategory()
    {
        try {
            $categories = Category::select('id','name','slug','image')->get();
            // Check if categories exist
            if ($categories->isEmpty()) {
                return response()->json([
                    'message' => 'No categories found.',
                ], Response::HTTP_NOT_FOUND);
            }

            // Return success response with Category data
            return response()->json([
                'success' => 'categories retrieved successfully.',
                'data' => $categories,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve categories.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
