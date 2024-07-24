<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\History;
use App\Models\Order;
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
        $carts = Cart::where('user_id',$user[0]->id)->where('after_flg',0)->get();
        $cartsByAfter = Cart::where('user_id',$user[0]->id)->where('after_flg',1)->get();
        $totalPrice=0;
        $totalCount=0;
        foreach($carts as $cart){
            $totalPrice+=$cart->price*$cart->count;
            $totalCount+=$cart->count;
        }
        session(['totalPrice'=>$totalPrice,'totalCount'=>$totalCount]);
        return view('cart.cartList',['carts' => $carts
                                    ,'cartsByAfter' => $cartsByAfter
                                    ,'totalPrice' => $totalPrice
                                    ,'totalCount' => $totalCount]);
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

    // あとで買う一覧に移動
    public function after(String $cartId){
        $cart = Cart::findOrFail($cartId);
        $cart->update([
            'after_flg' => 1,
        ]);
        return to_route('cart.index');
    }

    // カートに戻す
    public function return(String $cartId){
        $cart = Cart::findOrFail($cartId);
        $cart->update([
            'after_flg' => 0,
        ]);
        return to_route('cart.index');
    }
}
