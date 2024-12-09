<?php

namespace Database\Seeders;

use App\Models\DataSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stacks = [
            ['name' => 'my-job-mag', 'url' =>  'https://www.myjobmag.com/jobs-at/'],
        ];

        foreach ($stacks as $stack) {
            DataSource::create($stack);
        }
    }
}
