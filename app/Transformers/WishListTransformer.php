<?php
namespace App\Transformers;
use App\Model\Product\Product;
use App\Model\ShoppingList;


/**
 * Class WishListTransformer
 * @package App\Tranformers
 */
class WishListTransformer extends Transformer
{
    public function transform(ShoppingList $list): array
    {
        return [
            'id' => $list->getId(),
            'name' => $list->getName(),
            'client' => [
                'id'   => $list->getClient()->getId(),
                'email' => $list->getClient()->getEmail(),
            ],
            'products' => $this->serializeCollection($list->getWishProducts(), new ProductTransformer),
        ];
    }
}
