<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CheckReservations extends Command
{
    // Buat debug testing dengan php artisan reservations:check
    protected $signature = 'reservations:check';
    protected $description = 'Cek pengingat dan pembatalan reservasi';

    public function handle()
    {
        $this->info('Memulai pengecekan reservasi...');

        // Reminder Reservasi
        $reminderData = Reservation::where('status', 'pending')
            ->where('reservation_time', '<=', now()->subHour())
            ->whereNull('reminder_sent_at')
            ->get();

        foreach ($reminderData as $res) {
            Mail::to($res->user->email)->send(new \App\Mail\ReservationReminder($res));
            $res->update(['reminder_sent_at' => now()]);
            $this->line("Reminder terkirim untuk ID: {$res->id}");
        }

        // Cancel Reservasi
        $expiredData = Reservation::where('status', 'pending')
            ->where('reservation_time', '<=', now()->subHours(2))
            ->get();

        foreach ($expiredData as $res) {
            $res->update(['status' => 'cancelled']);
            Mail::to($res->user->email)->send(new \App\Mail\ReservationCancelled($res));
            $this->error("Reservasi ID: {$res->id} dibatalkan karena melewati batas waktu.");
        }

        $this->info('Pengecekan selesai!');
    }
}