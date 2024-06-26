<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use HasApiTokens;

    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user with validated data
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Generate an access token for the newly registered user
        $token = $user->createToken('authToken')->accessToken;

        // Return a JSON response with success message, user details, and token
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token
        ], 201); // 201 Created status code
    }

    /**
     * Login user and create token
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if (!Auth::attempt($credentials)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;

            return response()->json([
                'message' => 'User logged in successfully',
                'user' => $user,
                'token' => $token
            ], 200);
        } catch (ValidationException $e) {
            // Validation errors (e.g., incorrect credentials)
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Other exceptions
            return response()->json(['message' => 'Failed to log in user', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * update user password
     */
    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            $user = Auth::guard('api')->user();

            if (!$user) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }

            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['The provided current password does not match our records.'],
                ]);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            Log::info('Password updated successfully for user: ' . $user->id);

            return response()->json(['message' => 'Password updated successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error updating password: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }
    /**
     * update user password
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        // Revoke the user's current token
        $user->token()->revoke();

        Log::info('User logged out successfully: ' . $user->id);

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
