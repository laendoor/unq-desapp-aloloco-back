<?php
namespace App\Api\Controllers;

use App\Repository\UserRepository;
use App\Repository\WishListRepository;
use App\Transformers\WishListTransformer;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Blueprint\Annotation\Method\Post;
use Dingo\Blueprint\Annotation\Resource;
use Dingo\Blueprint\Annotation\Method\Get;
use Google_Client;

/**
 * Class UserController
 * @package App\Api\Controllers
 *
 * @Resource("User", uri="/user")
 */
class UserController extends ApiBaseController
{
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