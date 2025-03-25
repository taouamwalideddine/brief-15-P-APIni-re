<?php


namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function register(array $data);
    public function findByEmail(string $email);
    public function createToken(object $user);
    public function invalidateToken(object $user);
}
