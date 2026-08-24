<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\FeFramework;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeFrameworkCompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fe_framework_company')->delete();

        $map = [
            'PayStack'    => ['React.js', 'Vue.js'],
            'EdenLife'    => ['React.js', 'Vue.js'],
            'Chowdeck'    => ['React.js', 'Vue.js'],
            'FlutterWave' => ['Vue.js'],
        ];

        foreach ($map as $companyName => $feNames) {
            $company = Company::where('name', $companyName)->first();
            if (! $company) {
                continue;
            }

            foreach ($feNames as $feName) {
                $fe = FeFramework::where('name', $feName)->first();
                if (! $fe) {
                    continue;
                }

                $company->feFrameworks()->attach($fe->id, [
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
