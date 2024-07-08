<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Method_type;
class MethodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Method_type::create([
            'name' => 'POS',
            'status' => true,
        ]); 

        Method_type::create([
            'name' => 'YAPE',
            'status' => true
        ]); 

        Method_type::create([
            'name' => 'PLIN',
            'status' => true
        ]); 

        Method_type::create([
            'name' => 'EFECTIVO',
            'status' => true
        ]);  
    
    }
}
