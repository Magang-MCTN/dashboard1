<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Daftar extends Notification
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
            ->line('Ada Pengajuan yang harus Ditinjau, Silahkah klik dibawah ini !!!')
            ->line('ID Pengajuan: ' . $this->pengajuan->id)
            ->line('Diajukan oleh: ' . $this->pengajuan->user->name)
            ->action('Lihat Pengajuan', route('persetujuan-barang', ['id' => $this->pengajuan->id]))
            ->line('Terimakasih ')
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
