<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment_method;
class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         /**
     * Run the database seeds.
     */

     Payment_method::create([
            'method_type_id' => '1',
            'name' => 'POS | MIRAFLORES',
            'titular' => '',
            'bank' => 'BANK PERU',
            'phone' => '',
            'identification' => '',
            'email' => '',
            'code' => '',
            'var_1' => '',
            'var_2' => '',
            'status' => true,  
        ]); 

        Payment_method::create([
            'method_type_id' => '1',
            'name' => 'POS | SURCO',
            'titular' => '',
            'bank' => 'BANK PERU',
            'phone' => '',
            'identification' => '',
            'email' => '',
            'code' => '',
            'var_1' => '',
            'var_2' => '',
            'status' => true,  
        ]); 

        Payment_method::create([
            'method_type_id' => '2',
            'name' => 'YAPE',
            'titular' => '',
            'bank' => '',
            'phone' => '921235019',
            'identification' => '',
            'email' => '',
            'code' => '',
            'var_1' => '',
            'var_2' => '',
            'status' => true,  
        ]); 

        Payment_method::create([
            'method_type_id' => '3',
            'name' => 'PLIN',
            'titular' => '',
            'bank' => '',
            'phone' => '921235019',
            'identification' => '',
            'email' => '',
            'code' => '',
            'var_1' => '',
            'var_2' => '',
            'status' => true,  
        ]); 

     
        Payment_method::create([
            'method_type_id' => '4',
            'name' => 'EFECTIVO',
            'titular' => '',
            'bank' => '',
            'phone' => '',
            'identification' => '',
            'email' => '',
            'code' => '',
            'var_1' => '',
            'var_2' => '',
            'status' => true,  
        ]); 

    
    }
    
}


