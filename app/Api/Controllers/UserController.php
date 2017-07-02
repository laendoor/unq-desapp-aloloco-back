<?php
namespace App\Api\Controllers;

use Google_Client;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Method\Get;
use Dingo\Blueprint\Annotation\Method\Post;
use App\Repository\UserRepository;
use App\Repository\ShoppingListRepository;
use App\Transformers\UserTransformer;
use App\Transformers\ShoppingListTransformer;

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
     * @Get("/{id}")
     *
     * @param int $id
     * @param UserRepository $repo
     * @param UserTransformer $transformer
     * @return Response
     */
    public function info(int $id, UserRepository $repo, UserTransformer $transformer): Response {
        $id = $id == 0 ? 1 : intval($id);

        $user = $repo->find($id);

        return $this->response->item($user, $transformer);
    }

    /**
     * User Wish Lists
     *
     * @Get("/{id}/wishlists")
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
     * @Get("/{id}/history")
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
     * Get Box or Time Waiting
     *
     * @Get("/{id}/shopping-list/{listId}/box")
     *
     * @param int $id
     * @param int $listId
     * @return Response
     */
    public function getBox(int $id, int $listId): Response
    {
        $time = rand(0, 30);

        if ($time > 5) {
            $status = 'wait';
            $message = "Tiempo de espera: {$time} minutos";
        } else {
            $box = rand(1, 10);
            $status = 'ok';
            $message = "Pase por caja {$box}";
        }

        return $this->response->array(compact('status', 'message', 'time'));
    }

    /**
     * Auth user
     *
     * @Post("/auth")
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