<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function register(array $data);
    public function login(array $credentials);
    public function logout();
}
