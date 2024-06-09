<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCartRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Http\Resources\CartCollection;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userCart = Cart::all()->where("user_id", auth()->user()->id);
        return new CartCollection($userCart);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCartRequest $request)
    {
        $request->Validated($request->all());
        $product = Product::findOrFail($request['product_id']);

        $CartItem = DB::table('carts')->insertGetId([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'sub_total' => $product->unit_price * $request->quantity,
        ]);
        
        $newCartItem = Cart::findOrFail($CartItem);
        return new CartCollection(collect([$newCartItem]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        return new CartCollection(collect([$cart]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CartUpdateRequest $request, Cart $cart)
    {
        $request->Validated($request->all());
        $product = Product::findOrFail($cart['product_id']);

        $cart->update([
            'quantity' => $request->quantity,
            'sub_total' => $product->unit_price * $request->quantity,
        ]);

        $cartItem = Cart::findOrFail($cart['id']);
        return new CartCollection(collect([$cartItem]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response()->json(['message' => 'Product Removed.'], 204);
    }
}
