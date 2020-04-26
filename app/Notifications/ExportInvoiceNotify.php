<?php

namespace App\Notifications;

use App\Exports\InvoicesExport;
use App\Exports\Sheets\OrderDetailsSheet;
use App\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Response;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;

class ExportInvoiceNotify extends Notification
{
    use Queueable;

    public $invoices;
    private $format;
    private $orders;

    /**
     * Create a new notification instance.
     *
     * @param $invoices
     * @param $format
     */
    public function __construct($invoices, $format)
    {
        $this->format = $format;
        $this->invoices = $invoices->exportInvoices(Invoice::all());
        $this->orders = $invoices->exportOrders(Invoice::all());
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $email = (new MailMessage)
            ->line(' You can find the documents you asked for attached to this mail :)')
            ->from(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'))
            ->line('Thank you for using our application!');

        foreach ($this->getExportableFile() as $file) {
            $email->attach($file['file'], ['as' => $file['name']] );
        }

        return $email;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * @param $invoices
     * @param $format
     */
    private function getExportableFile()
    {
        if ($this->format === 'xlsx') {
            return $this->getXlsxFile($this->invoices, $this->orders);
        }
        if ($this->format === 'csv') {
            return $this->getCsvFile($this->invoices, $this->orders);
        }
        if ($this->format === 'txt') {
            return $this->getTsvFile($this->invoices, $this->orders);
        }
    }

    private function getXlsxFile($invoices, $orders)
    {
        $invoiceFile = (new InvoicesExport($invoices, $orders))
            ->download('invoices.xlsx', \Maatwebsite\Excel\Excel::XLSX)
            ->getFile();

        return [
            'invoices' => [
                'file' => $invoiceFile,
                'name' => 'invoices.xlsx'
            ],
        ];
    }

    private function getCsvFile($invoices, $orders)
    {
        $invoiceFile = (new InvoicesExport($invoices, $orders))
            ->download('invoices.csv', \Maatwebsite\Excel\Excel::CSV)
            ->getFile();
        $orderFile =(new OrderDetailsSheet($orders))
            ->download('orders.csv', \Maatwebsite\Excel\Excel::CSV)
            ->getFile();
        return [
            'invoices' => [
                'file' => $invoiceFile,
                'name' => 'invoices.csv'
            ],
            'orders' => [
                'file' => $orderFile,
                'name' => 'orders.csv'
            ] ];
    }

    private function getTsvFile($invoices, $orders)
    {
        $invoiceFile = (new InvoicesExport($invoices, $orders))
            ->download('invoices.txt', \Maatwebsite\Excel\Excel::TSV)
            ->getFile();
        $orderFile =(new OrderDetailsSheet($orders))
            ->download('orders.txt', \Maatwebsite\Excel\Excel::TSV)
            ->getFile();
        return [
            'invoices' => [
                'file' => $invoiceFile,
                'name' => 'invoices.txt'
            ],
            'orders' => [
                'file' => $orderFile,
                'name' => 'orders.txt'
            ] ];
    }
}
