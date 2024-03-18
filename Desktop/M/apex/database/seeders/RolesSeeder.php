<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'marketer',
            'admin',
        ];


        foreach ($roles as $id => $role) {
            
            DB::table('roles')->insert(
                [
                    'id' => ++$id,
                    'role' => $role,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
