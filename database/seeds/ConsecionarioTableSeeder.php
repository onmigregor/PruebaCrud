<?php

use Illuminate\Database\Seeder;

class ConsecionarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \DB::table('concesionarios')->delete();
        
        \DB::table('concesionarios')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ciudadId' => 1,
                'nombre' => 'Av. Panteón',
                ),
            1 => 
            array (
            	
                'id' => 2,
                'ciudadId' => 1,
                'nombre' => 'La Floridad',
            ),
            2 => 
            array (
            	
                'id' => 3,
                'ciudadId' => 2,
                'nombre' => 'Las Delicias',
            ),
            3 => 
            array (
            	
                'id' => 4,
                'ciudadId' => 4,
                'nombre' => 'San Roman',
            ),
            4 => 
            array (
            	
                'id' => 5,
                'ciudadId' => 5,
                'nombre' => 'Plaza Toros',
            ),  
            5 => 
            array (
                
                'id' => 6,
                'ciudadId' => 3,
                'nombre' => 'Av. Las Industrias',
            )
        ));
    }
}
