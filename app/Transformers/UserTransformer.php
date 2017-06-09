<?php
namespace App\Transformers;

use App\Model\User;


/**
 * Class UserTransformer
 * @package App\Tranformers
 */
class UserTransformer extends Transformer
{
    public function transform(User $user): array
    {
        return [
            'id' => $user->getId(),
            'email'     => $user->getEmail(),
            'username'  => $user->getUsername(),
            'address'   => $user->getAddress(),
            'google_id' => $user->getGoogleId(),
        ];
    }
}
