<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Mobile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MobileCompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mobile_company')->delete();

        $map = [
            'PayStack'    => ['Swift', 'Kotlin'],
            'EdenLife'    => ['React Native'],
            'Chowdeck'    => ['Flutter'],
            'FlutterWave' => ['Swift', 'Kotlin', 'Flutter'],
        ];

        foreach ($map as $companyName => $mobileNames) {
            $company = Company::where('name', $companyName)->first();
            if (! $company) {
                continue;
            }

            foreach ($mobileNames as $mobileName) {
                $mobile = Mobile::where('name', $mobileName)->first();
                if (! $mobile) {
                    continue;
                }

                $company->mobilePlangs()->attach($mobile->id, [
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
