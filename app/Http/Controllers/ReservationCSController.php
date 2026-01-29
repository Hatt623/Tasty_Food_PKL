<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Product;
use App\Models\User;
use App\Models\ReservationProduct;

use Illuminate\Support\Str;

use Auth;
use Carbon\Carbon;

class ReservationCSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('reservation');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::check())
        {
            toast('Please Login first','warning');
            return redirect('/login');
        }

        $checkReservation = Reservation::where('user_id', Auth::id())
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->first();

        if ($checkReservation) {
            toast('Anda masih memiliki reservasi aktif. Cancel/selesaikan/ubah reservasi anda.','warning');
            return redirect()->route('reservation.index');
        }

        $request->validate([
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
            'guest_count' => 'required|integer|min:1|max:100',
        ],
        [
            'reservation_date.required'       => 'Tanggal reservasi wajib diisi',
            'reservation_date.date'           => 'Tanggal reservasi harus berupa format tanggal yang valid',
            'reservation_date.after_or_equal' => 'Tanggal reservasi tidak boleh sebelum hari ini',

            'reservation_time.required'       => 'Waktu reservasi wajib diisi',
            'reservation_time.date_format'    => 'Format waktu harus HH:MM (contoh: 18:30)',

            'guest_count.required' => 'Jumlah tamu wajib diisi',
            'guest_count.integer'  => 'Jumlah tamu harus berupa angka',
            'guest_count.min'      => 'Jumlah tamu minimal adalah 1',
            'guest_count.max'      => 'Jumlah tamu tidak boleh lebih dari 100',
        ]        
        );

       
        $dayOfWeek = Carbon::parse($request->reservation_date)->dayOfWeek; 
        if ($dayOfWeek == 0) {
            toast('Reservasi tidak tersedia di hari Minggu','error');
            return redirect()->back()->withInput();
        }

        $time = Carbon::createFromFormat('H:i', $request->reservation_time);
        $start = Carbon::createFromTime(8, 0);   
        $end   = Carbon::createFromTime(21, 30); 

        if ($time->lt($start) || $time->gt($end)) {
            toast('Reservasi hanya tersedia antara 08:00 - 21:30','error');
            return redirect()->back()->withInput();
        }

        $reservationDateTime = Carbon::parse($request->reservation_date . ' ' . $request->reservation_time, );
        $now = Carbon::now();

        if ($reservationDateTime->isToday() && $reservationDateTime->lt($now)) {
            toast('Reservasi tidak boleh di waktu yang sudah lewat hari ini','error');
            return redirect()->back()->withInput();
        }

        $reservation = new Reservation();
        $reservation ->user_id          = Auth::id();
        $reservation ->reserve_code       = 'RSV-' . strtoupper(Str::random(8));
        $reservation ->reservation_date = $request->reservation_date;
        $reservation ->reservation_time = $request->reservation_time;
        $reservation ->guest_count      = $request->guest_count;
        $reservation ->status           = 'pending';
        $reservation ->payment_status   = 'unpaid';

        $reservation ->save();
        toast('Reservasi berhasil dibuat', 'success');
        return redirect()->route('reservation.settings.index');

    }

    public function reservationSettingsIndex()
    {
       if (!Auth::check()) {
        toast('Please login first','warning');
        return redirect('/login');
        }

        $reservations = Reservation::where('user_id', Auth::id())->latest()->get();

        $pivotData = collect();
        foreach ($reservations as $reservation) {
            foreach ($reservation->products as $product) {
                $pivotData->push([
                    'product_id' => $product->id,
                    'quantity'   => $product->pivot->quantity,
                    'note'       => $product->pivot->note,
                ]);
            }
        }

        $products = Product::latest()->get()->map(function($product) use ($pivotData) {
            $pivot = $pivotData->firstWhere('product_id', $product->id);
            $product->reserved_quantity = $pivot['quantity'] ?? 0;
            $product->reserved_note     = $pivot['note'] ?? '-';
            return $product;
        });

        return view('reservationSettingsIndex', compact('reservations', 'products'));
    }

     public function cancel(Request $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'cancelled';
        $reservation->save();
        
        toast('Reservasi berhasil dibatalkan', 'success');
        return redirect()->route('reservation.settings.index');
    }

    public function edit(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        $products = Product::latest()->get()->map(function($product) use ($reservation) {
            $pivot = $reservation->products->firstWhere('id', $product->id)?->pivot;
            $product->reserved_quantity = $pivot->quantity ?? 0;
            $product->reserved_note     = $pivot->note ?? '-';
            return $product;
        });

        return view('reservationSettingsEdit', compact('reservation', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!Auth::check())
        {
            toast('Please Login first','warning');
            return redirect('/login');
        }

        $request->validate([
        'reservation_date' => 'required|date|after_or_equal:today',
        'reservation_time' => 'required|date_format:H:i',
        'guest_count' => 'required|integer|min:1|max:100',
        ],
        [
            'guest_count.max' => 'Jumlah tamu tidak boleh lebih dari 100',
            'guest_count.min' => 'Jumlah tamu minimal adalah 1'
        ]
        );
       
        $dayOfWeek = Carbon::parse($request->reservation_date)->dayOfWeek; 
        if ($dayOfWeek == 0) {
            toast('Reservasi tidak tersedia di hari Minggu','error');
            return redirect()->back()->withInput();
        }

        $time = Carbon::createFromFormat('H:i', $request->reservation_time);
        $start = Carbon::createFromTime(8, 0);   
        $end   = Carbon::createFromTime(21, 30); 

        if ($time->lt($start) || $time->gt($end)) {
            toast('Reservasi hanya tersedia antara 08:00 - 21:30','error');
            return redirect()->back()->withInput();
        }

        $reservationDateTime = Carbon::parse($request->reservation_date . ' ' . $request->reservation_time, );
        $now = Carbon::now();

        if ($reservationDateTime->isToday() && $reservationDateTime->lt($now)) {
            toast('Reservasi tidak boleh di waktu yang sudah lewat hari ini','error');
            return redirect()->back()->withInput();
        }

        $reservation = Reservation::findOrFail($id);
        $reservation ->user_id          = Auth::id();
        $reservation ->reservation_date = $request->reservation_date;
        $reservation ->reservation_time = $request->reservation_time;
        $reservation ->guest_count      = $request->guest_count;
        $reservation ->status           = 'pending';
        $reservation ->payment_status   = 'unpaid';

        $reservation ->save();
        toast('Reservasi berhasil diperbarui', 'success');
        return redirect()->route('reservation.settings.index');

    }

    //kayaknya g usah dl
    // public function destroy(string $id)
    // {
    //     $reservation = Reservation::findOrFail($id);
    //     $reservation->delete();
    //     toast('Reservasi berhasil dihapus', 'success');
    //     return redirect()->route('reservation.settings.index');
    // }

}
