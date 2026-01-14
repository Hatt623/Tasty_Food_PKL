<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiReservationController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $reservations = Reservation::where('user_id', $userId)->latest()->get();
        $res = [
            'success' => true,
            'data' => $reservations,
            'message' => 'Data list Reservasi',
        ];
        return response()->json($res, 200);
    }

    public function store(Request $request)
    {
        // debugging logs (fixed)
        // \Log::info('DATE', [$request->reservation_date]);
        // \Log::info('TIME', [$request->reservation_time]);

        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first'
            ], 401);
        }

        $checkReservation = Reservation::where('user_id', Auth::id())
            ->where('status', '!=', 'completed')
            ->first();

        if ($checkReservation) {
            return response()->json([
                'success' => false,
                'message' => 'Anda masih memiliki reservasi aktif.'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
            'guest_count'      => 'required|integer|min:1|max:100',
        ],
        [
            'guest_count.max' => 'Jumlah tamu tidak boleh lebih dari 100',
            'guest_count.min' => 'Jumlah tamu minimal adalah 1'
        ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'data' => $request->all()
            ], 400);
        }

        $dayOfWeek = Carbon::parse($request->reservation_date)->dayOfWeek;
        if ($dayOfWeek == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Reservasi tidak tersedia di hari Minggu'
            ], 400);
        }

        $time  = Carbon::createFromFormat('H:i', $request->reservation_time)->format('H:i');
        $start = Carbon::createFromFormat('H:i', '08:00')->format('H:i');
        $end   = Carbon::createFromFormat('H:i', '21:30')->format('H:i');

        if ($time < $start || $time > $end) {
            return response()->json([
                'success' => false,
                'message' => 'Reservasi hanya tersedia antara 08:00 - 21:30'
            ], 400);
        }

        $reservationDateTime = Carbon::createFromFormat(
            'Y-m-d H:i',
            trim($request->reservation_date).' '.trim($request->reservation_time),
            'Asia/Jakarta'
        );

        $now = Carbon::now('Asia/Jakarta');

        if ($reservationDateTime->isToday() && $reservationDateTime->lt($now)) {
            return response()->json([
                'success' => false,
                'message' => 'Reservasi tidak boleh di waktu yang sudah lewat hari ini'
            ], 400);
        }

        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->reserve_code = 'RSV-'.strtoupper(Str::random(8));
        $reservation->reservation_date = $request->reservation_date;
        $reservation->reservation_time = $request->reservation_time;
        $reservation->guest_count = $request->guest_count;
        $reservation->status = 'pending';
        $reservation->payment_status = 'unpaid';
        $reservation->save();

        return response()->json([
            'success' => true,
            'data' => $reservation,
            'message' => 'Store reservation'
        ], 201);
    }


    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;
        $reservation = Reservation::where('user_id', $userId)->latest()->get();
        if (! $reservation) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
            ], 400);
       }

       return response()->json([
        'success'=> true,
        'data' => $reservation,
        'message' => 'Lihat data reservasi'
       ], 200);
    }

    public function update(Request $request, string $id)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first'
            ], 401);
        }

        $reservation = Reservation::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
            'guest_count'      => 'required|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 400);
        }

        $dayOfWeek = Carbon::parse($request->reservation_date)->dayOfWeek;
        if ($dayOfWeek == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Reservasi tidak tersedia di hari Minggu'
            ], 400);
        }

        $time  = Carbon::createFromFormat('H:i', $request->reservation_time)->format('H:i');
        $start = Carbon::createFromFormat('H:i', '08:00')->format('H:i');
        $end   = Carbon::createFromFormat('H:i', '21:30')->format('H:i');

        if ($time < $start || $time > $end) {
            return response()->json([
                'success' => false,
                'message' => 'Reservasi hanya tersedia antara 08:00 - 21:30'
            ], 400);
        }

        $reservationDateTime = Carbon::createFromFormat(
            'Y-m-d H:i',
            trim($request->reservation_date).' '.trim($request->reservation_time),
            'Asia/Jakarta'
        );

        $now = Carbon::now('Asia/Jakarta');

        if ($reservationDateTime->isToday() && $reservationDateTime->lt($now)) {
            return response()->json([
                'success' => false,
                'message' => 'Reservasi tidak boleh di waktu yang sudah lewat hari ini'
            ], 400);
        }

        $reservation->reservation_date = $request->reservation_date;
        $reservation->reservation_time = $request->reservation_time;
        $reservation->guest_count      = $request->guest_count;
        $reservation ->status          = 'pending';
        $reservation ->payment_status  = 'unpaid';
        $reservation->save();

        $reservation = Reservation::with(['user'])->find($reservation->id);

        return response()->json([
            'success' => true,
            'data'    => $reservation,
            'message' => 'Reservasi berhasil diperbarui'
        ], 200);
    }
}
