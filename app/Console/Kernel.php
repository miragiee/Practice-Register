<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Foundation\Console\Kernel as ConsoleKernelBase;

class Kernel extends ConsoleKernelBase implements ConsoleKernelContract
{
    protected $commands = [
        \App\Console\Commands\SendDeadlineReminders::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('reminders:send')->dailyAt('08:00');
    }
}
