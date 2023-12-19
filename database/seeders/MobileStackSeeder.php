<?php

namespace Database\Seeders;

use App\Models\Mobile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MobileStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages  = [
            "Swift",
            "Objective-C",
            "Java",
            "Kotlin",
            "React Native",
            "Dart",
            "Flutter"
        ];

        foreach ($languages  as $index => $language) {
            Mobile::Create([
                'id' => $index + 1,
                'name' => $language
            ]);
        }
    }
}
