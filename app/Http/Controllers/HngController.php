<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class HngController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $names = [
        "United States",
        "Canada",
        "United Kingdom",
        "Australia",
        "Germany",
        "France",
        "Japan",
        "China",
        "Brazil",
        "India",
        "South Africa",
        "Mexico",
        "Spain",
        "Italy",
        "Russia",
        "Egypt",
        "Nigeria",
        "Argentina",
        "Saudi Arabia",
        "Turkey",
        "South Korea",
        "New Zealand",
        "Greece",
        "Sweden",
        "Norway",
        "Netherlands",
        "Switzerland",
        "Singapore",
        "Thailand",
    ];


    public $dogs =
    [
        "Max",
        "Bella",
        "Charlie",
        "Lucy",
        "Rocky",
        "Daisy",
        "Buddy",
        "Sadie",
        "Cooper",
        "Luna",
        "Teddy",
        "Ruby",
        "Bailey",
        "Molly",
        "Duke",
        "Rosie",
        "Oliver",
        "Zoe",
        "Toby",
        "Lily",
        "Bear",
        "Chloe",
        "Zeus",
        "Mia",
        "Winston",
        "Sophie",
        "Murphy",
        "Bella",
        "Leo",
        "Penny"
    ];

    public function index()
    {

        $response = Http::get(request('text'));
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $nameIndex = array_rand($this->names);
        try {
            $response = Http::timeout(2)->post(request('text'), [
                'name' => $this->names[$nameIndex],
            ]);
        } catch (RequestException $e) {
            return "Oops, {$e}";
        }
        $name = $this->names[$nameIndex];
        if (!in_array($response->status(), [200, 201])) {
            return "Your status for post request, your endpoint  is returning error {$response->status()}. Please fix ⚠️";
        }
        $id = null;
        if (!isset($response->object()->name)) {
            //e.g https://crud-person.onrender.com/api
            $response = Http::timeout(2)->get(request('text'));
            if (!empty($response->json()['data'])) {
                collect($response->json()['data'])->each(function ($item) use ($name, &$id) {
                    if ($item['name'] !== $name) {
                        $id = $item['id'] ?? $item['_id'];
                        return "I can't find {$name} when I make a post request. Please fixed up";
                    };
                });
            }
        } else {
            if ($response->object()->name !== $this->names[$nameIndex]) {

                return "I can't find {$this->names[$nameIndex]} when I make a post request. Please fixed up";
            };
        }

        if (!empty(($response->object()))) {
            $id = $response->json()['id'] ?? $response->json()['_id'];
            $name =  $response->json()['name'];
        };

        $response = Http::timeout(20)->put(request('text'), [
            'name' => $this->dogs[$nameIndex],
            'id' => $id,
            '_id' => $id,
        ]);


        if ($response->status() !== 200) {
            if (is_array($response->json())) {
                $furtherErrors =  implode(' ,', $response->json()) ?? '';

                $eroor = $response->json()['error'];
                $methodError = "";
                if (Str::contains($eroor, ['method', "Method"])) {
                    $methodError = " Also, looks like you are not using the proper method for your update request";
                }
            }
            if (isset($furtherErrors) && isset($methodError)) {
                $furtherErrors = 'Further errors : ' . $furtherErrors ?? '';
                $methodError =  'Further errors : ' . $methodError ?? '';

                return "Your status for update is returning error {$response->status()} {$furtherErrors}...Please fix. " . $methodError . '⚠️';
            }
            return "Your status for update is returning error {$response->status()}";
        }

        if ($response->object()->name !== $this->dogs[$nameIndex]) {

            return "I can't find {$this->names[$nameIndex]} when I make an update request. Please fixed up";
        };
        return $response->throw();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
