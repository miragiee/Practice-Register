<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Reservation;

class ReservationCreated extends Notification implements ShouldQueue
{
    use Queueable;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $r = $this->reservation;

        return (new MailMessage)
            ->subject('Новая резервация студента')
            ->line("Компания забронировала студента ID: {$r->student_id} на стажировку ID: {$r->internship_id}")
            ->line('Статус: ' . $r->status)
            ->action('Перейти в админку', url('/admin'));
    }
}
