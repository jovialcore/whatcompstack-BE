<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Framework;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrameworkCompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('framework_company')->delete();

        $map = [
            'PayStack'    => ['Laravel', 'Express.js', 'Spring Boot', 'Ruby on Rails'],
            'EdenLife'    => ['Laravel', 'Express.js', 'Spring Boot', 'Ruby on Rails'],
            'Chowdeck'    => ['Django', 'Express.js', 'Spring Boot', 'Ruby on Rails'],
            'FlutterWave' => ['Spring Boot', 'Ruby on Rails'],
        ];

        foreach ($map as $companyName => $frameworkNames) {
            $company = Company::where('name', $companyName)->first();
            if (! $company) {
                continue;
            }

            foreach ($frameworkNames as $frameworkName) {
                $frameworkId = Framework::where('name', $frameworkName)->value('id');
                if (! $frameworkId) {
                    continue;
                }

                $company->frameworks()->attach($frameworkId, [
                    'rating'        => 5,
                    'draft_rating'  => null,
                    'is_draft'      => 0,
                    'is_published'  => 1,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }
    }
}
