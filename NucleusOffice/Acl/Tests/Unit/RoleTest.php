<?php

namespace NucleusOffice\Acl\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use NucleusOffice\Acl\Entities\Role;
use NucleusOffice\People\Entities\Tenancy;
use NucleusOffice\People\Entities\User;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateRole()
    {
        $tenancy = Tenancy::create(['name' => 'Teste']);

        $user = factory(User::class)->create(['current_tenancy_id' => $tenancy->id]);

        $user->tenancies()->sync($tenancy->id);

        $data = factory(Role::class)->make()->toArray();

        $response = $this->actingAs($user, 'api')->json('post', 'v1/roles', $data);

        $response->assertStatus(201);
    }

    public function testListRoles()
    {
        $tenancy = Tenancy::create(['name' => 'Teste']);
        $user = factory(User::class)->create(['current_tenancy_id' => $tenancy->id]);
        $this->actingAs($user, 'api')->json('get', 'v1/roles')
            ->assertStatus(200);
    }

    public function testShowRole()
    {
        $tenancy = Tenancy::create(['name' => 'Teste']);

        $user = factory(User::class)->create(['current_tenancy_id' => $tenancy->id]);

        $user->tenancies()->sync($tenancy->id);

        $roleResponse = $this->actingAs($user, 'api')->json('post', 'v1/roles', factory(Role::class)->make()->toArray());

        $role = json_decode($roleResponse->getContent());

        $this->actingAs($user, 'api')->json('get', 'v1/roles/' . $role->id)
            ->assertStatus(200);
    }

    public function testUpdateRole()
    {
        $tenancy = Tenancy::create(['name' => 'Teste']);

        $user = factory(User::class)->create(['current_tenancy_id' => $tenancy->id]);
        $user->tenancies()->sync($tenancy->id);

        $roleResponse = $this->actingAs($user, 'api')->json('post', 'v1/roles', factory(Role::class)->make()->toArray());
        $role = json_decode($roleResponse->getContent());

        $newData = factory(Role::class)->make()->toArray();

        $this->actingAs($user, 'api')->json('put', 'v1/roles/' . $role->id, $newData)
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => $newData['name'],
                'description' => $newData['description'],
            ]);
    }

    public function testUpdateOthersRole()
    {
        $tenancy = Tenancy::create(['name' => 'Teste']);

        $user = factory(User::class)->create(['current_tenancy_id' => $tenancy->id]);
        $user->tenancies()->sync($tenancy->id);

        $roleResponse = $this->actingAs($user, 'api')->json('post', 'v1/roles', factory(Role::class)->make()->toArray());
        $role = json_decode($roleResponse->getContent());

        $newData = factory(Role::class)->make()->toArray();

        $tenancy = Tenancy::create(['name' => 'Other Tenancy']);

        $user = factory(User::class)->create(['current_tenancy_id' => $tenancy->id]);
        $user->tenancies()->sync($tenancy->id);

        $this->actingAs($user, 'api')->json('put', 'v1/roles/' . $role->id, $newData)
            ->assertStatus(404);
    }

    public function testDeleteRole()
    {
        $tenancy = Tenancy::create(['name' => 'Teste']);

        $user = factory(User::class)->create(['current_tenancy_id' => $tenancy->id]);

        $user->tenancies()->sync($tenancy->id);

        $roleResponse = $this->actingAs($user, 'api')->json('post', 'v1/roles', factory(Role::class)->make()->toArray());

        $role = json_decode($roleResponse->getContent());

        $this->actingAs($user, 'api')->json('delete', 'v1/roles/' . $role->id)->assertStatus(204);
    }
}
