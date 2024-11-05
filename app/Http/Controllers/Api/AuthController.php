<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Traits\ResponseWithHttpStatus;

class AuthController extends Controller
{

    use ResponseWithHttpStatus;
    /**
     * Registration Req
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'active' => 1,
        ]);
        $data = [
            'name' => $user->name,
            'email' => $user->email,
        ];
        if ($user->id > 0) {
            return $this->success($data, 'You have registered successfully.', 200);
        }
        return $this->failure('Erorr while registering.', $data);
        $token = $user->createToken('Laravel-9-Passport-Auth ')->accessToken;
    }

    /**
     * Login Req
     */
    public function login(LoginRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'active' => 1
        ];

        if (Auth::attempt($data)) {
            $auth = Auth::user();
            $token = Auth::user()->createToken('Laravel-9-Passport-Auth')->accessToken;
            $data = [
                'name' => $auth->name,
                'email' => $auth->email,
                'token' => $token
            ];
            return $this->success($data, 'Login successfull.', 200);
        }

        return $this->failure(
            'Login Fail',
        );
    }

    public function userInfo()
    {
        //return 'Test';
        $user = Auth::user();
        if ($user->id > 0) {
            return $this->success('Get user info', $user, 200);
        }
        return $this->failure('Failed to retrive user data.');
    }
}
