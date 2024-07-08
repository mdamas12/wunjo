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
  
      $administrator =   User::create([
            'name' => 'Marcos Damas',
            'email' => 'marcosdamas12@gmail.com',
            'password' => Hash::make('Nomadas-12')
 
        ]);

      $administrator->assignRole('supra');
    }
}
