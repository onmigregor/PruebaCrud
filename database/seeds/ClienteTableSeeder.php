<?php

use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
       \DB::table('clientes')->delete();
        
        \DB::table('clientes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'concesionarioId' => 2,
                'email' => 'onmigregor@gmail.com',
                'nombre' => 'Omar',
                'apellido' => 'Ramirez',
                'tipo_cedula' => 1,
                'cedula' => 16226227,

                ),
            2 => 
            array (
                'id' => 2,
                'concesionarioId' => 4,
                'email' => 'ariana@gmail.com',
                'nombre' => 'Ariana',
                'apellido' => 'Lopez',
                'tipo_cedula' => 1,
                'cedula' => 19339060,

                ),
            3 => 
            array (
                'id' => 3,
                'concesionarioId' => 1,
                'email' => 'miguel@gmail.com',
                'nombre' => 'Miguel',
                'apellido' => 'Angel',
                'tipo_cedula' => 1,
                'cedula' => 15774894,

              	),
           
        ));
    }
}
