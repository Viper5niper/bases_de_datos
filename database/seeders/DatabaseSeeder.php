<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       /*
         DB::table('configs')->insert([
            'name' => 'dias_cercanos',
            'label' => 'N# de dias cercanos para contar registros (5-15)',
            'value' => '7',
        ]);

        DB::table('configs')->insert([
            'name' => 'dias_lejanos',
            'label' => 'N# de dias lejanos para contar registros (30-90)',
            'value' => '30',
        ]);

        DB::table('configs')->insert([
            'name' => 'dias_contacto_cliente',
            'label' => 'dias de anticipo para contactar a los clientes (2-10)',
            'value' => '7',
        ]);

        User::create([
            'name' => 'admin de sistemas',
            'email' => 'administrador@vuelos.com.sv',
            'password' => Hash::make('adminvuelos2022'),
        ]);
        */

        \App\Models\Vuelo::factory(100)->create();
    }
}
