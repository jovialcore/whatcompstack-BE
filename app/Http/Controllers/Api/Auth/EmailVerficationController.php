<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Auth\VerificationController;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Validation\ValidationException;

class EmailVerficationController extends VerificationController
{
    use ApiResponse, VerifiesEmails;


    public function verificationHandler(Request $request)
    {
        try {
            if ($this->verify($request)->getStatusCode() == 204) {

                return $this->success(message: "Email Verified ! You are in 👋");
            }
        } catch (ValidationException $th) {

            return $this->error(message: $th->getMessage());
        }
    }
}
