<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Role::create([

            'admin_role_title' => 'Super Admin',
            'admin_role_status' => 1,
            'admin_role_created_by' => 0,
            'admin_role_modified_by' => 0,
        ]);
        Role::create([

            'admin_role_title' => 'Admin',
            'admin_role_status' => 1,
            'admin_role_created_by' => 0,
            'admin_role_modified_by' => 0,
        ]);
        Role::create([

            'admin_role_title' => 'back office pengendalian',
            'admin_role_status' => 1,
            'admin_role_created_by' => 0,
            'admin_role_modified_by' => 0,
        ]);
        Role::create([

            'admin_role_title' => 'kepala seksi pengendalian',
            'admin_role_status' => 1,
            'admin_role_created_by' => 0,
            'admin_role_modified_by' => 0,
        ]);
        Role::create([

            'admin_role_title' => 'kepala bidang pengendalian',
            'admin_role_status' => 1,
            'admin_role_created_by' => 0,
            'admin_role_modified_by' => 0,
        ]);
    }
}
