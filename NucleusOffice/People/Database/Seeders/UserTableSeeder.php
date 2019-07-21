<?php

namespace NucleusOffice\People\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use NucleusOffice\People\Entities\Tenancy;
use NucleusOffice\People\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Tenancy::create([
            'name' => 'default',
            'description' => 'Default tenancy',
        ]);

        if (App::environment() == 'local') {
            Tenancy::create([
                'name' => 'alternative',
                'description' => 'Some other tenancy',
            ]);
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->tenancies()->sync(Tenancy::all()->pluck('id')->toArray());

        factory(User::class, 100)->create()->each(function($user) {
            $user->tenancies()->sync(Tenancy::where('name', 'default')->get()->pluck('id')->toArray());
        });
    }
}
