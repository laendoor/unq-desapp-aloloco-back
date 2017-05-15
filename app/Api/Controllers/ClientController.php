<?php
namespace App\Api\Controllers;

use App\Repository\WishListRepository;
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
     * Show client logged information
     *
     * @Get("/")
     *
     * @return Response
     */
    public function info(): Response {
        return $this->response->array(['name' => 'Jon']);
    }

    /**
     * Show client wish lists
     *
     * @Get("/wishlists")
     *
     * @param WishListRepository $repo
     * @param WishListTransformer $transformer
     * @return Response
     */
    public function wishLists(WishListRepository $repo, WishListTransformer $transformer): Response
    {
        $wishlists = $repo->findByClientId(1);

        return $this->response->collection(collect($wishlists), $transformer);
    }
}