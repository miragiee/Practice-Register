<?php

namespace App\Notifications;

use App\Models\StudentInternship;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeadlineReminder extends Notification
{
    public StudentInternship $studentInternship;
    public string $reminderType;
    public int $days;

    public function __construct(StudentInternship $studentInternship, string $reminderType, int $days)
    {
        $this->studentInternship = $studentInternship;
        $this->reminderType = $reminderType;
        $this->days = $days;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $internship = $this->studentInternship->internship;
        $student = $this->studentInternship->student;
        $company = $this->studentInternship->company;
        $university = $internship->university;

        if ($this->reminderType === 'start') {
            return (new MailMessage)
                ->subject('Напоминание: начало практики через ' . $this->days . ' дн.')
                ->greeting('Здравствуйте!')
                ->line('Стажировка для студента «' . ($student->full_name ?? 'студент') . '» начнется через ' . $this->days . ' дн. (с ' . $internship->start_date->toDateString() . ').')
                ->line('Проверьте готовность документов и согласование в системе.')
                ->line('Компания: ' . ($company->name ?? 'не указана'))
                ->line('ВУЗ: ' . ($university->name ?? 'не указан'))
                ->action('Открыть систему', url('/auth'));
        }

        return (new MailMessage)
            ->subject('Напоминание: загрузите закрывающие документы')
            ->greeting('Здравствуйте!')
            ->line('Стажировка для студента «' . ($student->full_name ?? 'студент') . '» заканчивается через ' . $this->days . ' дн. (до ' . $internship->end_date->toDateString() . ').')
            ->line('Пожалуйста, загрузите закрывающие документы для завершения практики.')
            ->line('Компания: ' . ($company->name ?? 'не указана'))
            ->line('ВУЗ: ' . ($university->name ?? 'не указан'))
            ->action('Открыть систему', url('/auth'));
    }
}
