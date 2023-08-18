<?php

namespace Database\Seeders;

use App\Models\Framework;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrameworkAndProgrammingLangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $frameworks = [
            [
                'name' => 'Django',
                'plang_id' => 2, // Python
            ],
            [
                'name' => 'Flask',
                'plang_id' => 2, // Python
            ],
            [
                'name' => 'Falcon',
                'plang_id' => 2, // Python
            ],
            [
                'name' => 'Pyramid',
                'plang_id' => 2, // Python
            ],
            [
                'name' => 'Bottle',
                'plang_id' => 2, // Python
            ],
            [
                'name' => 'CherryPy',
                'plang_id' => 2, // Python
            ],
            [
                'name' => 'TurboGears',
                'plang_id' => 2, // Python
            ],
            [
                'name' => 'Web2Py',
                'plang_id' => 2, // Python
            ],
            [
                'name' => 'Tornado',
                'plang_id' => 2, // Python
            ],
            [
                'name' => 'Nginx',
                'plang_id' => 2, // Python
            ],
            [
                'name' => 'Express.js',
                'plang_id' => 8, // Node.js
            ],
            [
                'name' => 'Nest.js',
                'plang_id' => 8, // Node.js
            ],
            [
                'name' => 'Hapi.js',
                'plang_id' => 8, // Node.js
            ],
            [
                'name' => 'Koa.js',
                'plang_id' => 8, // Node.js
            ],
            [
                'name' => 'Sails.js',
                'plang_id' => 8, // Node.js
            ],
            [
                'name' => 'Meteor.js',
                'plang_id' => 8, // Node.js
            ],
            [
                'name' => 'Adonis.js',
                'plang_id' => 8, // Node.js
            ],
            [
                'name' => 'Spring Boot',
                'plang_id' => 4, // Java
            ],
            [
                'name' => 'Apache Struts',
                'plang_id' => 4, // Java
            ],
            [
                'name' => 'Play Framework',
                'plang_id' => 4, // Java
            ],
            [
                'name' => 'Grails',
                'plang_id' => 4, // Java
            ],
            [
                'name' => 'Dropwizard',
                'plang_id' => 4, // Java
            ],
            [
                'name' => 'JavaServer Faces (JSF)',
                'plang_id' => 4, // Java
            ],
            [
                'name' => 'Vert.x',
                'plang_id' => 4, // Java
            ],
            [
                'name' => 'Apache Wicket',
                'plang_id' => 4, // Java
            ],
            [
                'name' => 'Apache Tapestry',
                'plang_id' => 4, // Java
            ],
            [
                'name' => 'Spark',
                'plang_id' => 4, // Java
            ],
            [
                'name' => 'JHipster',
                'plang_id' => 4, // Java
            ],
            [
                'name' => 'Ruby on Rails',
                'plang_id' => 3, // Ruby
            ],
            [
                'name' => 'Sinatra',
                'plang_id' => 3, // Ruby
            ],
            [
                'name' => 'Hanami',
                'plang_id' => 3, // Ruby
            ],
            [
                'name' => 'Cuba',
                'plang_id' => 3, // Ruby
            ],
            [
                'name' => 'Ramaze',
                'plang_id' => 3, // Ruby
            ],
            [
                'name' => 'Volt',
                'plang_id' => 3, // Ruby
            ],
            [
                'name' => 'Roda',
                'plang_id' => 3, // Ruby
            ],
            [
                'name' => 'Trailblazer',
                'plang_id' => 3, // Ruby
            ],
            [
                'name' => 'Laravel',
                'plang_id' => 1, // PHP
            ],
            [
                'name' => 'Symfony',
                'plang_id' => 1, // PHP
            ],
            [
                'name' => 'CodeIgniter',
                'plang_id' => 1, // PHP
            ],
            [
                'name' => 'Yii',
                'plang_id' => 1, // PHP
            ],
            [
                'name' => 'Zend Framework',
                'plang_id' => 1, // PHP
            ],
            [
                'name' => 'Phalcon',
                'plang_id' => 1, // PHP
            ],
            [
                'name' => 'CakePHP',
                'plang_id' => 1, // PHP
            ],
            [
                'name' => 'FuelPHP',
                'plang_id' => 1, // PHP
            ],
            [
                'name' => 'Slim',
                'plang_id' => 1, // PHP
            ],
            [
                'name' => 'Lumen',
                'plang_id' => 1, // PHP
            ],
            [
                'name' => 'Gin',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Echo',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Revel',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Buffalo',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Fiber',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Martini',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Beego',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Goji',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Kemal',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Gorilla',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'ASP.NET',
                'plang_id' => 5, // C#
            ],
            [
                'name' => '.NET Core',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'Nancy',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'ServiceStack',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'Akka.NET',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'Simple.Web',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'Orchard Core',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'MVC Framework',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'Web API',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'Rocket',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Actix',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Warp',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Tide',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Nickel',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Iron',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Gotham',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Rocket Framework',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Thruster',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Phoenix',
                'plang_id' => 9, // Elixir
            ],
            [
                'name' => 'Nerves',
                'plang_id' => 9, // Elixir
            ],
            [
                'name' => 'Sugar',
                'plang_id' => 9, // Elixir
            ],
            [
                'name' => 'Rocket',
                'plang_id' => 9, // Elixir
            ],
            [
                'name' => 'Maru',
                'plang_id' => 9, // Elixir
            ],
            [
                'name' => 'Cavalry',
                'plang_id' => 9, // Elixir
            ],
            [
                'name' => 'Raxx',
                'plang_id' => 9, // Elixir
            ],
            [
                'name' => 'Ktor',
                'plang_id' => 13, // Kotlin
            ],
            [
                'name' => 'Spring Boot',
                'plang_id' => 13, // Kotlin
            ],
            [
                'name' => 'Micronaut',
                'plang_id' => 13, // Kotlin
            ],
            [
                'name' => 'Vert.x',
                'plang_id' => 13, // Kotlin
            ],
            [
                'name' => 'Jooby',
                'plang_id' => 13, // Kotlin
            ],
            [
                'name' => 'Javalin',
                'plang_id' => 13, // Kotlin
            ],
            [
                'name' => 'Http4k',
                'plang_id' => 13, // Kotlin
            ],
            [
                'name' => 'Kara',
                'plang_id' => 13, // Kotlin
            ],
            [
                'name' => 'Quarkus',
                'plang_id' => 14, // Scala
            ],
            [
                'name' => 'Play Framework',
                'plang_id' => 14, // Scala
            ],
    
            [
                'name' => 'Scalatra',
                'plang_id' => 14, // Scala
            ],
        
            [
                'name' => 'Skinny',
                'plang_id' => 14, // Scala
            ],
            [
                'name' => 'Slick',
                'plang_id' => 14, // Scala
            ],
            [
                'name' => 'Akka HTTP',
                'plang_id' => 14, // Scala
            ],
            [
                'name' => 'http4s',
                'plang_id' => 14, // Scala
            ],
            [
                'name' => 'Vapor',
                'plang_id' => 12, // Swift
            ],
            [
                'name' => 'Perfect',
                'plang_id' => 12, // Swift
            ],
            [
                'name' => 'Kitura',
                'plang_id' => 12, // Swift
            ],
            [
                'name' => 'Zewo',
                'plang_id' => 12, // Swift
            ],
            [
                'name' => 'GCDWebServer',
                'plang_id' => 12, // Swift
            ],
            [
                'name' => 'Blackfish',
                'plang_id' => 12, // Swift
            ],
            [
                'name' => 'Swifter',
                'plang_id' => 12, // Swift
            ],
            [
                'name' => 'Noze.io',
                'plang_id' => 12, // Swift
            ],
      
            [
                'name' => 'Lift',
                'plang_id' => 14, // Scala
            ],
            [
                'name' => 'Finatra',
                'plang_id' => 14, // Scala
            ],

    
            [
                'name' => 'Sangria',
                'plang_id' => 14, // Scala
            ],
            [
                'name' => 'Genie',
                'plang_id' => 21, // Julia
            ],
            [
                'name' => 'HTTP.jl',
                'plang_id' => 21, // Julia
            ],
            [
                'name' => 'Mux.jl',
                'plang_id' => 21, // Julia
            ],
            [
                'name' => 'Franklin.jl',
                'plang_id' => 21, // Julia
            ],
            [
                'name' => 'Julienned',
                'plang_id' => 21, // Julia
            ],
            [
                'name' => 'Escher',
                'plang_id' => 21, // Julia
            ],
            [
                'name' => 'WebIO',
                'plang_id' => 21, // Julia
            ],
            [
                'name' => 'Architect',
                'plang_id' => 21, // Julia
            ],
            [
                'name' => 'Mojolicious',
                'plang_id' => 9, // Perl
            ],
            [
                'name' => 'Dancer',
                'plang_id' => 9, // Perl
            ],
            [
                'name' => 'Catalyst',
                'plang_id' => 9, // Perl
            ],
            [
                'name' => 'Plack',
                'plang_id' => 9, // Perl
            ],
            [
                'name' => 'WebPerl',
                'plang_id' => 9, // Perl
            ],
            [
                'name' => 'Apache::ASP',
                'plang_id' => 9, // Perl
            ],
            [
                'name' => 'Shiny',
                'plang_id' => 20, // R
            ],
            [
                'name' => 'Plumber',
                'plang_id' => 20, // R
            ],
            [
                'name' => 'httpuv',
                'plang_id' => 20, // R
            ],
            [
                'name' => 'opencpu',
                'plang_id' => 20, // R
            ],
            [
                'name' => 'RestRserve',
                'plang_id' => 20, // R
            ],
            [
                'name' => 'FastRWeb',
                'plang_id' => 20, // R
            ],
            [
                'name' => 'rApache',
                'plang_id' => 20, // R
            ],
            [
                'name' => 'Rook',
                'plang_id' => 20, // R
            ],
            [
                'name' => 'Lapis',
                'plang_id' => 19, // Lua
            ],
            [
                'name' => 'OpenResty',
                'plang_id' => 19, // Lua
            ],
            [
                'name' => 'Mercury',
                'plang_id' => 19, // Lua
            ],
            [
                'name' => 'WSAPI',
                'plang_id' => 19, // Lua
            ],
            [
                'name' => 'Turbo.lua',
                'plang_id' => 19, // Lua
            ],
            [
                'name' => 'Orbit',
                'plang_id' => 19, // Lua
            ],
            [
                'name' => 'CGILua',
                'plang_id' => 19, // Lua
            ],
            [
                'name' => 'Nginx',
                'plang_id' => 19, // Lua
            ],
            [
                'name' => 'Luminus',
                'plang_id' => 15, // Clojure
            ],
            [
                'name' => 'Ring',
                'plang_id' => 15, // Clojure
            ],
            [
                'name' => 'Duct',
                'plang_id' => 15, // Clojure
            ],
            [
                'name' => 'Compojure',
                'plang_id' => 15, // Clojure
            ],
            [
                'name' => 'Pedestal',
                'plang_id' => 15, // Clojure
            ],
            [
                'name' => 'Buddy',
                'plang_id' => 15, // Clojure
            ],
            [
                'name' => 'Immutant',
                'plang_id' => 15, // Clojure
            ],
            [
                'name' => 'Gin',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Echo',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Revel',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Buffalo',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Fiber',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Martini',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Beego',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Goji',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Kemal',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'Gorilla',
                'plang_id' => 6, // Go
            ],
            [
                'name' => 'ASP.NET',
                'plang_id' => 5, // C#
            ],
            [
                'name' => '.NET Core',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'Nancy',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'ServiceStack',
                'plang_id' => 5, // C#
            ],
     
            [
                'name' => 'Simple.Web',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'Orchard Core',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'MVC Framework',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'Web API',
                'plang_id' => 5, // C#
            ],
            [
                'name' => 'Rocket',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Actix',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Warp',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Tide',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Nickel',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Iron',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Gotham',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Rocket Framework',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Thruster',
                'plang_id' => 7, // Rust
            ],
            [
                'name' => 'Phoenix',
                'plang_id' => 17, // Elixir
            ],
            [
                'name' => 'Nerves',
                'plang_id' => 17, // Elixir
            ],
            [
                'name' => 'Sugar',
                'plang_id' => 17, // Elixir
            ],
            [
                'name' => 'Rocket',
                'plang_id' => 17, // Elixir
            ],
            [
                'name' => 'Maru',
                'plang_id' => 17, // Elixir
            ],
            [
                'name' => 'Cavalry',
                'plang_id' => 17, // Elixir
            ],
            [
                'name' => 'Plug',
                'plang_id' => 17, // Elixir
            ],
            [
                'name' => 'Phoenix LiveView',
                'plang_id' => 17, // Elixir
            ],
            [
                'name' => 'Snap',
                'plang_id' => 11, // Haskell
            ],
            [
                'name' => 'Yesod',
                'plang_id' => 11, // Haskell
            ],
            [
                'name' => 'Scotty',
                'plang_id' => 11, // Haskell
            ],
            [
                'name' => 'Spock',
                'plang_id' => 11, // Haskell
            ],
            [
                'name' => 'Happstack',
                'plang_id' => 11, // Haskell
            ],
            [
                'name' => 'Wai',
                'plang_id' => 11, // Haskell
            ],
            [
                'name' => 'Servant',
                'plang_id' => 11, // Haskell
            ],
            [
                'name' => 'Snap Framework',
                'plang_id' => 11, // Haskell
            ],
            [
                'name' => 'Qt',
                'plang_id' => 10, // C++
            ],
            [
                'name' => 'Boost',
                'plang_id' => 10, // C++
            ],
            [
                'name' => 'POCO',
                'plang_id' => 10, // C++
            ],
            [
                'name' => 'Cinder',
                'plang_id' => 10, // C++
            ],
            [
                'name' => 'Wt',
                'plang_id' => 10, // C++
            ],
            [
                'name' => 'CppCMS',
                'plang_id' => 10, // C++
            ],
            [
                'name' => 'Tufão',
                'plang_id' => 10, // C++
            ],
            [
                'name' => 'TreeFrog',
                'plang_id' => 10, // C++
            ],
            [
                'name' => 'CppRESTSDK',
                'plang_id' => 10, // C++
            ],
            [
                'name' => 'Pistache',
                'plang_id' => 10, // C++
            ],

            // Erlang Frameworks
            [
                'name' => 'Elixir',
                'plang_id' => 16, // Erlang
            ],
            [
                'name' => 'Chicago Boss',
                'plang_id' => 16, // Erlang
            ],
            [
                'name' => 'N2O',
                'plang_id' => 16, // Erlang
            ],
            [
                'name' => 'MochiWeb',
                'plang_id' => 16, // Erlang
            ],
            [
                'name' => 'Yaws',
                'plang_id' => 16, // Erlang
            ],
            [
                'name' => 'Cowboy',
                'plang_id' => 16, // Erlang
            ],
            [
                'name' => 'Nitrogen',
                'plang_id' => 16, // Erlang
            ],
            [
                'name' => 'Zotonic',
                'plang_id' => 16, // Erlang
            ],
            [
                'name' => 'ErlyWeb',
                'plang_id' => 16, // Erlang
            ],
            [
                'name' => 'ErlyDTL',
                'plang_id' => 16, // Erlang
            ],

            // Objective-C Frameworks
            [
                'name' => 'Cocoa',
                'plang_id' => 18, // Objective-C
            ],
            [
                'name' => 'Cocoa Touch',
                'plang_id' => 18, // Objective-C
            ],
            [
                'name' => 'OpenStep',
                'plang_id' => 18, // Objective-C
            ],
            [
                'name' => 'GNUstep',
                'plang_id' => 18, // Objective-C
            ],
            [
                'name' => 'Spike',
                'plang_id' => 18, // Objective-C
            ],
            [
                'name' => 'Nu',
                'plang_id' => 18, // Objective-C
            ],
            [
                'name' => 'Chameleon',
                'plang_id' => 18, // Objective-C
            ],
            [
                'name' => 'Cappuccino',
                'plang_id' => 18, // Objective-C
            ],
            [
                'name' => 'WebObjects',
                'plang_id' => 18, // Objective-C
            ],
            [
                'name' => 'ObjFW',
                'plang_id' => 18, // Objective-C
            ],
        ];
        foreach ($frameworks as $value) {
            
            Framework::create($value);
        }
    }
}
