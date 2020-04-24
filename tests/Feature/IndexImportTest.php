<?php


namespace Tests\Feature;


use App\User;
use CategorySeeder;
use DocumentTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use ProductSeeder;
use StakeholderSeeder;
use Tests\TestCase;

class IndexImportTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Validates that unauthenticated user cannot access invoices index
     */
    public function test_unauthenticated_users_cannot_access_invoices_index(): void
    {
        $this->get(route('invoices.index'))
            ->assertRedirect(route('login'))
        ;
    }

    public function test_authenticated_users_can_view_the_invoices_index(): void
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('invoices.index'));

        $response->assertSuccessful();
        $response->assertViewIs('stakeholder.invoice');
    }

    public function test_index_of_invoices_has_invoices(): void
    {
        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);
        $this->seed(DocumentTypeSeeder::class);
        $this->seed(StakeholderSeeder::class);

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('invoices.index'));

        $response->assertSuccessful();
        $response->assertViewHas('invoices');
    }
}
