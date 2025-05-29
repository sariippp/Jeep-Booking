<?php

namespace App\Console\Commands;

use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateMonthlySessions extends Command
{
    protected $signature = 'sessions:generate-monthly';
    protected $description = 'Generate session records for all Saturdays and Sundays of the current month';

    public function handle()
    {
        $now = Carbon::now();
        $sessionTimes = [
            '09:00:00', '10:00:00', '11:00:00',
            '12:00:00', '13:00:00', '14:00:00',
            '15:00:00', '16:00:00', '17:00:00'
        ];

        for ($i = 0; $i < 3; $i++) {
            $targetMonth = $now->copy()->addMonths($i);
            $startOfMonth = $targetMonth->copy()->startOfMonth();
            $endOfMonth = $targetMonth->copy()->endOfMonth();

            for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
                if ($date->isWeekend()) {
                    foreach ($sessionTimes as $time) {
                        \App\Models\Session::updateOrCreate([
                            'date' => $date->toDateString(),
                            'session_time' => $time,
                        ], [
                            'passenger_count' => 24,
                        ]);
                    }
                }
            }
        }

        $this->info('Session data generated for weekends for the next 3 months.');
    }
}
