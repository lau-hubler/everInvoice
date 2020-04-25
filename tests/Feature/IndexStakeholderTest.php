<?php


namespace Tests\Feature;

use App\User;
use DocumentTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use StakeholderSeeder;
use Tests\TestCase;

class IndexStakeholderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Validates that unauthenticated user cannot access stakeholders index
     */
    public function test_unauthenticated_users_cannot_access_stakeholders_index(): void
    {
        $this->get(route('stakeholders.index'))
            ->assertRedirect(route('login'))
        ;
    }

    public function test_authenticated_users_can_view_the_stakeholder_index(): void
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('stakeholders.index'));

        $response->assertSuccessful();

        $response->assertViewIs('invoice.stakeholder');
    }

    public function test_index_of_stakeholder_has_stakeholders(): void
    {
        $this->seed(DocumentTypeSeeder::class);
        $this->seed(StakeholderSeeder::class);
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('stakeholders.index'));

        $response->assertSuccessful();
        $response->assertViewHas('stakeholders');
    }
}
