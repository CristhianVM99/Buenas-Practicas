<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Pais;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pais')->delete();
        $json = File::get("database/data/country.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            Pais::create(array(
                'code'      => $obj->code,
                'name'      => $obj->name,
                'capital'   => $obj->capital ?? "",
                'continent' => $obj->continent ?? "",
                'iso'       => $obj->iso,
                'flag_1x1'  => $obj->flag_1x1,
                'flag_4x3'  => $obj->flag_4x3,
            ));
        }
    }
}
