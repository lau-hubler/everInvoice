<?php


namespace Tests\Feature;


use App\User;
use CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Validates that unauthenticated user cannot access products index
     */
    public function test_unauthenticated_users_cannot_access_products_index(): void
    {
        $this->get(route('products.index'))
            ->assertRedirect(route('login'))
        ;
    }

    public function test_authenticated_users_can_view_the_products_index(): void
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('products.index'));

        $response->assertSuccessful();
        $response->assertViewIs('models.product');
    }

    public function test_index_of_products_has_products(): void
    {
        $this->seed(CategorySeeder::class);
        $this->seed(\ProductSeeder::class);
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('products.index'));

        $response->assertSuccessful();
        $response->assertViewHas('products');
    }
}
