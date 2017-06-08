<?php
namespace App\Api\Controllers;

use App\Repository\ShoppingListRepository;
use App\Transformers\WishListTransformer;
use Dingo\Api\Http\Response;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Method\Get;

/**
 * Class ClientController
 * @package App\Api\Controllers
 *
 * @Resource("Client", uri="/client")
 */
class ClientController extends ApiBaseController
{
    /**
     * Client information
     *
     * @Get("/")
     *
     * @return Response
     */
    public function info(): Response {
        return $this->response->array(['name' => 'Jon']);
    }

    /**
     * Client Wish Lists
     *
     * @Get("/wishlists")
     *
     * @param ShoppingListRepository $repo
     * @param WishListTransformer $transformer
     * @return Response
     */
    public function wishLists(ShoppingListRepository $repo, WishListTransformer $transformer): Response
    {
        $wishlists = $repo->findByClientId(1);

        return $this->response->collection(collect($wishlists), $transformer);
    }

    /**
     * Client Shopping History
     *
     * @Get("/history")
     *
     * @param ShoppingListRepository $repo
     * @param WishListTransformer $transformer
     * @return Response
     */
    public function shoppingHistory(ShoppingListRepository $repo, WishListTransformer $transformer): Response
    {

    }
}