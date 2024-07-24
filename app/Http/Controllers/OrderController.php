<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\History;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Debug;

class OrderController extends Controller
{
    // 注文確認画面に遷移
    public function confirm(){
        $user = session('user')[0];
        $totalPrice = session('totalPrice');
        $totalCount = session('totalCount');
        $carts = Cart::where('user_id',$user->id)->get();
        return view('order.confirm',['carts'=>$carts,'totalPrice'=>$totalPrice,'totalCount'=>$totalCount]);
    }

    // カートの商品を購入
    public function payment(Request $request){
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
            $history->cart_id = $cart->id;
            $history->save();
            $cart->delete();

            $order = new Order();
            $order->cart_id = $cart->id;
            $orderDate = 'order_date'.$cart->id;
            $order->order_date = $request->$orderDate;
            $order->save();
        }
        return view('order.payment');
    }

    // 配送状況の確認
    public function delivery(String $historyId){
        $history = History::leftjoin('orders','histories.cart_id','=','orders.cart_id')
        ->select('histories.*','orders.order_date')
        ->where('histories.id',$historyId)
        ->orderBy('histories.id','desc')->get();
        return view('order.delivery',['history' => $history[0]]);
    }

    // 注文詳細の確認
    public function detail(String $historyId){
        $history = History::leftjoin('orders','histories.cart_id','=','orders.cart_id')
        ->select('histories.*','orders.order_date')
        ->where('histories.id',$historyId)
        ->orderBy('histories.id','desc')->get();
        return view('order.detail',['history'=>$history[0]]);
    }
}
