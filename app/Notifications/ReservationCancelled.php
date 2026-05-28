<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reservation;

class ReservationCancelled extends Notification implements ShouldQueue
{
    use Queueable;

    public Reservation $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $reservation = $this->reservation;

        return (new MailMessage)
            ->subject('Резервация отменена')
            ->line("Резервация студента {$reservation->student_id} по стажировке {$reservation->internship_id} была отменена компанией.")
            ->line('Текущий статус: ' . $reservation->status)
            ->action('Перейти в систему', url('/'));
    }
}
