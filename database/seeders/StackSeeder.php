<?php

namespace Database\Seeders;


use App\Models\Stack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stacks = [
            ['name' => 'backend'],
            ['name' => 'frontend'],
            ['name' => 'devops'],
            ['name' => 'product_design'],
        ];

        foreach ($stacks as $stack) {
            Stack::create($stack);
        }
    }
}
