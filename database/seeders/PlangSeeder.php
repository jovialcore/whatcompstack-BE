<?php

namespace Database\Seeders;

use App\Models\Plang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $programmingLanguages = [
            'PHP',
            'Python',
            'Ruby',
            'Java',
            'C#',
            'Go',
            'Rust',
            'Node.js',
            'Perl',
            'C++',
            'C',
            'Swift',
            'Kotlin',
            'Scala',
            'Haskell',
            'Erlang',
            'Groovy',
            'Objective-C',
            'Lua',
            'R',
            'Julia',
        ];

        foreach ($programmingLanguages as $language) {

            Plang::create(['name' => $language]);
        }
    }
}
