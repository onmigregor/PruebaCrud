<?php

use Illuminate\Database\Seeder;

class StatusCodeSeeder extends Seeder
{
   
    public function run()
    {
        
        \DB::table('status_code')->delete();

        \DB::table('status_code')->insert(array (
            0 => 
            array (
                'codigo' => 200,
                'tipo' => 1,
                'mensaje' => 'Conexion establecida',
                ),
            1 => 
            array (
                
                'codigo' => 201,
                'tipo' => 1,
                'mensaje' => 'ha sido creado de manera exitosa',
            ),
            2 => 
            array (
                
                'codigo' => 202,
                'tipo' => 1,
                'mensaje' => 'ha sido modificado con exito',
            ),
            3 => 
            array (
                
                'codigo' => 203,
                'tipo' => 1,
                'mensaje' => 'ha sido borrado',
            ),

            4 => 
            array (
                
                'codigo' => 204,
                'tipo' => 0,
                'mensaje' => 'los siguientes validaciones han fallado',
            ),

            5 => 
            array (
                
                'codigo' => 205,
                'tipo' => 0,
                'mensaje' => 'No se ha encontrado',
            ),
        ));
    }
}
