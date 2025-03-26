<?php


namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function create(array $data);
    public function findByEmail(string $email);
    public function validateCredentials($user, string $password);
    public function createToken($user);
    public function invalidateToken($token);
}
