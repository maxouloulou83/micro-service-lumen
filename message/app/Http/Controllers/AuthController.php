<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [
                'login',
                'register'
            ]
        ]);
    }

    /**
     * Attempt to register a new user to the API.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {

        try {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = Hash::make($plainPassword);
            $user->save();
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User Registration Failed!'], 409);
  }
    }
    /**
     * Attempt to authenticate the user and retrieve a JWT.
     * Note: The API is stateless. This method _only_ returns a JWT. There is not an
     * indicator that a user is logged in otherwise (no sessions).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        // Are the proper fields present?
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            // Login has failed
            return response()->json(['message' => 'Mauvais MDP ou Email.'], 401);
        }
        return $this->respondWithToken($token);
    }
    /**
     * Log the user out (Invalidate the token). Requires a login to use as the
     * JWT in the Authorization header is what is invalidated
     *
     * @return JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh the current token.
     *
     * @return JsonResponse
     */
    public function refresh() {
        return $this->respondWithToken( auth()->refresh() );
    }
    /**
     * Helper function to format the response with the token.
     *
     * @return JsonResponse
     */
    private function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);}
}
