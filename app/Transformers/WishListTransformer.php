<?php
namespace App\Transformers;
use App\Model\ShoppingList;


/**
 * Class WishListTransformer
 * @package App\Tranformers
 */
class WishListTransformer extends Transformer
{
    public function transform(ShoppingList $list): array {
        return [
            'id' => 1,
        ];
    }
}
