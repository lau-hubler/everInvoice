<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class LoginTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testUnauthenticatedUserCanAccessLoginView()
    {
        $response = $this->get(route('login'));

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function testAuthenticatedUserIsRedirectedToHome()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect('/home');
    }

    public function testUserCanLoginWithCorrectCredentials()
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

    public function testUserCannotLoginWithIncorrectPassword()
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
