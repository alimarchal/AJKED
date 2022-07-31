<?php

namespace App\Console;

use App\Models\Scheme;
use App\Models\SchemeItem;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $scheme = Scheme::where('status', 1)->get();

            if ($scheme->isNotEmpty()) {
                foreach ($scheme as $sch) {
                    $total_count = 0;
                    $count = null;

                    if ($sch->scheme_items->isNotEmpty()) {
                        $count = $sch->scheme_items->count();
                    }

                    foreach ($sch->scheme_items as $item) {
                        if ($item->quantity == $item->balance) {
                            $total_count++;
                        }
                    }

                    if ($count == $total_count) {
                        $sch->status = 0;
                        $sch->save();
                    }
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
