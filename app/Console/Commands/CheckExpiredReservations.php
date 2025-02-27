<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Models\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckExpiredReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and process expired reservations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Checking expired reservations...');
        
        $expiredReservations = Reservation::where('payment_status', 'pending')
            ->where('expires_at', '<', now())
            ->get();
            
        $count = $expiredReservations->count();
        $this->info("Found {$count} expired reservations");
        
        foreach ($expiredReservations as $reservation) {
            try {
                DB::beginTransaction();
                
                // Update reservation status to expired
                $reservation->payment_status = 'failed';
                $reservation->save();
                
                // Restore session passenger count
                $session = Session::find($reservation->session_id);
                if ($session) {
                    $session->passenger_count += $reservation->count;
                    $session->save();
                    $this->info("Restored {$reservation->count} passenger(s) to Session #{$session->id}");
                }
                
                DB::commit();
                $this->info("Processed expired reservation #{$reservation->id}");
            } catch (\Exception $e) {
                DB::rollBack();
                $this->error("Error processing reservation #{$reservation->id}: {$e->getMessage()}");
                Log::error("Error processing expired reservation #{$reservation->id}: {$e->getMessage()}");
            }
        }
        
        return 0;
    }
}