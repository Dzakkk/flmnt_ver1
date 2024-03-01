<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'John Doe',
                'password' => Hash::make('John'),
                'divisi' => 'operasional',
               
            ],
            [ 
                'name' => 'Syuaib',
                'password' => Hash::make('Syuaib'),
                'divisi' => 'produksi',
             
            ],
            [
                'name' => 'Kevin Muller',
                'password' => Hash::make('Kevin'),
                'divisi' => 'produksi',
              
            ],
            // Add more data here as needed
        ];

        // Insert the data into the "pegawai" table
        DB::table('users')->insert($data);
    
    }
}
