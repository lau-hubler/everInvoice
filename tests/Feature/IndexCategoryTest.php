<?php

declare(strict_types=1);

namespace Tests\Feature\Category;

use App\User;
use CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class IndexCategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Validates that unauthenticated user cannot access categories index
     */
    public function test_unauthenticated_users_cannot_access_categories_index(): void
    {
        $this->get(route('categories.index'))
            ->assertRedirect(route('login'))
        ;
    }

    public function test_authenticated_users_can_view_the_category_index(): void
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('categories.index'));

        $response->assertSuccessful();
        $response->assertViewIs('invoice.category');
    }

    public function test_index_of_Categories_has_categories(): void
    {
        $this->seed(CategorySeeder::class);
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('categories.index'));

        $response->assertSuccessful();
        $response->assertViewHas('categories');
    }
}
