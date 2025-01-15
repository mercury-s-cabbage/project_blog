<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Регистрация вашей команды
        \App\Console\Commands\PublishPosts::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Планирование команды для выполнения, например, раз в сутки
        $schedule->command('posts:publish')->daily();
    }

    // ...
}
