<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Nuestro comando de reportes
        \App\Console\Commands\GenerateReports::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // corte diario a medianoche
        $schedule->command('reports:generate')->dailyAt('00:00');
        // corte mensual, primer día a medianoche
        $schedule->command('reports:generate')->monthlyOn(1, '00:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
