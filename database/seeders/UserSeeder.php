<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'mario',
                'email' => 'mario@abv.bg',
                'password' => Hash::make('1'),
                'role_id' => 1
            ],
            [
                'name' => 'rumen',
                'email' => 'rumen@yahoo.com',
                'password' => Hash::make('1'),
                'role_id' => 2
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
