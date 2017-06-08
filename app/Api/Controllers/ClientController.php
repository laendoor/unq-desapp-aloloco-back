<?php
namespace App\Api\Controllers;

use App\Repository\UserRepository;
use App\Repository\ShoppingListRepository;
use App\Transformers\ShoppingListTransformer;
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
     * @param int $id
     * @param UserRepository $repo
     * @return Response
     */
    public function info(int $id, UserRepository $repo): Response {
        $id = $id == 0 ? 1 : intval($id);

        $user = $repo->find($id);

        return $this->response->array(['email' => $user->getEmail()]);
    }

    /**
     * Client Wish Lists
     *
     * @Get("/wishlists")
     *
     * @param int $id
     * @param ShoppingListRepository $repo
     * @param ShoppingListTransformer $transformer
     * @return Response
     */
    public function wishLists(int $id, ShoppingListRepository $repo, ShoppingListTransformer $transformer): Response
    {
        $id = $id == 0 ? 1 : intval($id);

        $wishlists = $repo->findByClientId($id);

        return $this->response->collection(collect($wishlists), $transformer);
    }

    /**
     * Client Shopping History
     *
     * @Get("/history")
     *
     * @param int $id
     * @param ShoppingListRepository $repo
     * @param ShoppingListTransformer $transformer
     * @return Response
     */
    public function shoppingHistory(int $id, ShoppingListRepository $repo, ShoppingListTransformer $transformer): Response
    {
        $id = $id == 0 ? 1 : intval($id);

        $lists = $repo->findPurchasedByClientId($id);

        return $this->response->collection(collect($lists), $transformer);
    }
}