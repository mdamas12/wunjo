<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::create([
            'name' => 'FISIOTERAPEUTA',
            'description' => '',
            'type' => 'area',
            'status' => true,
        ]);

        Position::create([
            'name' => 'ADMINITRADOR(A)',
            'description' => '',
            'type' => 'otro',
            'status' => true,
        ]);

        Position::create([
            'name' => 'LOGISTICA',
            'description' => '',
            'type' => 'otro',
            'status' => true,
        ]);


        Position::create([
            'name' => 'TERAPEUTA',
            'description' => '',
            'type' => 'area',
            'status' => true,
        ]);


    }
}
