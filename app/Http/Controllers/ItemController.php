<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    // アイテムの一覧を表示
    public function list(){
        // $items = Item::leftJoin('reviews', 'items.id', '=', 'reviews.item_id')
        // ->select('items.*', 'reviews.star')
        // ->orderBy('items.id')
        // ->get();
        $items = Item::with('reviews')->orderBy('id')->get();
        return view('item.list',['items'=>$items]);
    }

    // アイテムの詳細を表示
    public function detail(String $id){
        $item = Item::findOrFail($id);
        // $reviews = Review::where('item_id',$id)->orderBy('id','desc')->get();
        $user = session('user');
        if($user != null){
            $userId = $user[0]->id;
        }else{
            $userId = 0;
        }
        $reviews = Review::select('reviews.*', 
        DB::raw('CASE WHEN rt.totalcount IS NULL THEN 0 ELSE rt.totalcount END AS totalCount'), 
        'rg.user_id as rgUserId')
        ->leftJoin(
            DB::raw('(SELECT review_id, COUNT(*) as totalCount FROM review_goods GROUP BY review_id) AS rt'),
            'reviews.id', '=', 'rt.review_id'
        )
        ->leftJoin(
            DB::raw('(SELECT * FROM review_goods WHERE user_id =?) AS rg'),
            'reviews.id', '=', 'rg.review_id'
        )
        ->addBinding([$userId], 'join')
        ->where('reviews.item_id',$id)
        ->orderBy('reviews.id','desc')
        ->get();
        return view('item.detail',['item'=>$item,'reviews'=>$reviews]);
    }

    // アイテムをカートに加える
    public function itemAdd(String $id, Request $request){
        $user = session('user');
        if($user == null){
            $redirectUrl = route('user.toLogin');
            return response()->json(['redirect_url' => $redirectUrl]);
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

    // ジャンル用にアイテム一覧を確保
    public function genreList(){
        $itemsByGenre = Item::All();
        $genreList = [];
        foreach($itemsByGenre as $item){
            $genreList[$item->genre] = $item->genre;
        }
        session(['genreList' => $genreList]);
    }

    // アイテムを検索する
    public function itemSearch(Request $request){
        $searchItems = Item::where('name', 'LIKE' ,'%'.$request->search.'%')->get();
        session(['searchItems' => $searchItems]);
        $redirectUrl = route('item.list');
        return response()->json(['redirect_url' => $redirectUrl]);
    }

    public function genre(Request $request){
        if($request->genre == 'all'){
            $items = Item::All();
        }else{
            $items = Item::where('genre',$request->genre)->get();
        }
        session(['searchItems' => $items,'genre' => $request->genre]);
        $redirectUrl = route('item.list');
        return response()->json(['redirect_url' => $redirectUrl]);
    }
}
