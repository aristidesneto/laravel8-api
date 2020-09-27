<?php

namespace App\Http\Controllers\_Auth;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    private $tokenName;

    public function __construct()
    {
        $this->tokenName = config('tenant.token_name', 'token');
    }

    public function getAuthenticatedUser()
    {
        if (Auth::check()) {
            return response()->json(new UserResource(auth()->user()), 200);
        }

        return response()->json(['status' => 'user not logging'], 401);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'status' => 'success',
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        // Obter ID do tenant
        $user = User::where('email', $loginData['email'])->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Credenciais inválidas'
            ]);
        }

        $tenant = Tenant::where('id', $user->tenant_id)->first();
        unset($loginData['tenant']);
        $loginData['tenant_id'] = $tenant->id;

        if (!Auth::attempt($loginData)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Credenciais inválidas'
            ]);
        }

        $token = auth()->user()->createToken('authToken')->accessToken;

        $cookie = $this->getCookieDetails($token);

        return response()->json([
            'status' => 'success',
            'user' => new UserResource(auth()->user()),
        ], 200)->withCookie(
            $cookie['name'],
            $cookie['value'],
            $cookie['minutes'],
            $cookie['path'],
            $cookie['domain'],
            $cookie['secure']
        );
    }

    private function getCookieDetails($token)
    {
        return [
            'name' => $this->tokenName,
            'value' => $token,
            'minutes' => 1440,
            'path' => null,
            'domain' => null,
            'secure' => config('tenant.token_secure', null),
            'httponly' => true,
            'samesite' => true,
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $cookie = Cookie::forget($this->tokenName);

        return response()->json([
            'message' => 'successful logout'
        ])->withCookie($cookie);
    }
}
