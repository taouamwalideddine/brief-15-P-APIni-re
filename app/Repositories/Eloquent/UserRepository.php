<?php


namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data)
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

    public function validateCredentials($user, string $password)
    {
        return $user && Hash::check($password, $user->password);
    }

    public function createToken($user)
    {
        return JWTAuth::fromUser($user);
    }

    public function invalidateToken($token)
    {
        return JWTAuth::invalidate($token);
    }
}
