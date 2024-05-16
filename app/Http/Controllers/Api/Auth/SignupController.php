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
            $this->extraValidation = ['linkedin' => ['nullable', 'url']];

            if ($this->register($request)->getStatusCode() == 201) {

                
                return $this->success(message: "sent you a verification letter 💌 !");
            }
        } catch (ValidationException $th) {

            return $this->error(message: $th->getMessage());
        }
    }
}
