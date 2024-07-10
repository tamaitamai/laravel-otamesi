<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function otamesi(){
        $items = Item::All();
        $item = Item::findOrFail(1);
        Log::debug($item->name);
        return view('hello',['items'=>$items]);
    }

    public function list(){
        $items = Item::All();
        return view('item.list',['items'=>$items]);
    }

    public function detail(String $id){
        $item = Item::findOrFail($id);
        $reviews = Review::where('item_id',$id)->orderBy('id','desc')->get();
        return view('item.detail',['item'=>$item,'reviews'=>$reviews]);
    }

    public function itemAdd(String $id, Request $request){
        $user = session('user');
        if($user == null){
            return to_route('user.toLogin');
        }
        $item = Item::findOrFail($id);
        $cart = new Cart();
        $cart->user_id = $user[0]->id;
        $cart->item_id = $item->id;
        $cart->image=$item->image;
        $cart->name=$item->name;
        $cart->price=$item->price;
        $cart->count=$request->count;
        $cart->save();
        return to_route('item.list');
    }
}
