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
            'titular' => 'Edgardy Madrid',
            'bank' => 'Banesco',
            'phone' => '04249497858',
            'identification' => 'V23357789',
            'email' => 'edgardymadrid@gmail.com',
            'code' => '0134254698746565',
            'var_1' => '',
            'var_2' => '',
            'status' => true,  
        ]); 

        Payment_method::create([
            'method_type_id' => '1',
            'titular' => 'Manantial de bienestar',
            'bank' => 'Pichincha',
            'phone' => '04249497858',
            'identification' => 'J23357789',
            'email' => 'edgardymadrid@gmail.com',
            'code' => '013425469832423456',
            'var_1' => '',
            'var_2' => '',
            'status' => true,  
        ]); 

        Payment_method::create([
            'method_type_id' => '2',
            'titular' => 'Rafael Rodriguez',
            'bank' => 'BOFA',
            'phone' => '04249497858',
            'identification' => 'v23357789',
            'email' => 'edgardymadrid@gmail.com',
            'code' => '856546983',
            'var_1' => '125546',
            'var_2' => '',
            'status' => true,  
        ]); 

        Payment_method::create([
            'method_type_id' => '3',
            'titular' => 'Manantmial',
            'bank' => 'BOFA',
            'phone' => '04249497858',
            'identification' => 'v23357789',
            'email' => 'edgardymadrid@gmail.com',
            'code' => '',
            'var_1' => '',
            'var_2' => '',
            'status' => true,  
        ]); 

        Payment_method::create([
            'method_type_id' => '4',
            'titular' => 'Rafael Rodriguez',
            'bank' => 'Banco Nacional',
            'phone' => '0414789952',
            'identification' => 'v23357789',
            'email' => 'manantialperu@gmail.com',
            'code' => '',
            'var_1' => '',
            'var_2' => '',
            'status' => true,  
        ]); 

        Payment_method::create([
            'method_type_id' => '5',
            'titular' => 'Manantial de Bienestar',
            'bank' => 'Banco Nacional',
            'phone' => '0414789952',
            'identification' => 'J23357789',
            'email' => 'manantialperu@gmail.com',
            'code' => '',
            'var_1' => '',
            'var_2' => '',
            'status' => true,  
        ]); 

        Payment_method::create([
            'method_type_id' => '5',
            'titular' => 'Manantial de Bienestar',
            'bank' => 'Pichincha',
            'phone' => '0414789952',
            'identification' => 'J23357789',
            'email' => 'manantialperu@gmail.com',
            'code' => '',
            'var_1' => '',
            'var_2' => '',
            'status' => true,  
        ]); 

        Payment_method::create([
            'method_type_id' => '5',
            'titular' => 'Manantial de Bienestar',
            'bank' => 'Lima Bank',
            'phone' => '0414789952',
            'identification' => 'J23357789',
            'email' => 'manantialperu@gmail.com',
            'code' => '',
            'var_1' => '',
            'var_2' => '',
            'status' => true,  
        ]); 

        Payment_method::create([
            'method_type_id' => '6',
            'titular' => 'Manantial de Bienestar',
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


