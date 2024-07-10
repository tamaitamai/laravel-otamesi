<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Debug;

class CartController extends Controller
{
    //カート一覧の確保
    public function index()
    {
        $user = session('user');
        if($user==null){
            return view('user.login');
        }
        $carts = Cart::where('user_id',$user[0]->id)->get();
        $totalPrice=0;
        $totalCount=0;
        foreach($carts as $cart){
            $totalPrice+=$cart->price*$cart->count;
            $totalCount+=$cart->count;
        }
        return view('cart.cartList',['carts' => $carts
                                    ,'totalPrice'=>$totalPrice
                                    ,'totalCount'=>$totalCount]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    public function update(Request $request,String $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update([
            'count' => $request->count,
        ]);
        return to_route('cart.index');
    }

    //カートの中身を削除    
    public function destroy(String $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return to_route('cart.index');
    }
}
