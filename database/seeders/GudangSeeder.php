<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_gudang' => '1',
                'nama_gudang' => 'GUDANG ALLERGEN',
               
            ],
            [ 
                'id_gudang' => '2',
                'nama_gudang' => 'GUDANG LIQUID',
             
            ],
            [
                'id_gudang' => '3',
                'nama_gudang' => 'GUDANG POWDER',
              
            ],
            [
                'id_gudang' => '4',
                'nama_gudang' => 'GUDANG RM',
               
            ],
            [ 
                'id_gudang' => '5',
                'nama_gudang' => 'GUDANG SAVORY',
             
            ],
            [
                'id_gudang' => '6',
                'nama_gudang' => 'LABORATORY',
              
            ],
            // Add more data here as needed
        ];

        // Insert the data into the "pegawai" table
        DB::table('gudang')->insert($data);
    }
}
