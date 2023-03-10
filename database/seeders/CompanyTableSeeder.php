<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
   

        Company::create([
            'name' => 'PayStack',
            'stack_be' => ['1' => 'php', '2' => 'nodejs', '3'=>'java', '4' => 'rubyonrails'],
            'stack_fe' => ['1' => 'javascript', '2' => 'react', '3'=>'vuejs', '4' => 'svelte'],
            'devops' => ['1' => 'azure', '2' => 'digitalOcean', '3'=>'heroku'],
            'database_driver' => ['1' =>'mysql'],
            'ceo' => 'Ox',
            'ceo_contact' => 'linked.icom',
            'cto' => 'Odogwu Ox',
            'cto_contact' => 'linikedcom/cndnkd',
            'hr' => 'Mrs chidinma',
            'testimonials' => NULL,
            'salary_range' => NULL

        ]);

        Company::create([
            'name' => 'EdenLife',
            'stack_be' => ['1' => 'php', '2' => 'laravel', '3'=>'mobile',],
            'stack_fe' => ['1' => 'javascript', '2' => 'react', '3'=>'vuejs'],
            'devops' => ['1' => 'azure', '2' => 'digitalOcean', '3'=>'heroku',],
            'database_driver' => ['sqlite'],
            'ceo' => 'odogwu Machalla (unicode developer) ',
            'ceo_contact' => 'linked.icom/unicodedeveloper',
            'cto' => 'Odogwu Machalla',
            'cto_contact' => 'linikedcom/cndnkd',
            'hr' => 'Mrs chidiadi',
            'testimonials' => NULL,
            'salary_range' => NULL

        ]);


        Company::create([
            'name' => 'Chowdeck',
            'stack_be' => ['1' => 'php', '2' => 'laravel', '3'=>'mobile',],
            'stack_fe' => ['1' => 'javascript', '2' => 'react', '3'=>'vuejs'],
            'devops' => ['1' => 'azure', '2' => 'digitalOcean', '3'=>'heroku',],
            'database_driver' => ['mysql', 'sqliite'],
            'ceo' => 'Babafemi Aluko ',
            'ceo_contact' => 'linked.icom/unicodedeveloper',
            'cto' => 'Babafemi Aluko            ',
            'cto_contact' => 'linikedcom/makaka',
            'hr' => 'Amaka',
            'hr_contact' => 'https://twitter.com/amakamonee',
            'testimonials' => NULL,
            'salary_range' => NULL

        ]);


        Company::create([
            'name' => 'FlutterWave',
            'stack_be' => ['1' => 'nodejs', '2' => 'laravel', '3'=>'mobile',],
            'stack_fe' => ['1' => 'javascript', '2' => 'react', '3'=>'vuejs'],
            'devops' => ['1' => 'azure', '2' => 'digitalOcean', '3'=>'heroku',],
            'database_driver' => ['no_sql', 'mysql'],
            'ceo' => 'Olugbenga Agboola ',
            'ceo_contact' => 'https://www.linkedin.com/in/gbagboola',
            'cto' => 'Babafemi Aluko            ',
            'cto_contact' => 'linikedcom/makaka',
            'hr' => 'Victoria Vodunnu ',
            'hr_contact' => 'https://www.linkedin.com/in/victoria-vodunnu-2237757a/',
            'testimonials' => NULL,
            'salary_range' => NULL

        ]);
    }
}
