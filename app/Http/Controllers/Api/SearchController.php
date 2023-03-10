<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

use App\Http\Resources\SearchResultResource;

class SearchController extends Controller
{

    public function search(Request $req)
    {
       
        $companyStack = new Company();

        if ($req->item) {
            $results = Company::query()
                // ->where('name', 'LIKE', '%' . $req->item . '%')
                ->whereJsonContains('stack_be', [$req->item])
                // ->whereJsonContains('stack_fe', [$req->item])
                ->orderBy('id', 'DESC')->paginate(10);


            return response()->json([SearchResultResource::collection($results)]);
        }
    }
}
