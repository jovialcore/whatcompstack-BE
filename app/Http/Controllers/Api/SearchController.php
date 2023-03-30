<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

use App\Http\Resources\SearchResultResource;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function search(Request $req)
    {

        $companyStack = new Company();


        if ($req->item) {
            $results = $companyStack::query()
                ->where('name', 'LIKE', '%' . $req->item . '%')
                ->orWhereJsonContains('stack_be', [$req->item])
                ->orWhereJsonContains('stack_fe', [$req->item])
                ->orWhereJsonContains('devops', [$req->item])
                ->orWhereJsonContains('database_driver', [$req->item])

                ->orderBy('id', 'DESC')->paginate(10);


            if (count($results) > 0)
                return response()->json([SearchResultResource::collection($results)], 200);

            else
                return response()->json(['message' => 'No  results found '], 404);
        }
    }
}
