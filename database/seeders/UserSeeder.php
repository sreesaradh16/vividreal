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
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' =>  Hash::make('123456')
            ],
            [
                'id' => 2,
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' =>  Hash::make('password')
            ]
        ];

        foreach ($users as $user) {
            $data =  User::find($user['id']);
            if ($data) {
                $data->name = $user['name'];
                $data->email = $user['email'];
                $data->password = $user['password'];
                $data->save();
            } else {
                $data = User::create($user);
            }
        }
    }
}
