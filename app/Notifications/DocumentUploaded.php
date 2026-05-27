<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Document;

class DocumentUploaded extends Notification implements ShouldQueue
{
    use Queueable;

    public $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $d = $this->document;

        return (new MailMessage)
            ->subject('Добавлен документ')
            ->line("Добавлен документ типа {$d->type} для стажировки ID: {$d->student_internship_id}")
            ->action('Скачать документ', url('/documents/' . $d->id . '/download'));
    }
}
