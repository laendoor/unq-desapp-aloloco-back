<?php
namespace App\Transformers;

use App\Model\ShoppingList;


/**
 * Class ShoppingListTransformer
 * @package App\Tranformers
 */
class ShoppingListTransformer extends Transformer
{
    public function transform(ShoppingList $list): array
    {
        return [
            'id' => $list->getId(),
            'name' => $list->getName(),
            'user' => [
                'id'   => $list->getUser()->getId(),
                'email' => $list->getUser()->getEmail(),
            ],
            'products' => $this->serializeCollection($list->getProducts(), new WishedProductTransformer),
        ];
    }
}
