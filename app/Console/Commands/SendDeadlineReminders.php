<?php

namespace App\Console\Commands;

use App\Models\StudentInternship;
use App\Notifications\DeadlineReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class SendDeadlineReminders extends Command
{
    protected $signature = 'reminders:send';

    protected $description = 'Send automatic reminders for internship deadlines and closing documents.';

    public function handle()
    {
        $today = Carbon::today();
        $sendDates = [1, 7];
        $sentTotal = 0;

        foreach ($sendDates as $days) {
            $date = $today->copy()->addDays($days)->toDateString();

            $startReminders = StudentInternship::with(['student', 'company.user', 'internship.university'])
                ->where('status', 'assigned')
                ->whereHas('internship', fn ($query) => $query->whereDate('start_date', $date))
                ->get();

            foreach ($startReminders as $internship) {
                $sentTotal += $this->sendReminder($internship, 'start', $days);
            }

            $closingReminders = StudentInternship::with(['student', 'company.user', 'internship.university', 'student.internships'])
                ->where('status', 'assigned')
                ->whereHas('internship', fn ($query) => $query->whereDate('end_date', $date))
                ->whereDoesntHave('documents', fn ($query) => $query->where('type', 'closing'))
                ->get();

            foreach ($closingReminders as $internship) {
                $sentTotal += $this->sendReminder($internship, 'closing', $days);
            }
        }

        $this->info("Deadline reminders sent: {$sentTotal}");

        return 0;
    }

    protected function sendReminder(StudentInternship $internship, string $type, int $days): int
    {
        $notification = new DeadlineReminder($internship, $type, $days);
        $sent = 0;

        if ($student = $internship->student) {
            if (! empty($student->email)) {
                Notification::route('mail', $student->email)->notify($notification);
                $sent++;
            }
        }

        if ($companyUser = $internship->company->user ?? null) {
            $companyUser->notify($notification);
            $sent++;
        }

        if ($universityUser = $internship->internship->university->user ?? null) {
            $universityUser->notify($notification);
            $sent++;
        }

        return $sent;
    }
}
