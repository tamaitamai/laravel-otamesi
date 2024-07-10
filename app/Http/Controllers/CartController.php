<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\History;
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

    // カートの商品数を変更
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

    // カートの商品を購入
    public function payment(){
        $user = session('user');
        $carts = Cart::where('user_id',$user[0]->id)->get();
        foreach($carts as $cart){
            $history = new History();
            $history->user_id = $user[0]->id;
            $history->item_id = $cart->item_id;
            $history->name = $cart->name;
            $history->image = $cart->image;
            $history->price = $cart->price;
            $history->count = $cart->count;
            $history->save();
            $cart->delete();
        }
        return view('cart.payment');
    }
}
