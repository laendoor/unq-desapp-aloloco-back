<?php
namespace App\Transformers;

use App\Model\Product\WishedProduct;

/**
 * Class ProductTransformer
 * @package App\Tranformers
 */
class WishedProductTransformer extends Transformer
{
    public function transform(WishedProduct $product): array {
        return [
            'id'    => $product->getId(),
            'name'  => $product->getName(),
            'brand' => $product->getBrand(),
            'image' => $product->getImage(),
            'quantity' => $product->getQuantity(),
        ];
    }
}
