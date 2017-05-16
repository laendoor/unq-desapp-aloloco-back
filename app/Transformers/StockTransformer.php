<?php
namespace App\Transformers;

use App\Model\Product\StockedProduct;

/**
 * Class StockTransformer
 * @package App\Tranformers
 */
class StockTransformer extends Transformer
{
    public function transform(StockedProduct $product): array {
        return [
            'id'    => $product->getId(),
            'name'  => $product->getName(),
            'brand' => $product->getBrand(),
            'stock' => $product->getStock(),
            'image' => $product->getImage(),
        ];
    }
}
