<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //   $table->id();
    //         $table->unsignedBigInteger('role_id');
    //         $table->string('username');
    //         $table->string('firstname');
    //         $table->string('lastname');
    //         $table->string('mobile_no');
    //         $table->string('image')->nullable(true);
    //         $table->tinyInteger('is_verify')->nullable(false)->default(1);
    //         $table->tinyInteger('is_admin')->nullable(false)->default(1);
    //         $table->tinyInteger('is_active')->nullable(false)->default(0);
    //         $table->tinyInteger('is_supper')->nullable(false)->default(0);
    //         $table->string('last_ip')->nullable(true);
    //         $table->string('email')->unique();
    //         $table->timestamp('email_verified_at')->nullable();
    //         $table->string('password');

    public function run(): void
    {
        User::create([
            'role_id' => 2,
            'username' => 'admin',
            'firstname' => 'jaja',
            'lastname' => 'van',
            'email' => 'jajavanjava@gmail.com',
            'mobile_no' => '12345',
            'password' => bcrypt('securepassword'),
            'is_verify' => 1,
            'is_admin' => 1,
            'is_active' => 1,
            'is_supper' => 0,
        ]);
        User::create([
            'role_id' => 1,
            'username' => 'superadmin',
            'firstname' => 'jani',
            'lastname' => 'suhanda',
            'email' => 'janisuhanda@gmail.com',
            'mobile_no' => '081316704932',
            'password' => bcrypt('securepassword'),
            'is_verify' => 1,
            'is_admin' => 1,
            'is_active' => 1,
            'is_supper' => 1,
        ]);
        User::create([
            'role_id' => 3,
            'username' => 'bopengendalian',
            'firstname' => 'bo',
            'lastname' => 'pengadilan',
            'email' => 'bo@gmail.com',
            'mobile_no' => '123',
            'password' => bcrypt('securepassword'),
            'is_verify' => 1,
            'is_admin' => 1,
            'is_active' => 1,
            'is_supper' => 0,
        ]);
        User::create([
            'role_id' => 4,
            'username' => 'kasipengendalian',
            'firstname' => 'kepala',
            'lastname' => 'seksi',
            'email' => 'kasi@gmail.com',
            'mobile_no' => '123',
            'password' => bcrypt('securepassword'),
            'is_verify' => 1,
            'is_admin' => 1,
            'is_active' => 1,
            'is_supper' => 0,
        ]);
        User::create([
            'role_id' => 5,
            'username' => 'kabidpengendalian',
            'firstname' => 'Kepala',
            'lastname' => 'bidang',
            'email' => 'kabid@gmail.com',
            'mobile_no' => '123',
            'password' => bcrypt('securepassword'),
            'is_verify' => 1,
            'is_admin' => 1,
            'is_active' => 1,
            'is_supper' => 0,
        ]);
    }
}
