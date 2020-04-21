<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_invoice_can_be_paid()
    {
        $this->withExceptionHandling();
        $user = factory(User::class)->create();
        $this->seed(\DatabaseSeeder::class);
        $this->actingAs($user)->get('/invoices/1/pay')->assertNoContent();
    }
}
