<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function register(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'customer'
        ]);
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function createToken(object $user)
    {
        return $user->createToken('auth_token')->plainTextToken;
    }

    public function invalidateToken(object $user)
    {
        return $user->currentAccessToken()->delete();
    }
}
