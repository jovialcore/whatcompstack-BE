<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HngxController extends Controller
{
    // fetch url from user

    // try the name, if it works, try thr number

    // make a post request, 
    // read for that post request
    //  update a new one 
    // check if new one reflected
    // delete what was there
    // confirm if deleted
    // save to excel
    // confirm if the user  has submitted before
    // close submission



    public function feth()
    {
        $response = Http::get(request('text'));
        return $response;
    }

    public function fetch()
    {
        $response = Http::post(request('text'), [
            'name' => 'joviaclroe'
        ]);
        dd($response->body());
    }
}
