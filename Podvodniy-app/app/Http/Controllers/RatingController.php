<?php

namespace App\Http\Controllers;

use App\Models\UserRating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'water_id' => 'required|exists:waters,id',
            'price' => 'required|integer|min:1|max:5',
            'bitterness' => 'required|integer|min:1|max:5',
            'sweetness' => 'required|integer|min:1|max:5',
            'saltiness' => 'required|integer|min:1|max:5',
            'metallic' => 'required|integer|min:1|max:5',
        ]);

        UserRating::create([
            'user_id' => auth()->id(),
            'water_id' => $validated['water_id'],
            'price' => $validated['price'],
            'bitterness' => $validated['bitterness'],
            'sweetness' => $validated['sweetness'],
            'saltiness' => $validated['saltiness'],
            'metallic' => $validated['metallic'],
        ]);

        return response()->json(['message' => 'Оценка сохранена!'], 200);
    }
}
