<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(CompanyTableSeeder::class);
        $this->call(PlangSeeder::class);
        $this->call(FrameworkAndProgrammingLangSeeder::class);
        $this->call(DataSourceSeeder::class);
        $this->call(StackSeeder::class);
        $this->call(FrontendStackSeeder::class);
    }
}
