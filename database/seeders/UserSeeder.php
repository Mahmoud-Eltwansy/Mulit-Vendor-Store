<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Mahmoud Eltwansy',
            'email'=>'mahmoudtwansy1999@gmail.com',
            'password'=>Hash::make('password'),
            'phone_no'=>'01010101010'
        ]);
        DB::table('users')->insert([
            'name'=>'System Admin',
            'email'=>'sysadmin@gmail.com',
            'password'=>Hash::make('password'),
            'phone_no'=>'01010101011'
        ]);
    }
}
