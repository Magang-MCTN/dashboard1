<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RejectNotification extends Notification
{
    use Queueable;
    protected $pengajuan;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    /**
     * Create a new notification instance.
     *
     * @return void
     */


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

            // ->view('vendor.notifications.email', compact('pics'))
            ->line('ID Pengajuan: ' . $this->pengajuan->id)
            ->line('Diajukan oleh: ' . $this->pengajuan->user->name)
            ->line('Permintaan Anda Telah Ditolak  ')
            ->line('Dengan Alasan ' . $this->pengajuan->alasan)
            ->action('Klik Disini Untuk melihat', route('detail', ['id' => $this->pengajuan->id]))
            ->line('Terimakasih Telah Mengajukan Barang')
            ->line('PT MANDAU CIPTA TENAGA NUSANTARA');
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
