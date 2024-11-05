<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Category;

class CategoryController extends Controller
{   
    /**
     * Get all categories with their subcategories and subsubcategories.
     */
    public function index()
    {
        try {
            // Retrieve all categories
            $categories = Category::select('id', 'name as title', 'slug', 'image', 'name as alt')->get();
            return response()->json([
                'success' => 'Categories retrieved successfully.',
                'data' => $categories,
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve categories.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get all categories with their subcategories and subsubcategories.
     */
    public function getAllCategoriesWithHierarchy()
    {
        try {
            // Retrieve all categories with their subcategories and subsubcategories, selecting only id, name, and image
            $categories = Category::with([
                'subcategories' => function ($query) {
                    $query->select('id', 'name as title', 'slug', 'category_id');
                },
                'subcategories.subsubcategories' => function ($query) {
                    $query->select('id', 'name as title', 'slug', 'subcategory_id');
                }
            ])->select('id', 'name as title', 'slug')->get();
            
            // Transform the structure and add the 'link' and 'query' fields
            $transformedCategories = $categories->map(function ($category) {
                $category->submenu = $category->subcategories->map(function ($subcategory) use ($category) {
                    $subcategory->submenu = $subcategory->subsubcategories->map(function ($subsubcategory) use ($category, $subcategory) {
                        $subsubcategory->query = "/{$category->id}/{$subcategory->id}/{$subsubcategory->id}";
                        $subsubcategory->link = "/shop"."/{$category->slug}/{$subcategory->slug}/{$subsubcategory->slug}";
                        return $subsubcategory;
                    });
                    $subcategory->query = "/{$category->id}/{$subcategory->id}";
                    $subcategory->link =  "/shop"."/{$category->slug}/{$subcategory->slug}";
                    unset($subcategory->subsubcategories);
                    return $subcategory;
                });
                $category->query = "/{$category->id}";
                $category->link =  "/shop"."/{$category->slug}";
                unset($category->subcategories);
                return $category;
            });

            $manualMenuItems = [
               [
                  "id" => (string) Str::uuid(),
                  "title" => "Home",
                  "slug" => "",
                  "submenu" => [],
                  "query" => "",
                  "link" => "/"
               ],
               [
                  "id" => (string) Str::uuid(),
                  "title" => "Digital Gift Voucher",
                  "slug" => "",
                  "submenu" => [],
                  "query" => "",
                  "link" => "/digital-gift-vouchers"
               ],
               [
                  "id" => (string) Str::uuid(),
                  "title" => "About",
                  "slug" => "",
                  "submenu" => [],
                  "query" => "",
                  "link" => "/about-us"
               ]
            ];

            $mergedMenuItems = array_merge($manualMenuItems, $transformedCategories->toArray());
            
            return response()->json([
                'success' => 'Categories retrieved successfully.',
                'data' => $mergedMenuItems,
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve categories.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
  
}