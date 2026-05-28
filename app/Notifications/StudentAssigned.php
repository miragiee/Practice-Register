<?php

namespace App\Notifications;

use App\Models\StudentInternship;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentAssigned extends Notification implements ShouldQueue
{
    use Queueable;

    public StudentInternship $studentInternship;

    public function __construct(StudentInternship $studentInternship)
    {
        $this->studentInternship = $studentInternship;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Студент назначен на практику')
            ->line("Студент {$this->studentInternship->student_id} назначен на практику {$this->studentInternship->internship_id} для компании {$this->studentInternship->company_id}.")
            ->line('Статус: ' . $this->studentInternship->status)
            ->action('Перейти в систему', url('/'));
    }
}
