<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => '田中 太郎', 'email' => 'tanaka@example.com', 'password' => Hash::make('password')],
            ['name' => '木村 花子', 'email' => 'kimura@example.com', 'password' => Hash::make('password')],
            ['name' => '本橋 次郎', 'email' => 'motohashi@example.com', 'password' => Hash::make('password')],
            ['name' => '小川 三郎', 'email' => 'ogawa@example.com', 'password' => Hash::make('password')],
            ['name' => '加藤 美咲', 'email' => 'kato@example.com', 'password' => Hash::make('password')],
        ];

        DB::table('users')->insert($users);
    }
}
