<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete();

        User::updateOrCreate(
            ['email' => 'chidiebere@email.com'],
            [
                'name' => 'Chidiebere Chukwudi',
                'role' => 'admin',
                'password' => Hash::make('mysecret'),
            ]
        );
    }
}
