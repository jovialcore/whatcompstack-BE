<?php

namespace App\Http\Controllers;

use App\Exports\XcrudExcel;
use App\Jobs\ProcessSlackCommand;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
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
    public function store(Request $request)
    {

        // return response()->json('Please wait a sec');

        ProcessSlackCommand::dispatch();
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



    public function sendPassedMsg($message): void
    {
        Http::post(request('response_url'), [
            'json' => $this->oneLiner($message),
        ]);
    }

    protected function oneLiner(string $message): array
    {
        return [
            'response_type' => 'ephemeral',
            'blocks' => [
                [
                    'type' => 'section',
                    'text' => [
                        'emoji' => true,
                        'type' => 'plain_text',
                        'text' => $message,
                    ],
                ],
            ],
        ];
    }
}
