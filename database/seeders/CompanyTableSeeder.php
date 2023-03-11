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
            'stack_be' => ['php', 'nodejs', 'java', 'rubyonrails'],
            'stack_fe' => ['javascript', 'react', 'vuejs', 'svelte'],
            'devops' =>  ['azure', 'digitalOcean', 'heroku'],
            'database_driver' => ['mariadb'],
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
            'stack_be' => ['php', 'nodejs', 'java', 'rubyonrails'],
            'stack_fe' => ['javascript', 'react', 'vuejs', 'svelte'],
            'devops' =>  ['azure', 'digitalOcean', 'heroku'],
            'database_driver' => ['mysql'],
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
            'stack_be' => ['python', 'nodejs', 'java', 'rubyonrails'],
            'stack_fe' => ['javascript', 'react', 'vuejs', 'svelte'],
            'devops' => ['digitalOcean', 'heroku'],
            'database_driver' => ['sqlite'],
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
            'stack_be' => [ 'java', 'rubyonrails'],
            'stack_fe' => [ 'vuejs', 'svelte'],
            'devops' =>['digitalOcean'],
            'database_driver' => ['mysql'],
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
