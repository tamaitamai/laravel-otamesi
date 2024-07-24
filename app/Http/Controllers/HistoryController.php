<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HistoryController extends Controller
{
    public function list(){
        $user = session('user');
        if($user==null){
            return view('user.login');
        }
        // $historys = History::where('user_id',$user[0]->id)->orderBy('id','desc')->get();
        $historys = History::leftjoin('orders','histories.cart_id','=','orders.cart_id')
        ->select('histories.*','orders.order_date')
        ->where('histories.user_id',$user[0]->id)->orderBy('histories.id','desc')->get();
        return view('history.list',['historys'=>$historys]);
    }
}
