<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;

class ProductFilterService
{
    /**
     * Filter products based on the given query string.
     * If query is empty, return all products.
     *
     * @param string|null $query
     * @return \Illuminate\Support\Collection
     */
    /**
     * Filter products based on the given query string.
     * If query is empty, return all products paginated.
     *
     * @param string|null $query
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filterProductsByQuery(?string $query, int $perPage = 10)
    {
        // If no query is provided, return all products paginated
        if (empty($query)) {
            return Product::with(['productStock.attributeOptions.attribute', 'productStock.attributeOptions.attributeValue'])
                ->paginate($perPage)
                ->through(function ($product) {
                    return $this->formatProduct($product);
                });
        }
    
        $queryParts = explode('/', trim($query, '/'));
    
        // Ensure at least the category slug is provided
        if (count($queryParts) < 1) {
            return collect();
        }
    
        // Extract slugs
        [$categorySlug, $subcategorySlug, $subsubcategorySlug] = array_pad($queryParts, 3, null);
        // Query the database using relationships
        $category = Category::where('slug', $categorySlug)->first();
    
        if (!$category) {
            return collect();
        }
        // Start the product query with the found category
        $productQuery = Product::with(['productStock.attributeOptions.attribute', 'productStock.attributeOptions.attributeValue'])
            ->where('category_id', $category->id);
    
        // Optionally add subcategory filtering
        if ($subcategorySlug) {
            $subcategory = $category->subcategories()->where('slug', $subcategorySlug)->first();
            if ($subcategory) {
                $productQuery->where('subcategory_id', $subcategory->id);
    
                // Optionally add subsubcategory filtering
                if ($subsubcategorySlug) {
                    $subsubcategory = $subcategory->subsubcategories()->where('slug', $subsubcategorySlug)->first();
                    if ($subsubcategory) {
                        $productQuery->where('subsubcategory_id', $subsubcategory->id);
                    } else {
                        return collect();
                    }
                }
            } else {
                return collect();
            }
        }
    
        // Execute the query with pagination and transform the results
        return $productQuery->paginate($perPage)->through(function ($product) {
            return $this->formatProduct($product);
        });
    }
    
    /**
     * Format the product into the desired structure.
     *
     * @param \App\Models\Product $product
     * @return array
     */
    protected function formatProduct(Product $product): array
    {
        $totalQuantity = 0;

        // Check if productStocks relationship is loaded and has data
        if ($product->relationLoaded('productStock') && $product->productStock->isNotEmpty()) {
            $totalQuantity = $product->productStock->sum('quantity');
        } else {
            // Fallback to product's default quantity, ensure it’s set
            $totalQuantity = $product->quantity ?? 0;
        }

        return [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'sku' => $product->sku_code,
            'shipping' => [
                'free_shipping' => false
            ],
            'image' => [
                'thumb_image' => $product->thumb_image,
                'back_image' => $product->back_image,
            ],
            'stock' => [
                'quantity' => $product->quantity ?? 0,
                'available_quantity' => $totalQuantity,
            ],
            'price' => [
                'base_price' => $product->base_price,
                'discount' => [
                    'amount_or_percentage' => $product->discount_percentage_or_flat_amount ?? 0,
                    'type' => getDiscountType($product->discount_option),
                    'amount' => $product->discount_amount ?? 0,
                ],
                'offer_price' => $product->offer_price ?? 0,
            ],
            'review' => [
                'rating' => rand(3, 5),
                'totalReviewCount' => rand(50, 1000),
            ],
            'highlights' => [
                ['text' => 'free_shipping']
            ]
        ];
    }
}