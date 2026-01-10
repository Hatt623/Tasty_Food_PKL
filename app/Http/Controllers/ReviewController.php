<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $review = Review::updateOrCreate(
        [
            'user_id' => auth()->user()->id,
            'product_id' => $productId,
        ],
        [
            'rating' => $request->rating,
        ]
    );

    $review->save();
    toast()->success('terimakasih atas ratingnya!');
    return redirect()->back();

}
}
