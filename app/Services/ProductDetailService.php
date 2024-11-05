<?php

namespace App\Services;

use App\Models\Product;

class ProductDetailService
{
    /**
     * Retrieve product details by its slug.
     *
     * @param string $slug
     * @return array|null
     */
    public function getProductDetailsBySlug(string $slug): ?array
    {
        // Extract the product ID from the slug
        $productId = current(explode("-", $slug));

        // Fetch the product with related data
        $product = Product::with([
            'category:id,name',
            'brand:id,name',
            'galleryImages:id,product_id,image',
            'tags:id,product_id,name',
            'productStock.attributeOptions.attribute',
            'productStock.attributeOptions.attributeValue'
        ])->find($productId);

        // If the product is not found, return null
        if (!$product) {
            return null;
        }

        return $this->formatProductDetails($product);
    }

    /**
     * Format the product details for output.
     *
     * @param Product $product
     * @return array
     */
    protected function formatProductDetails(Product $product): array
    {
        // Calculate the total quantity of the product
        $totalQuantity = $product->productStock->isNotEmpty()
            ? $product->productStock->sum('quantity')
            : ($product->quantity ?? 0);

        // Collect gallery image URLs
        $galleryImages = $product->galleryImages->pluck('image')->toArray() ?? [];

        // Prepare product variations
        $productVariations = $this->getProductVariations($product);

        return [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'sku' => $product->sku_code,
            'shipping' => [
                'free_shipping' => false
            ],
            'image' => [
                'thumbnail' => $product->thumb_image,
                'back' => $product->back_image,
                'gallery' => $galleryImages,
            ],
            'stock' => [
                'total_quantity' => $totalQuantity,
                'variations' => $productVariations
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
            'review' => [], // Placeholder for product reviews
        ];
    }

    /**
     * Get the product variations including attribute names and values.
     *
     * @param Product $product
     * @return array
     */
    protected function getProductVariations(Product $product): array
    {
        $variations = [];

        foreach ($product->productStock as $stock) {
            $attributeNameValuePairs = [];
            foreach ($stock->attributeOptions as $option) {
                $attributeNameValuePairs[] = [
                    'attribute_id' => $option->attribute->id,
                    'attribute_name' => $option->attribute->attr_name,
                    'attribute_value_id' => $option->attributeValue->id,
                    'attribute_value' => $option->attributeValue->attr_value,
                ];
            }

            $variations[] = [
                'quantity' => $stock->quantity,
                'attributes' => $attributeNameValuePairs
            ];
        }

        return $variations;
    }
}
