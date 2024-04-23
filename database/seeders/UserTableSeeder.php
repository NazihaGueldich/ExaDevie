<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        //admin
        User::create([
            'name'=>'ExaDev',
            'email' => 'exadev@exadev.com',
            'password' => Hash::make('12345678'),
            'role'=>0,
        ]);
    }
}
