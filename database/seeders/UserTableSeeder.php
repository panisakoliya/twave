<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'role' => 'admin'
            ],
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'role' => 'user'
            ]
        ];

        foreach ($users as $user) {
            $saveUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt(123456),
                'email_verified_at' => Carbon::now(),
            ]);

            $saveUser->assignRole($user['role']);
        }
    }
}
