<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('roles')->truncate();
        DB::table('model_has_roles')->truncate();

        $administrador = Role::create( [ "name" => "admin" ]);
        $visitante     = Role::create( [ "name" => "visitante" ]);
        $innovador     = Role::create( [ "name" => "innovador" ]);
        $experto       = Role::create( [ "name" => "experto" ]);

        $user = User::where('name', '=', "admin")->first();

        if(!isset($user))
        {
            $user = User::create(array(
                'name'              => "admin",
                'email'             => "admin@admin",
                'password'          => Hash::make("admin"),
                'email_verified_at' => now(),
            ));
        }
        $user->assignRole($administrador);

    }
}
