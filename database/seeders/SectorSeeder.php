<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Sector;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SECTOR
        DB::table('sectores')->delete();
        $sectores = [
            [ "name" => "Minería" ],
            [ "name" => "Agricultura" ],
            [ "name" => "Piscicultura" ],
            [ "name" => "Energía" ],
            [ "name" => "Industria Manufacturera" ],
            [ "name" => "Tecnología" ],
            [ "name" => "Servicios Financieros" ],
            [ "name" => "Construcción " ],
            [ "name" => "Comercio" ],
            [ "name" => "Turismo" ],
            [ "name" => "Transporte" ],
            [ "name" => "Servicios Públicos (Agua, Electricidad)" ],
            [ "name" => "Educación" ],
            [ "name" => "Salud" ],
            [ "name" => "Seguridad Publica" ],
            [ "name" => "Medios de Comunicación" ],
            [ "name" => "Investigación y desarrollo" ],
            [ "name" => "Artes y Cultura" ],
        ];

        Sector::insert($sectores);
    }
}
