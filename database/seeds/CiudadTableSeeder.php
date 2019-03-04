<?php

use Illuminate\Database\Seeder;

class CiudadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ciudades')->delete();
        
        \DB::table('ciudades')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ciudad' => 'Caracas',
                ),
            1 => 
            array (
            	
                'id' => 2,
                'ciudad' => 'Maracaibo',
            ),
            2 => 
            array (
            	
                'id' => 3,
                'ciudad' => 'Valencia',
            ),
            3 => 
            array (
            	
                'id' => 4,
                'ciudad' => 'Barquisimeto',
            ),
            4 => 
            array (
            	
                'id' => 5,
                'ciudad' => 'San Cristobal',
            )
        ));
    }
}
