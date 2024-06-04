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
            'name' => 'transferencia nacional',
            'status' => true,
        ]); 

        Method_type::create([
            'name' => 'transferencia internacional',
            'status' => true
        ]); 

        Method_type::create([
            'name' => 'zelle',
            'status' => true
        ]); 

        Method_type::create([
            'name' => 'pago movil',
            'status' => true
        ]); 

        Method_type::create([
            'name' => 'punto de venta',
            'status' => true
        ]); 

        Method_type::create([
            'name' => 'efectivo',
            'status' => true
        ]); 
    
    }
}
