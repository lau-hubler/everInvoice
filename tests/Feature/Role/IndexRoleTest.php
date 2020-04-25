<?php

namespace Tests\Feature\Role;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_unauthorized_user_cannot_access_role_index()
    {
        $this->get(route('roles.index'))->assertRedirect('login');
    }

    public function test_authenticated_users_can_view_roles_index()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('roles.index'));

        $response->assertSuccessful();
        $response->assertViewIs('role.index');
    }
}
