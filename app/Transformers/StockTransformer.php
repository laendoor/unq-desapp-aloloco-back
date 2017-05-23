<?php
namespace App\Transformers;

use App\Model\Product\Product;
use App\Model\Product\StockedProduct;

/**
 * Class StockTransformer
 * @package App\Tranformers
 */
class StockTransformer extends Transformer
{
    public function transform(Product $product): array {
        return [
            'id'    => $product->getId(),
            'name'  => $product->getName(),
            'brand' => $product->getBrand(),
            'stock' => $product->getStock(),
            'image' => $product->getImage(),
        ];
    }
}
