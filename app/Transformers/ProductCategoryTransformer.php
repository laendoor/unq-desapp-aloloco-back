<?php
namespace App\Transformers;

use App\Model\ProductCategory;

/**
 * Class ProductCategoryTransformer
 * @package App\Tranformers
 */
class ProductCategoryTransformer extends Transformer
{
    public function transform(ProductCategory $category): array {
        return [
            'id'   => $category->getId(),
            'slug' => $category->getSlug(),
            'name' => $category->getName(),
        ];
    }
}
