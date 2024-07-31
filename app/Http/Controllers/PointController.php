<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PointController extends Controller
{
    public function list(){
        $user = session('user');
        $userId = $user[0]->id;
        $points = Point::leftJoin('items','points.item_id','=','items.id')
        ->select('points.*','items.name')->where('points.user_id',$userId)->get();
        Log::debug($points);
        return view('point.list',['points'=>$points]);
    }   
}
