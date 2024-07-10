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
        $historys = History::where('user_id',$user[0]->id)->get();
        return view('history.list',['historys'=>$historys]);
    }
}
