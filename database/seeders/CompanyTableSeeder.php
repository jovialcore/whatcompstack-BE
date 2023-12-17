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
            'url' => "https://paystack.com/",
            'stack_be' => ['php', 'nodejs', 'java', 'rubyonrails'],
            'stack_fe' => ['React', 'Vuejs', 'svelte'],
            'devops' =>  ['azure', 'digitalOcean', 'heroku'],
            'database_driver' => ['mariadb'],
            'ceo' => 'Ox',
            'ceo_contact' => 'https://www.linkedin.com/in/cfezra/',
            'cto' => 'Odogwu Ox',
            'cto_contact' => 'https://www.linkedin.com/in/cfezra/',
            'hr' => 'Mrs chidinma',
            'testimonials' => NULL,
            'salary_range' => NULL,
            'source_slug' => 'paystack',
            'about' => "Paystack is a technology company solving payments problems for ambitious businesses. Our mission is to help businesses in Africa become profitable, envied, and loved.",
            'logo' => "https://res.cloudinary.com/chidiebere/image/upload/v1701677203/paystasss.png"

        ]);

        Company::create([
            'name' => 'EdenLife',
            'url' => "https://ouredenlife.com/",
            'stack_be' => ['php', 'nodejs', 'java', 'rubyonrails'],
            'stack_fe' => ['javascript', 'react', 'vuejs', 'svelte'],
            'devops' =>  ['azure', 'digitalOcean', 'heroku'],
            'database_driver' => ['mysql'],
            'ceo' => 'odogwu Machalla (unicode developer) ',
            'ceo_contact' => 'https://www.linkedin.com/in/prosperotemuyiwa',
            'cto' => 'Odogwu Machalla',
            'cto_contact' => 'https://www.linkedin.com/in/prosperotemuyiwa',
            'hr' => 'Mrs chidiadi',
            'testimonials' => NULL,
            'salary_range' => NULL,
            'source_slug' => NULL,
            'about' => "Excellent customer service, top-notch service providers, and easy-to-use technology. That's our recipe for brewing you a stress-free life.",
            'logo' => "https://media.licdn.com/dms/image/D4D0BAQH4h0bn8VqOww/company-logo_200_200/0/1699776218827/ouredenlife_logo?e=2147483647&v=beta&t=tfAPz6EqLwkpT3Km63udIJJPJcxA9qaPxEOg9MGXjM8"

        ]);


        Company::create([
            'name' => 'Chowdeck',
            'url' => "https://chowdeck.com/",
            'stack_be' => ['python', 'nodejs', 'java', 'rubyonrails'],
            'stack_fe' => ['javascript', 'react', 'vuejs', 'svelte'],
            'devops' => ['digitalOcean', 'heroku'],
            'database_driver' => ['sqlite'],
            'ceo' => 'Babafemi Aluko ',
            'ceo_contact' => 'https://www.linkedin.com/in/femialuko/',
            'cto' => 'Babafemi Aluko            ',
            'cto_contact' => 'https://www.linkedin.com/in/femialuko/',
            'hr' => 'Amaka',
            'hr_contact' => 'twitter.com/jovial_core',
            'testimonials' => NULL,
            'salary_range' => NULL,
            'source_slug' => 'chowdeck',
            "about" => "Chowdeck is a technology company that provides logistics services to both vendors and consumers. This potentially allows food vendors to deliver meals seamlessly while also providing consumers with an easy platform to order meals from their favourite restaurants in their city.",
            'logo' => "https://res.cloudinary.com/chidiebere/image/upload/v1701550675/chowdeck.png"

        ]);


        Company::create([
            'name' => 'FlutterWave',
            'url' => "https://www.flutterwave.com/",
            'stack_be' => ['java', 'rubyonrails'],
            'stack_fe' => ['vuejs', 'svelte'],
            'devops' => ['digitalOcean'],
            'database_driver' => ['mysql'],
            'ceo' => 'Olugbenga Agboola ',
            'ceo_contact' => 'https://www.linkedin.com/in/gbagboola',
            'cto' => 'Babafemi Aluko            ',
            'cto_contact' => NULL,
            'hr' => 'Victoria Vodunnu ',
            'hr_contact' => 'https://www.linkedin.com/in/victoria-vodunnu-2237757a/',
            'testimonials' => NULL,
            'salary_range' => NULL,
            'source_slug' => 'flutterwave',
            'about' => "Sell anything online without a website. Create a secure checkout page in a few clicks. Create a free account to generate secure payment links and get paid in any currency.",
            'logo' => "https://res.cloudinary.com/chidiebere/image/upload/v1701676999/flutterwaveee.png"


        ]);
    }
}
