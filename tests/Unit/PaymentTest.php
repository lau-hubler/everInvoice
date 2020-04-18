<?php

namespace Tests\Unit;

use App\Invoice;
use App\Transaction;
use App\User;
use DatabaseSeeder;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_invoice_can_create_a_transaction()
    {
        $user = factory(User::class)->create();
        $this->seed(DatabaseSeeder::class);
        $invoice = Invoice::all()->random();

        $invoice->pay($user);

        $this->assertEquals($user->id, Transaction::first()->user_id);
        $this->assertEquals($invoice->id, Transaction::first()->invoice_id);
        $this->assertEquals($invoice->createReference(), Transaction::first()->reference);
        $this->assertEquals($invoice->total, Transaction::first()->amount);
        $this->assertEquals('https://test.placetopay.com/redirection/', Transaction::first()->url);
        $this->assertEquals('in process', Transaction::first()->status->name);
        $this->assertCount(1, Transaction::all());
    }

    public function test_a_invoice_in_process_cannot_create_another_transaction()
    {
        $this->expectException(Exception::class);

        $user = factory(User::class)->create();
        $this->seed(DatabaseSeeder::class);
        $invoice = Invoice::all()->random();
        $invoice->pay($user);

        $invoice->pay($user);
    }

    public function test_a_invoice_paid_cannot_create_another_transaction()
    {
        $this->expectException(Exception::class);

        $user = factory(User::class)->create();
        $this->seed(DatabaseSeeder::class);
        $invoice = Invoice::all()->random();
        Transaction::create([
            'user_id' => $user->id,
            'invoice_id' => $invoice->id,
            'reference' => $invoice->createReference(),
            'amount' => $invoice->total(),
            'url' => config('services.placetoPay.urlEndPoint'),
            'status_id' => 'paid'
        ]);

        $invoice->pay($user);
    }
}
