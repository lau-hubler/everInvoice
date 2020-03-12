<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class LoginTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_unauthenticated_user_can_access_login_view()
    {
        $response = $this->get(route('login'));

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_authenticated_user_is_redirected_to_home()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect('/home');
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'myPassword'),
        ]);
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }
    
    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'myPassword'),
        ]);
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'incorrectPassword',
        ]);
        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

}
