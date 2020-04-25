<?php

namespace Tests\Feature\Role;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\RoleTestHasProvider;
use Tests\TestCase;

class StoreRoleTest extends TestCase
{
    use RefreshDatabase;
    use RoleTestHasProvider;

    public function test_a_role_can_be_created()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->post('/roles', [
            'name' => 'Role name',
            'description' => 'Role description'
        ])->assertRedirect(route('roles.index'));

        $this->assertCount(1, Role::all());
        $this->assertEquals('Role name', Role::first()->name);
        $this->assertEquals('Role description', Role::first()->description);
    }

    /**
     * Test that a role cannot be stored
     * due to some data was not passed the validation rules
     *
     * @param array $roleData Array of values to post
     * @param string $field field that has failed

     * @dataProvider storeTestDataProvider
     */
    public function test_a_role_cannot_be_stored_due_to_validation_errors(array $roleData, string $field): void
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post(route('roles.store'), $roleData);

        $response->assertSessionHasErrors($field);
    }
}
