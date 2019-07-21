<?php

use Faker\Generator as Faker;
use NucleusOffice\Acl\Entities\Role;
use Spatie\Permission\Models\Permission;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Role::class, function (Faker $faker) {
    $permissions = Permission::all()->take(10)->pluck('id')->toArray();

    return [
        'name' => $faker->slug,
        'description' => $faker->name,
        'type' => $faker->randomElement(['permissive', 'prohibitive']),
        'permissions' => $faker->randomElements($permissions, 3)
    ];
});
