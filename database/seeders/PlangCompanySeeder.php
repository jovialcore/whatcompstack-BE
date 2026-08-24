<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Plang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlangCompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plang_company')->delete();

        $map = [
            'PayStack'    => ['PHP', 'Node.js', 'Java', 'Ruby'],
            'EdenLife'    => ['PHP', 'Node.js', 'Java', 'Ruby'],
            'Chowdeck'    => ['Python', 'Node.js', 'Java', 'Ruby'],
            'FlutterWave' => ['Java', 'Ruby'],
        ];

        foreach ($map as $companyName => $plangNames) {
            $company = Company::where('name', $companyName)->first();
            if (! $company) {
                continue;
            }

            foreach ($plangNames as $plangName) {
                $plang = Plang::where('name', $plangName)->first();
                if (! $plang) {
                    continue;
                }

                $company->plangs()->attach($plang->id, [
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
