<?php

namespace App\Console;

use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

        //https://stackoverflow.com/a/30704738
        'App\Console\Commands\Actividad',
        'App\Console\Commands\Imagenes',
        'App\Console\Commands\Informacion',
        'App\Console\Commands\ChatDiario',
        'App\Console\Commands\ChatHora',
        'App\Console\Commands\Viajeros',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('tareas:actividad')
            ->timezone('America/Argentina/Buenos_Aires')
            ->dailyAt('00:00');

        $schedule->command('tareas:imagenes')
            ->timezone('America/Argentina/Buenos_Aires')
            ->dailyAt('23:45');

        // $schedule->command('tareas:informacion')
        //     ->timezone('America/Argentina/Buenos_Aires')
        //     ->weekly();

        $schedule->command('chat:diario')
            ->timezone('America/Argentina/Buenos_Aires')
            ->everyMinute();
        $schedule->command('chat:hora')
            ->timezone('America/Argentina/Buenos_Aires')
            ->everyMinute();
        $schedule->command('viajeros:destino')
            ->timezone('America/Argentina/Buenos_Aires')
            ->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
