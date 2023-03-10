<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('pais')->delete();
        $json = File::get("database/data/usersList.json");
        $data = json_decode($json);
        User::create(array(
            'name'              => "admin",
            'email'             => "admin@admin.com",
            'password'          => Hash::make("admin"),
            'email_verified_at' => now(),

        ));
        foreach ($data as $obj) {
            User::create(array(
                'name'      => $obj->name,
                'email'     => $obj->email,
                'password'  => Hash::make($obj->password),
            ));
        }
    }

}
