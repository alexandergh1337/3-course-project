<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $cart->load('items.product');
        return response()->json($cart);
    }

    public function add(Request $request)
    {
        $user = $request->user();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $item = CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->first();
        if ($item) {
            $item->quantity += $quantity;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
        $cart->load('items.product');
        return response()->json($cart);
    }

    public function remove(Request $request)
    {
        $user = $request->user();
        $productId = $request->input('product_id');
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->delete();
        $cart->load('items.product');
        return response()->json($cart);
    }

    public function updateQuantity(Request $request)
    {
        $user = $request->user();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $item = CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->first();
        if ($item) {
            $item->quantity = $quantity;
            $item->save();
        }
        $cart->load('items.product');
        return response()->json($cart);
    }

    public function checkout(Request $request)
    {
        $user = $request->user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $cart->load('items.product');
        if ($cart->items->isEmpty()) {
            return response()->json(['error' => 'Корзина пуста'], 400);
        }
        $total = $cart->items->reduce(function ($sum, $item) {
            return $sum + $item->product->price * $item->quantity;
        }, 0);
        $order = \App\Models\Order::create([
            'user_id' => $user->id,
            'total' => $total,
        ]);
        foreach ($cart->items as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'product_name' => $item->product->name,
                'product_image' => $item->product->image,
                'product_sum' => $item->product->price * $item->quantity,
                'product_category' => $item->product->category,
                'product_brand' => $item->product->brand,
            ]);
        }
        CartItem::where('cart_id', $cart->id)->delete();
        return response()->json(['success' => true]);
    }
}
