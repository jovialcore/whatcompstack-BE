<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SignupController extends RegisterController
{

    use ApiResponse;

    public function signup(Request $request)
    {
        try {
            $this->appendFields = ['linkedin_url' => ['nullable', 'url']];

            if ($this->register($request)->getStatusCode() == 201) {


                return $this->success(message: "Registration Successful. Please confirm your email");
            }
        } catch (ValidationException $th) {

            return $this->error(message: $th->getMessage());
        }
    }
}
