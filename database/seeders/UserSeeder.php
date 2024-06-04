<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $supradmin =   User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
 
        ]);
      $supradmin->assignRole('supradmin');

      $administrator =   User::create([
            'name' => 'mdamas',
            'email' => 'marcosdamas12@gmail.com',
            'password' => Hash::make('123456')
 
        ]);

      $administrator->assignRole('administrator');
    }
}
