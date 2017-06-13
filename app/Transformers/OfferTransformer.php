<?php
namespace App\Transformers;

use App\Model\Offer;

/**
 * Class ProductCategoryTransformer
 * @package App\Tranformers
 */
class OfferTransformer extends Transformer
{
    public function transform(Offer $offer): array {
        return [
            'id'       => $offer->getId(),
            'category' => $this->item($offer->getCategory(), new ProductCategoryTransformer),
            'percentage' => $offer->getPercentage(),
            'valid_from' => $offer->getValidFrom(),
            'valid_to'   => $offer->getValidTo(),
        ];
    }
}
