<?php

namespace App\Http\Controllers;

use App\Exports\XcrudExcel;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;


class HngController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $names = [
        "Lionel Messi",
        "Cristiano Ronaldo",
        "Neymar Jr.",
        "Kylian Mbappé",
        "Mohamed Salah",
        "Robert Lewandowski",
        "Karim Benzema",
        "Harry Kane",
        "Kevin De Bruyne",
        "Luka Modrić",
        "Sergio Ramos",
        "Sadio Mané",
        "Erling Haaland",
        "Bruno Fernandes",
        "Joshua Kimmich",
        "Gianluigi Donnarumma",
        "Virgil van Dijk",
        "Romelu Lukaku",
        "Thomas Müller",
        "Toni Kroos",
        "Paul Pogba",
        "Raheem Sterling",
        "Sergio Agüero",
        "Thiago Alcântara",
        "Antoine Griezmann",
        "N'Golo Kanté",
        "Casemiro",
        "Jadon Sancho",
        "Heung-Min Son",
        "Hakim Ziyech",
    ];


    public $dogs = [
        "Oak",
        "Maple",
        "Pine",
        "Birch",
        "Cedar",
        "Redwood",
        "Elm",
        "Ash",
        "Willow",
        "Cherry",
        "Poplar",
        "Spruce",
        "Fir",
        "Cypress",
        "Sequoia",
        "Alder",
        "Hickory",
        "Mahogany",
        "Walnut",
        "Palm",
        "Beech",
        "Sycamore",
        "Chestnut",
        "Magnolia",
        "Linden",
        "Douglas Fir",
        "Ginkgo",
        "Yew",
        "Bamboo",
    ];


    protected $mainName;
    protected $mainId;
    protected $csvfile = [];
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
    public function store(Request $request, Excel $excel)
    {



        $nameIndex = array_rand($this->names);
        try {
            $response = Http::retry(3, 100)->post(request('text'), [
                'name' => $this->names[$nameIndex]
            ]);
        } catch (RequestException $e) {
            return "Oops, {$e->response->body()}";
        }
        $name = $this->names[$nameIndex];

        if (!in_array($response->status(), [200, 201])) {
            return "Your status for post request, your endpoint  is returning error {$response->status()}. It maybe a sleepy server issue..if so, keep retrying, if not, check Your end point well! ";
        }
        $id = null;
        if (!isset($response->object()->name)) {
            //e.g https://crud-person.onrender.com/api
            $response = Http::timeout(7)->get(request('text'));
            if (!empty($response->json()['data'])) {
                collect($response->json()['data'])->each(function ($item) use ($name, &$id) {
                    if ($item['name'] !== $name) {
                        $id = $item['id'] ?? $item['_id'];

                        return "I can't find the name like {$name} when I make a post request. Please fixed up";
                    };
                });
            }
        } else {
            if ($response->object()->name !== $this->names[$nameIndex]) {

                return "I can't find a name like {$this->names[$nameIndex]} when I make a post request. Please fixed up";
            };
        }


        if (!empty(($response->object()))) {
            if (!isset($response->json()['name'])) {
                $i = 0;
                foreach ($response->json() as $key => $value) {
                    if (!is_integer($key)) {

                        if (isset($key)) {
                            // some are putting the array contents in key name pairs like data => [], person => [], etc. so to address such situations, hence the code below
                            if (is_string($key) && is_iterable($value)) { // tacle this part, it could be data

                                $found = false;
                                foreach ($value as $k => $v) {
                                    while ($v['name'] ==  $this->names[$nameIndex]) {
                                        $this->mainName = $v['name'];
                                        $this->mainId = $v['id'] ?? $v['_id'];
                                        $found = true;
                                        break;
                                    }
                                }

                                if (!$found) {
                                    return "I'm trying to simulate a read request but I can't find {$this->names[$nameIndex]}. Please fix no 3"; // Return a message when no match is found
                                }
                            }
                        }
                    } else {
                        $found = false;
                        foreach ($response->json() as $key => $value) {
                            while ($value['name'] == $this->names[$nameIndex]) {
                                $this->mainName = $value['name'];
                                $this->mainId = $value['id'] ?? $value['_id'];
                                $found = true;
                            }
                            if (!$found) {
                                return "I'm trying to simulate a read request but I can't find {$this->names[$nameIndex]}. Please fix  No 1";
                            }
                        }
                    }
                }
            } else {
                if ($response->json()['name'] == $this->names[$nameIndex]) {
                    $this->mainId = $response->json()['id'] ?? $response->json()['_id'];
                    $this->mainName =  $response->json()['name'];
                } else {
                    return "I'm trying to simulate a read request but I can't find {$this->names[$nameIndex]}. Please fix no 2";
                }
            }
        };


        $urls = [request('text') . '/' . $this->mainId, request('text') . '/' . $this->names[$nameIndex]];


        try {

            foreach ($urls as $url) {
                $response = Http::timeout(20)->put($url, [
                    'name' => $this->dogs[$nameIndex],
                ]);
                if (in_array($response->status(), [200, 201])) {

                    $response = Http::timeout(20)->delete($url);
                    if (in_array($response->status(), [200, 201])) {

                        // add to slack 

                        $xcrudExcel = new XcrudExcel([
                            [request('user_name'), request('text'), 4, gmdate("l"), gmdate("Y-m-d H:i:s"), 'Yes']

                        ]);

                        Excel::store($xcrudExcel, 'passedStage3.csv');
                        // add their names to csv file

                        return "💃 Congrats, you made it to satge 3!";
                    }
                }
            }

            // if the update did not work
            if ($response->status() !== 200 || $response->status() !== 201) {
                if (is_array($response->json())) {
                    $furtherErrors =  implode(' ,', $response->json()) ?? '';

                    $eroor = $response->json()['error'];
                    $methodError = "";
                    if (Str::contains($eroor, ['method', "Method"])) {
                        $methodError = " Also, looks like you are not using the proper method for your update request";
                    }
                }
                if (isset($furtherErrors) && isset($methodError)) {
                    $furtherErrors ??= 'Further errors : ' . $furtherErrors;
                    $methodError ??=  'Further errors : ' . $methodError;

                    return "Your status for update is returning error {$response->status()} . {$furtherErrors}...Please fix. " . $methodError . '⚠️';
                }
                return "Your status for update is returning error {$response->status()}";
            }

            if ($response->object()->name !== $this->dogs[$nameIndex]) {

                return "After maing an update request, I can't find {$this->names[$nameIndex]}.  Please fixed up";
            };
            return $response->throw();
        } catch (RequestException $e) {
            return "Oops, {$e->response->body()}";
        }
    }

    /**
     * Display the specified resource.
     */
    public function downloadCsv()
    {
        return Storage::download('passedStage3.csv');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getCSVFile($cvfContents = null)
    {
        if ($cvfContents == null) {
            return  Excel::download($cvfContents, 'passedStage3.csv');
        }
        return  Excel::download($cvfContents, 'passedStage3.csv');
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
