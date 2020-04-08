<?php


namespace Tests\Feature\Api\Category;

use App\User;
use CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\CategoryTestHasProvider;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use RefreshDatabase;
    use CategoryTestHasProvider;

    public function test_a_invoice_is_updated_in_database(): void
    {
        $this->seed(CategorySeeder::class);

        $data = [
            'code' => 'CTG001',
            'name' => 'General',
            'description' => 'This is a general category',
            'iva' => 0.19,
        ];

        $this->putJson(route('api.categories.update', 1), $data);

        $this->assertDatabaseHas('categories', $data);
    }

    /**
     * Test that a category cannot be stored
     * due to some data was not passed the validation rules
     *
     * @param array $categoryData Array of values to post
     * @param string $field field that has failed

     * @dataProvider storeTestDataProvider
     */
    public function test_a_product_cannot_bee_stored_due_to_validation_errors(
        array $categoryData,
        string $field
    ): void {
        $this->seed(CategorySeeder::class);
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->putJson(route('api.categories.update', 1), $categoryData);

        $response->assertJsonValidationErrors($field);
    }
}
