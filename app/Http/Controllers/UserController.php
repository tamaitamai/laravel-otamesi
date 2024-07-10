<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request){
        $user = User::where('mail',$request->mail)->where('password',$request->password)->get();
        session(['user' => $user]);
        return to_route('item.list');
    }

    public function insert(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->mail = $request->mail;
        $user->password = $request->password;
        $user->save();
        return view('user.login');
    }    

    public function logOut(){
        // session()->flush();
        session()->forget('user');
        return to_route('user.toLogin');
    }
}
