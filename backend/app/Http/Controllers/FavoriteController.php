<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $favorites = Favorite::with('product')->where('user_id', $user->id)->get();
        return response()->json($favorites);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $productId = $request->input('product_id');
        $favorite = Favorite::firstOrCreate([
            'user_id' => $user->id,
            'product_id' => $productId
        ]);
        return response()->json(['success' => true]);
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $productId = $request->input('product_id');
        Favorite::where('user_id', $user->id)->where('product_id', $productId)->delete();
        return response()->json(['success' => true]);
    }
}
