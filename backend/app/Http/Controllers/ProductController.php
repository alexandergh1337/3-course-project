<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Товар не найден'], 404);
        }
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'brand' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);
        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Товар не найден'], 404);
        }
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'category' => 'nullable|string|max:255',
            'price' => 'sometimes|required|numeric',
            'brand' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);
        $product->update($validated);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Товар не найден'], 404);
        }
        \App\Models\CartItem::where('product_id', $id)->delete();
        
        if (class_exists('App\\Models\\Favorite')) {
            \App\Models\Favorite::where('product_id', $id)->delete();
        }
        $product->delete();
        return response()->json(['message' => 'Товар удалён']);
    }
}
