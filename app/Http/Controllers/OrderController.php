<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\History;
use App\Models\Order;
use App\Models\Point;
use App\Models\usePoint;
use DateTime;
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
        $carts = Cart::where('user_id',$user->id)->where('after_flg',0)->get();
        return view('order.confirm',['carts'=>$carts,'totalPrice'=>$totalPrice,'totalCount'=>$totalCount]);
    }

    // カートの商品を購入
    public function payment(Request $request){
        $user = session('user');
        $carts = Cart::where('user_id',$user[0]->id)->where('after_flg',0)->get();
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
        $point = new Point();
        $point->user_id = $user[0]->id;
        $totalPrice = session('totalPrice');
        $point->point = $totalPrice/100;
        $point->save();

        $usePoint = new usePoint();
        $usePoint->user_id = $user[0]->id;
        $usePoint->point = $request->point;
        $today = new DateTime();
        $usePoint->use_date = $today;
        $usePoint->save();
        
        $totalPoint = Point::selectRaw('SUM(point) as total_point')
        ->groupBy('user_id')->where('user_id',$user[0]->id)->first();
        $useTotalPoint = usePoint::selectRaw('SUM(point) as total_point')
        ->groupBy('user_id')->where('user_id',$user[0]->id)->first();
        if($totalPoint != ''){
            session(['totalPoint' => $totalPoint->total_point - $useTotalPoint->total_point]);
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
