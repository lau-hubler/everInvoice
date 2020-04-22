<?php

namespace App\Notifications;

use App\Exports\InvoicesExport;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Maatwebsite\Excel\Facades\Excel;

class ExportInvoiceNotify extends Notification
{
    use Queueable;

    public $attachment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoices)
    {
        $this->attachment = Excel::download(new InvoicesExport($invoices), 'invoices.xlsx')->getFile();
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->from('admin@gmail.com')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!')
                    ->attach($this->attachment, ['as' => 'invoices.xlsx']);
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
}
