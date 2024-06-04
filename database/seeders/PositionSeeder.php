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
            'name' => 'fisioterapeuta',
            'description' => '',
            'type' => 'area',
            'status' => true,
        ]);

        Position::create([
            'name' => 'adminitracion',
            'description' => '',
            'type' => 'otro',
            'status' => true,
        ]);

        Position::create([
            'name' => 'logistica',
            'description' => '',
            'type' => 'otro',
            'status' => true,
        ]);

        Position::create([
            'name' => 'cosmeatra',
            'description' => '',
            'type' => 'area',
            'status' => true,
        ]);

        Position::create([
            'name' => 'terapeuta',
            'description' => '',
            'type' => 'area',
            'status' => true,
        ]);


    }
}
