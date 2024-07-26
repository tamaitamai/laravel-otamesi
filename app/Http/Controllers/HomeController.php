<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function home(){
        $itemRanks = DB::table(DB::raw('(SELECT item_id,SUM(count) AS totalCount FROM histories GROUP BY item_id) AS hc'))
        ->select('i.*','hc.totalCount')->leftJoin('items AS i','hc.item_id','=','i.id')
        ->orderBy('totalCount','desc')
        ->limit(20)
        ->get();
        return view('home',['itemRanks'=>$itemRanks]);
    }
}
