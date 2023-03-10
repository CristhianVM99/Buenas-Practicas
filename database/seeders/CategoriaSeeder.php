<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ods')->delete();
        $categorias = [
            ["id" => "1", "name" => "Fin de la Pobreza", "icon" =>"S-WEB-Goal-01.png", ],
            ["id" => "2", "name" => "Hambre Cero", "icon" =>"S-WEB-Goal-02.png", ],
            ["id" => "3", "name" => "Salud y Bienestar", "icon" =>"S-WEB-Goal-03.png", ],
            ["id" => "4", "name" => "Educación de Calidad", "icon" =>"S-WEB-Goal-04.png", ],
            ["id" => "5", "name" => "Igualdad de Género", "icon" =>"S-WEB-Goal-05.png", ],
            ["id" => "6", "name" => "Agua Limpia y Saneamiento", "icon" =>"S-WEB-Goal-06.png", ],
            ["id" => "7", "name" => "Energía Asequible y No Contaminante", "icon" =>"S-WEB-Goal-07.png", ],
            ["id" => "8", "name" => "Trabajo Decente y Crecimiento Económico", "icon" =>"S-WEB-Goal-08.png", ],
            ["id" => "9", "name" => "Industria, Innovación e Infraestructura", "icon" =>"S-WEB-Goal-09.png", ],
            ["id" => "10", "name" => "Reducción de las Desigualdades", "icon" =>"S-WEB-Goal-10.png", ],
            ["id" => "11", "name" => "Ciudades y Comunidades Sostenibles", "icon" =>"S-WEB-Goal-11.png", ],
            ["id" => "12", "name" => "Producción y Consumo Responsable", "icon" =>"S-WEB-Goal-12.png", ],
            ["id" => "13", "name" => "Acción por el Clima", "icon" =>"S-WEB-Goal-13.png", ],
            ["id" => "14", "name" => "Vida Submarina", "icon" =>"S-WEB-Goal-14.png", ],
            ["id" => "15", "name" => "Vida de Ecosistemas Terrestres", "icon" =>"S-WEB-Goal-15.png", ],
            ["id" => "16", "name" => "Paz, Justicia e Instituciones Sólidas", "icon" =>"S-WEB-Goal-16.png", ],
            ["id" => "17", "name" => "Alianzas para Lograr los Objetivos", "icon" =>"S-WEB-Goal-17.png", ],
        ];

        Categoria::insert($categorias);
    }
}
