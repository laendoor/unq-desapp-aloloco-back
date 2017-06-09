<?php
namespace App\Api\Controllers;

use Google_Client;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Method\Get;
use Dingo\Blueprint\Annotation\Method\Post;
use App\Repository\UserRepository;
use App\Transformers\ShoppingListTransformer;
use App\Repository\ShoppingListRepository;

/**
 * Class UserController
 * @package App\Api\Controllers
 *
 * @Resource("User", uri="/user")
 */
class UserController extends ApiBaseController
{
    /**
     * User information
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
     * User Wish Lists
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

        $wishlists = $repo->findByUserId($id);

        return $this->response->collection(collect($wishlists), $transformer);
    }

    /**
     * User Shopping History
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

        $lists = $repo->findPurchasedByUserId($id);

        return $this->response->collection(collect($lists), $transformer);
    }

    /**
     * Auth user
     *
     * @Post("/AUTH")
     *
     * @param Request $request
     * @param UserRepository $repo
     * @return Response
     */
    public function checkToken(Request $request, UserRepository $repo): Response {
        $client = new Google_Client(['client_id' => config('google.client-id')]);
        $payload = $client->verifyIdToken($request->input('token'));
        if ($payload) {
            $google_id = $payload['sub'];
            $email     = $payload['email'];
            $user = $repo->findByGoogleId($google_id);
            if (empty($user)) {
                $repo->create($google_id, $email);
            }
            return $this->response->array(['auth' => 'ok']);
        } else {
            return $this->response->errorUnauthorized('Invalid Token');
        }
    }
}