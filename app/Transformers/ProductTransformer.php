<?php
namespace App\Transformers;

use App\Model\Product\Product;

/**
 * Class ProductTransformer
 * @package App\Tranformers
 */
class ProductTransformer extends Transformer
{
    public function transform(Product $product): array {
        return [
            'id'    => $product->getId(),
            'name'  => $product->getName(),
            'brand' => $product->getBrand(),
            'image' => $product->getImage(),
        ];
    }
}
