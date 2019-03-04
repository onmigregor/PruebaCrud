<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CiudadTableSeeder::class);
        $this->call(ConsecionarioTableSeeder::class);
        //$this->call(ClienteTableSeeder::class);
        $this->call(StatusCodeSeeder::class);
    }
}
