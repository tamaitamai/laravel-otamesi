<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $user->address = $request->address;
        $user->save();
        return view('user.login');
    }    

    public function logOut(){
        // session()->flush();
        session()->forget('user');
        return to_route('user.toLogin');
    }

    public function edit(Request $request){
        $user = session('user');
        $user[0]->update([
            'name' => $request->name,
            'mail' => $request->mail,
            'password' => $request->password,
            'address' => $request->address
        ]);
        $updateUser = User::where('mail',$request->mail)->where('password',$request->password)->get();
        session(['user'=>$updateUser]);
        return to_route('item.list');
    }
}
