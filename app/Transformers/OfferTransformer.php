<?php
namespace App\Transformers;

use App\Model\Offer;
use League\Fractal\Resource\Item;

/**
 * Class ProductCategoryTransformer
 * @package App\Tranformers
 */
class OfferTransformer extends Transformer
{
    public function transform(Offer $offer): array {
        return [
            'id'       => $offer->getId(),
            'category' => new Item($offer->getCategory(), new ProductCategoryTransformer),
            'percentage' => $offer->getPercentage(),
            'valid_from' => $offer->getValidFrom(),
            'valid_to'   => $offer->getValidTo(),
        ];
    }
}
