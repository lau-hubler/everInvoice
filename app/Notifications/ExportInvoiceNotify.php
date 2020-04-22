<?php

namespace App\Notifications;

use App\Exports\InvoicesExport;
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

    /**
     * Create a new notification instance.
     *
     * @param $invoices
     * @param $format
     */
    public function __construct($invoices, $format)
    {
        $this->format = $format;
        $this->invoices = $invoices;

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
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->from(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'))
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!')
                    ->attach($this->getExportableFile(), ['as' => "invoices.$this->format"]);
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
            return $this->getXlsxFile($this->invoices);
        }
        if ($this->format === 'csv') {
            return $this->getCsvFile($this->invoices);
        }
        if ($this->format === 'txt') {
            return $this->getTsvFile($this->invoices);
        }
    }

    /**
     * @param $invoices
     * @return Response|BinaryFileResponse|File
     */
    private function getCsvFile($invoices)
    {
        return (new InvoicesExport($invoices))
            ->download('invoices.csv', \Maatwebsite\Excel\Excel::CSV)
            ->getFile();
    }

    private function getXlsxFile($invoices)
    {
        return (new InvoicesExport($invoices))
            ->download('invoices.xlsx', \Maatwebsite\Excel\Excel::XLSX)
            ->getFile();
    }

    private function getTsvFile($invoices)
    {
        return (new InvoicesExport($invoices))
            ->download('invoices.tsv', \Maatwebsite\Excel\Excel::TSV)
            ->getFile();
    }
}
