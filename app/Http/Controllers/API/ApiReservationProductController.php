<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiReservationProductController extends Controller
{
    public function index($reservationId)
    {
        $reservation = Reservation::with('products')->findOrFail($reservationId);

        return response()->json([
            'success' => true,
            'data' => $reservation->products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $product->pivot->quantity,
                    'note' => $product->pivot->note,
                    'subtotal' => $product->price * $product->pivot->quantity,
                ];
            }),
            'message' => 'List of products for reservation'
        ], 200);
    }

    public function store(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        $validator = Validator::make($request->all(), [
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity'   => 'required|integer|min:0|max:100',
            'products.*.note'       => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
                'message' => 'Validasi gagal'
            ], 422);
        }

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

        $total = $reservation->products->sum(fn($product) =>
            $product->price * $product->pivot->quantity
        );

        $reservation->total_price = $total;
        $reservation->save();

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil dibuat',
            'data' => [
                'reservation_id' => $reservation->id,
                'total_price' => $reservation->total_price,
                'products' => $reservation->products->map(function($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'quantity' => $product->pivot->quantity,
                        'note' => $product->pivot->note,
                        'subtotal' => $product->price * $product->pivot->quantity,
                    ];
                }),
            ]
        ], 201);
    }

    public function update(Request $request, $reservationId, $productId)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1|max:100',
            'note'     => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
                'message' => 'Validasi gagal'
            ], 422);
        }

        $reservation = Reservation::findOrFail($reservationId);

        $reservation->products()->updateExistingPivot($productId, [
            'quantity' => $request->quantity,
            'note'     => $request->note,
        ]);

        $total = $reservation->products->sum(fn($product) =>
            $product->price * $product->pivot->quantity
        );

        $reservation->total_price = $total;
        $reservation->save();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => [
                'reservation_id' => $reservation->id,
                'total_price' => $reservation->total_price,
                'product' => [
                    'id' => $productId,
                    'quantity' => $request->quantity,
                    'note' => $request->note,
                ],
            ]
        ], 200);
    }

    public function destroy($reservationId, $productId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        $reservation->products()->detach($productId);

        $total = $reservation->products->sum(fn($product) =>
            $product->price * $product->pivot->quantity
        );

        $reservation->total_price = $total;
        $reservation->save();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus',
            'data' => [
                'reservation_id' => $reservation->id,
                'total_price' => $reservation->total_price,
            ]
        ], 200);
    }
}