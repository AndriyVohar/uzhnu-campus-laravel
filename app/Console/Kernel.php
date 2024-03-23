<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Advertisement;
use App\Models\WorkerTask;
use App\Models\Work;
use App\Models\Washing;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        
        $schedule->call(function(){
            //Deleting Advertisements what created more then 30 days ago
            $thresholdDate = now()->subDays(30);
            Advertisement::where('created_at', '<', $thresholdDate)->delete();

            //Deleting WorkerTasks what created more then 30 days ago
            WorkerTask::where('created_at', '<', $thresholdDate)->delete();

            //Deleting Work what created more then 60 days ago
            $thresholdDate = now()->subDays(60);
            Work::where('created_at', '<', $thresholdDate)->delete();

            //Deleting Washing what day washing more than 7 days ago
            $thresholdDate = now()->subDays(7);
            Washing::where('day', '<', $thresholdDate)->delete();
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
