<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Reservation;
use App\Models\User;

use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $now = Carbon::now();
            $reservations = Reservation::where('status', 'pending')
                ->where('reservation_time', '<=', $now->subHour())
                ->get();

            foreach ($reservations as $reservation) {
                Mail::to($reservation->user->email)->send(new \App\Mail\ReservationReminder($reservation));
            }
        })->everyMinute();

        $schedule->call(function () {
            $now = Carbon::now();
            $reservations = Reservation::where('status', 'pending')
                ->where('reservation_time', '<=', $now->subHours(2))
                ->get();

            foreach ($reservations as $reservation) {
                $reservation->status = 'cancelled';
                $reservation->save();

                Mail::to($reservation->user->email)->send(new \App\Mail\ReservationCancelled($reservation));
            }
        })->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}