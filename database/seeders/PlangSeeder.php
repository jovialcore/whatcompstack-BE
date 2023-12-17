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
            ['id' => 1, 'name' => 'PHP'],
            ['id' => 2, 'name' => 'Python'],
            ['id' => 3, 'name' => 'Ruby'],
            ['id' => 4, 'name' => 'Java'],
            ['id' => 5, 'name' => 'C#'],
            ['id' => 6, 'name' => 'Go'],
            ['id' => 7, 'name' => 'Rust'],
            ['id' => 8, 'name' => 'Node.js'],
            ['id' => 9, 'name' => 'Elixir'],
            ['id' => 10, 'name' => 'Perl'],
            ['id' => 11, 'name' => 'Haskell'],
            ['id' => 12, 'name' => 'Swift'],
            ['id' => 13, 'name' => 'Kotlin'],
            ['id' => 14, 'name' => 'Scala'],
            ['id' => 15, 'name' => 'Clojure'],
            ['id' => 16, 'name' => 'Erlang'],
            ['id' => 18, 'name' => 'Objective-C'],
            ['id' => 20, 'name' => 'R'],
            ['id' => 19, 'name' => 'Lua'],
            ['id' => 21, 'name' => 'Julia'],
            ['id' => 22, 'name' => '.NET'],
        ];

        foreach ($programmingLanguages as $language) {

            Plang::create($language);
        }
    }
}
