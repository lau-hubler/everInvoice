<?php

namespace Tests\Feature\Category;

use App\Category;
use App\User;
use CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexCategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_unauthenticated_users_cannot_access_categories_index()
    {
        $this->get(route('categories.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_view_the_products_index()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('categories.index'));

        $response->assertSuccessful();
        $response->assertViewIs('category');
    }

    public function test_the_index_of_categories_has_categories()
    {
        $this->seed(CategorySeeder::class);
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('categories.index'));

        $response->assertSuccessful();
        $response->assertViewHas('categories');
    }
}
