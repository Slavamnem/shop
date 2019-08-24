<?php

namespace App\Console;

use App\Console\Commands\GetPopularProducts;
use App\Console\Commands\SyncNovaPoshtaCities;
use App\Console\Commands\SyncNovaPoshtaWarehouses;
use App\Console\Commands\TestCommand;
use App\Console\Commands\TestCommand2;
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
        TestCommand::class,
        TestCommand2::class,
        SyncNovaPoshtaCities::class,
        SyncNovaPoshtaWarehouses::class,
        GetPopularProducts::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('test-command1')->everyMinute();
//        $schedule->command('test-command')
//            ->everyMinute()
//            ->fridays()
//            ->between("12:00", "15:00")
//            ->when(function(){
//                return true;
//            })
//            ->withoutOverlapping()    //не запускать если еще предыдущий звапуск работает
//            ->before(function () {
//               // Перед запуском задачи...
//            })
//            ->after(function () {
//               // Задача завершена...
//            })
//            ->sendOutputTo($filePath);
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
