<?php


namespace Tests\Feature\Invoice;


use App\Invoice;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImportInvoiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Validates that authorized user can import invoices
     */
    public function test_authorized_user_can_import_invoices(): void
    {
        $user = factory(User::class)->create();

        $file = UploadedFile::fake()->createWithContent(
            'SuccessInvoiceImportFile.xlsx',
            file_get_contents(
                base_path('tests/Stubs/SuccessInvoiceImportFile.xlsx')
            )
        );

        $response = $this
            ->actingAs($user)
            ->post(route('invoices.import'), ['import_file' => $file]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    /**
     * Validates that unauthenticated user cannot import invoices
     * and is redirected to the login page
     */
    public function test_unauthorized_users_cannot_import_invoices(): void
    {
        $this->post(route('invoices.import'))
            ->assertRedirect(route('login'));
    }

    /**
     * Validates that invoices can be imported
     */
    public function test_invoices_can_be_imported(): void
    {
        $user = factory(User::class)->create();

        $file = UploadedFile::fake()->createWithContent(
            'SuccessInvoiceImportFile.xlsx',
            file_get_contents(
                base_path('tests/Stubs/SuccessInvoiceImportFile.xlsx')
            )
        );

        $this
            ->actingAs($user)
            ->post(route('invoices.import'), ['import_file' => $file]);

        $invoice = Invoice::where('client_id', 8)
            ->where('vendor_id', 1)
            ->where('due_date', '2019-12-12')
            ->where('delivery_date', '2020-01-01')
            ->where('invoice_date', '2020-02-02')
            ->where('status_id', 2)
            ->first();
        $this->assertNull($invoice);
    }

    /**
     * Validates that invalid invoices cannot be imported
     */
    public function test_invoices_cannot_be_imported_due_validation_errors(): void
    {
        $user = factory(User::class)->create();

        $file = UploadedFile::fake()->createWithContent(
            'ValidationErrorsInvoiceImportFile.xlsx',
            file_get_contents(
                base_path('tests/Stubs/ValidationErrorsInvoiceImportFile.xlsx')
            )
        );

        $response = $this
            ->actingAs($user)
            ->post(route('invoices.import'), ['import_file' => $file]);

        $response->assertSessionHasErrors();
    }



}
