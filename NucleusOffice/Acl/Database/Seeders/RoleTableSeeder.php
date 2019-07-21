<?php

namespace NucleusOffice\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $tableNames = config('permission.table_names');

        $roles = [
            [
                'name' => 'admin',
                'description' => 'Admin',
                'type' => 'permissive',
                'guard_name' => 'web'
            ],
        ];

        Artisan::call('permission:migrate');

        DB::table($tableNames['roles'])->insert($roles);
    }
}
