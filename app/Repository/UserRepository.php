<?php
namespace App\Repository;

/**
 * Interface UserRepository
 * @package Repository
 */
interface UserRepository
{
    public function find($id);
    public function findByGoogleId($id);
    public function create($google_id, $email);
}