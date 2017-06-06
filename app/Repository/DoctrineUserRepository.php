<?php
namespace App\Repository;

use App\Model\Market;
use App\Model\User;
use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineUserRepository
 * @package App\Repository
 */
class DoctrineUserRepository
    extends EntityRepository
    implements UserRepository {

    public function findByGoogleId($id)
    {
        $query = $this->_em->createQuery('SELECT u FROM App\Model\User u');

        return $query->getResult();
    }

    public function create($google_id, $email)
    {
        $user = new User(new Market, $email, $google_id);

        $this->_em->persist($user);
        $this->_em->flush();
    }
}