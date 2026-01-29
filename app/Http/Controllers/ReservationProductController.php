<?php

namespace App\Http\Controllers;

use App\Models\ReservationProduct;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\User;

use Auth;
use Illuminate\Http\Request;

class ReservationProductController extends Controller
{
    public function store(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity'   => 'required|integer|min:0|max:100',
            'products.*.note'       => 'nullable|string|max:255',
        ]);

        foreach ($request->products as $item) {
            if ($item['quantity'] > 0) {
                $reservation->products()->syncWithoutDetaching([
                    $item['product_id'] => [
                        'quantity' => $item['quantity'],
                        'note'     => $item['note'] ?? '-',
                    ]
                ]);
            } else {
                $reservation->products()->detach($item['product_id']);
            }
        }

        $total = $reservation->products->sum(function($product) {
            return $product->price * $product->pivot->quantity;
        });

        $reservation->total_price = $total;
        $reservation->save();


        if (Auth::user()->role == 'customer'){
            toast('Order Reservasi Berhasil Dibuat', 'success');
            return redirect()->route('reservation.edit', $reservationId);
        }

        else {
        return redirect()->route('backend.reservation.show', $reservationId)
                        ->with('success', 'Order berhasil dibuat dengan banyak produk.');
        }
        
    }

    public function update(Request $request, $reservationId, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:100',
            'note'     => 'nullable|string|max:255',
        ]);

        $reservation = Reservation::findOrFail($reservationId);

        $reservation->products()->updateExistingPivot($productId, [
            'quantity' => $request->quantity,
            'note'     => $request->note,
        ]);

        $total = $reservation->products->sum(function($product) {
            return $product->price * $product->pivot->quantity;
        });

        $reservation->total_price = $total;
        $reservation->save();

        if (Auth::user()->role == 'customer'){
            toast('Menu reservasi anda berhasil di perbarui', 'success');
            return redirect()->route('reservation.edit', $reservationId);
        }

        else {
            return redirect()->route('backend.reservation.show', $reservationId)
                            ->with('success', 'Produk dalam reservasi berhasil diperbarui.');
        }
    }

    public function destroy($reservationId, $productId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        $reservation->products()->detach($productId);

        $total = $reservation->products->sum(function($product) {
            return $product->price * $product->pivot->quantity;
        });

        $reservation->total_price = $total;
        $reservation->save();

        if (Auth::user()->role == 'customer'){
            toast('Menu berhasil dihapus dari reservasi', 'success');
            return redirect()->route('reservation.edit', $reservationId);
        }

        else {
            return redirect()->route('backend.reservation.show', $reservationId)
                             ->with('success', 'Produk berhasil dihapus dari reservasi.');
        }
    }

}
