<?php

namespace App\Http\Controllers\API;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class SubscriberController extends Controller
{
    public function register(Request $request): Response
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255|unique:subscribers',
                'email' => 'required|string|email|max:255|unique:subscribers',
                'password' => 'required|string|min:8|confirmed',
                'terms_accepted' => 'required|accepted',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $validatedData = $validator->validated();
            $validatedData['password'] = Hash::make($validatedData['password']);

            $subscriber = Subscriber::create($validatedData);

            // Attempt to authenticate the newly registered user
            if (Auth::attempt(['email' => $validatedData['email'], 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('AuthToken')->accessToken;

                return response()->json(['token' => $token], Response::HTTP_CREATED);
            } else {
                return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request): Response
    {
        try {
            $validator = Validator::make($request->all(), [
                'email_or_phone' => 'required|string',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $credentials = $request->only('email_or_phone', 'password');

            $field = filter_var($credentials['email_or_phone'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

            if (Auth::attempt([$field => $credentials['email_or_phone'], 'password' => $credentials['password']])) {
                $user = Auth::user();
                $token = $user->createToken('AuthToken')->accessToken;

                return response()->json(['token' => $token], Response::HTTP_OK);
            } else {
                return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}