<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'customer'
        ]);

        $token = $this->userRepository->createToken($user);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = $this->userRepository->findByEmail($request->email);

        if (!$this->userRepository->validateCredentials($user, $request->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $this->userRepository->createToken($user);

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $this->userRepository->invalidateToken($request->bearerToken());

        return response()->json(['message' => 'Logout successful'], 200);
    }
}
