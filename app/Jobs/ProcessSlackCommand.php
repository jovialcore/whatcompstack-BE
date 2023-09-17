<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Exports\XcrudExcel;
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
    public function handle(): void
{
    
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
