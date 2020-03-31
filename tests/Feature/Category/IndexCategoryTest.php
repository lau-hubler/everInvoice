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

    public function testUnauthenticatedUsersCannotAccessCategoriesIndex()
    {
        $this->get(route('categories.index'))
            ->assertRedirect(route('login'))
        ;
    }

    public function testAuthenticatedUsersCanViewTheProductsIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('categories.index'));

        $response->assertSuccessful();
        $response->assertViewIs('category');
    }

    public function testTheIndexOfCategoriesHasCategories()
    {
        $this->seed(CategorySeeder::class);
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('categories.index'));

        $response->assertSuccessful();
        $response->assertViewHas('categories');
    }
}
