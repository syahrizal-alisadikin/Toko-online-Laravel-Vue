<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('fk_customer_id', auth()->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Cart',
            'cart'    => $carts
        ]);
    }

    public function store(Request $request)
    {
        $item = Cart::where('fk_product_id', $request->fk_product_id)
            ->where('fk_customer_id', $request->fk_customer_id);

        if ($item->count()) {
            // increment quantity
            $item->increment('quantity');
            $item = $item->first();

            // sum price * quantity
            $price = $request->price * $item->quantity;

            // sum Weight
            $weight = $request->weight * $item->quantity;

            $item->update([
                'price' => $price,
                'weight' => $weight
            ]);
        } else {
            $item = Cart::create([
                'fk_product_id' => $request->fk_product_id,
                'fk_customer_id' => $request->fk_customer_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'weight' => $request->weight
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Success Add To Cart',
                'quantity' => $item->quantity,
                'product' => $item->product,
            ]);
        }
    }

    public function getCartTotal()
    {
        $carts = Cart::with('product')
            ->where('fk_customer_id', auth()->user()->id)
            ->latest()
            ->sum('price');

        return response()->json([
            'success' => true,
            'message' => 'Total Cart Price ',
            'total'   => $carts
        ]);
    }

    public function getCartTotalWeight()
    {
        $carts = Cart::with('product')
            ->where('fk_customer_id', auth()->user()->id)
            ->latest()
            ->sum('weight');

        return response()->json([
            'success' => true,
            'message' => 'Total Cart Weight ',
            'total'   => $carts
        ]);
    }

    public function removeCart(Request $request)
    {
        Cart::with('product')
            ->whereId('$request->cart_id')
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Remove Item Cart',
        ]);
    }

    public function removeAllCart(Request $request)
    {
        Cart::with('product')
            ->where('fk_customer_id', auth()->guard('api')->user()->id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Remove All Item in Cart',
        ]);
    }
}
