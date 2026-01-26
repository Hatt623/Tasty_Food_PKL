<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\ReservationHistory;
use App\Model\User;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservation = Reservation::with('user')->latest()->get();
        $title = 'Delete Data';
        $text = 'Apakah Anda yakin?';
        confirmDelete($title,$text);

        return view('backend.reservation.index', compact('reservation'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::with('user')->findOrFail($id);
        $reservationHistory = ReservationHistory::where('reservation_id', $id)->latest()->get();
        return view('backend.reservation.show', compact('reservation', 'reservationHistory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::with('user')->findOrFail($id);
        return view('backend.reservation.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'payment_status' => 'nullable|in:paid,unpaid',
        ]);

        $reservation->status = $request->status;
        $reservation->payment_status = $request->payment_status;
        $reservation->save();

        ReservationHistory::create([
            'reservation_id' => $reservation->id,
            'staff_name'     => auth()->user()->name,
            'old_status'     => $reservation->getOriginal('status'),
            'new_status'     => $request->status,
            'note'           => $request->note ?? '-',
        ]);

        toast('Reservasi berhasil di update.', 'success');
        return redirect()->route('backend.reservation.edit', $reservation->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        toast('Reservasi berhasil dihapus.', 'success');
        return redirect()->route('backend.reservation.index');
    }
}
