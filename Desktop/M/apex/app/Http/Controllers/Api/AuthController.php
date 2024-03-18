<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => ['required', 'email'],
                'password' => ['required']
            ]
        );


        if ($validator->fails()) {
            return response(
                [
                    'errors' => $validator->errors()->all(),
                ],
                422
            );
        }


        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = Auth::user();

            $token = $user->createToken('Apex Token')->accessToken;
            return response(
                [
                    'message' => 'Successful',
                    'token' => $token,

                ],
                200
            );
        }

        return response()->json(
            ['message' => "Incorrect email or password"]
        );
    }

    public function register(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string'],
                'email' => ['email', 'required', 'unique:users,email'],
                'password' => ['required', 'confirmed', 'min:6']
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => 'Valiadtion Errors',
                    'errors' => $validator->errors()->all(),
                ],
                422
            );
        }

        $data = $request->all();

        $data['password'] = Hash::make($request['password']);

        $user = User::create($data);


        $generatedToken = $user->createToken('Apex Token')->accessToken;

        return response(
            [
                'message' => 'User created successfully',
                'token' => $generatedToken
            ]
        );
    }
}
