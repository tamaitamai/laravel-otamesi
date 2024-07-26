<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    // お気に入り一覧
    public function list(){
        $user = session('user');
        if($user == null){
            return to_route('user.toLogin');
        }
        $userId = $user[0]->id;
        $favorites = Favorite::leftJoin('items','favorites.item_id','=','items.id')->where('user_id',$userId)->get();
        $genreList = [];
        foreach($favorites as $favorite){
            $genreList[$favorite->genre] = $favorite->genre;
        }
        /** @var \Illuminate\Session\Session $session */
        $session = session();
        $session->forget('selectGenres');        
        session(['favoriteGenreList'=>$genreList]);
        return view('favorite.list',['favorites'=>$favorites]);
    }

    // お気に入りに追加
    public function add(Request $request){
        $favorite = new Favorite();
        $user = session('user');
        $userId = $user[0]->id;
        $exists = Favorite::where('user_id',$userId)->where('item_id',$request->id)->exists();

        if($exists){
            $favorite = Favorite::where('user_id',$userId)->where('item_id',$request->id)->get();
            $favorite[0]->delete();
        }else{
            $favorite->item_id = $request->id;
            $favorite->user_id = $userId;    
            $favorite->save();    
        }
    }

    public function genre(Request $request){
        $genres = $request->input('genre', []);
        $user = session('user');
        $userId = $user[0]->id;
        if($request->reset){
            $favorites = Favorite::leftJoin('items','favorites.item_id','=','items.id')
            ->where('user_id',$userId)->get();
            /** @var \Illuminate\Session\Session $session */
            $session = session();
            $session->forget('selectGenres');
        }else{
            $favorites = Favorite::leftJoin('items','favorites.item_id','=','items.id')
            ->whereIn('genre', $genres)->where('user_id',$userId)->get();    
            session(['selectGenres'=>$genres]);
        }
        return view('favorite.list',['favorites'=>$favorites]);
    }
}
