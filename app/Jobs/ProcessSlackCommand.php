<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Exports\XcrudExcel;
use AWS\CRT\HTTP\Response;
use Illuminate\Http\Client\RequestException;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Str;

class ProcessSlackCommand implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
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
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        $r = request('response_url');
        return response()->json($r);
        $nameIndex = array_rand($this->names);
        try {
            $response = Http::async()->post(request('text'), [
                'name' => $this->names[$nameIndex]
            ])->wait();
        } catch (RequestException $e) {
            $message =  "Oops, {$e->response->body()}";

            $this->sendPassedMsg($message);
        }
        $name = $this->names[$nameIndex];

        if (!in_array($response->status(), [200, 201])) {
            $message = "Your status for post request, your endpoint  is returning error {$response->status()}. It maybe a sleepy server issue..if so, keep retrying, if not, check Your end point well! ";

            $this->sendPassedMsg($message);
        }
        $id = null;
        if (!isset($response->object()->name)) {
            //e.g https://crud-person.onrender.com/api
            $response = Http::async()->get(request('text'))->wait();
            if (!empty($response->json()['data'])) {
                collect($response->json()['data'])->each(function ($item) use ($name, &$id) {
                    if ($item['name'] !== $name) {

                        $id = $item['id'] ?? $item['_id'];

                        $message = "I can't find the name like {$name} when I make a post request. Please fixed up";

                        $this->sendPassedMsg($message);
                    };
                });
            }
        } else {
            if ($response->object()->name !== $this->names[$nameIndex]) {

                $message = "I can't find a name like {$this->names[$nameIndex]} when I make a post request. Please fixed up";

                $this->sendPassedMsg($message);
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
                                    $message = "I'm trying to simulate a read request but I can't find {$this->names[$nameIndex]}. Please fix no 3"; // Return a message when no match is found


                                    $this->sendPassedMsg($message);
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
                                $message = "I'm trying to simulate a read request but I can't find {$this->names[$nameIndex]}. Please fix  No 1";

                                $this->sendPassedMsg($message);
                            }
                        }
                    }
                }
            } else {
                if ($response->json()['name'] == $this->names[$nameIndex]) {
                    $this->mainId = $response->json()['id'] ?? $response->json()['_id'];
                    $this->mainName =  $response->json()['name'];
                } else {
                    $message = "I'm trying to simulate a read request but I can't find {$this->names[$nameIndex]}. Please fix no 2";

                    $this->sendPassedMsg($message);
                }
            }
        };


        $urls = [request('text') . '/' . $this->mainId, request('text') . '/' . $this->names[$nameIndex]];


        try {

            foreach ($urls as $url) {
                $response = Http::async()->put($url, [
                    'name' => $this->dogs[$nameIndex],
                ])->wait();
                if (in_array($response->status(), [200, 201])) {

                    $response = Http::async()->delete($url)->wait();
                    if (in_array($response->status(), [200, 201])) {

                        // add to slack 


                        // add to stage 3 slack 


                        $token = env('SLACK_TOKEN');
                        $payload = [
                            'channel' => 'C05RUCJKEUS',
                            'users' => request('user_id'),
                        ];
                        $slackRes = Http::async()->withToken($token)->post('https://slack.com/api/conversations.invite', $payload)->wait();
                        // dd($slackRes);
                        if ($slackRes->successful()) {

                            if (array_key_exists('error', $slackRes->json())) {
                                $message = "💃 Congrats, you made it to satge 3!  but could not be added to the channel. Due to this error: {$slackRes->json()['error']}";

                                $xcrudExcel = new XcrudExcel([
                                    [request('user_name'), request('text'), 4, gmdate("l"), gmdate("Y-m-d H:i:s"), 'No']

                                ]);

                                // add their names to csv file
                                Excel::store($xcrudExcel, 'passedStage3.csv');

                                $this->sendPassedMsg($message);
                            }

                            $xcrudExcel = new XcrudExcel([
                                [request('user_name'), request('text'), 4, gmdate("l"), gmdate("Y-m-d H:i:s"), 'Yes']

                            ]);

                            // add their names to csv file
                            Excel::store($xcrudExcel, 'passedStage3.csv');
                            $message = "💃 Congrats, you made it to satge 3!";
                            $this->sendPassedMsg($message);
                        } else {
                            $message =  'Error: ';
                            $this->sendPassedMsg($message);
                        }
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

                    $message =  "Your status for update is returning error {$response->status()} . {$furtherErrors}...Please fix. " . $methodError . '⚠️';

                    $this->sendPassedMsg($message);
                }
                $message = "Your status for update is returning error {$response->status()}";

                $this->sendPassedMsg($message);
            }
        } catch (RequestException $e) {
            $message = "Oops, {$e->response->body()}";

            $this->sendPassedMsg($message);
        }
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
