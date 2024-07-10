<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Debug;

class ReviewController extends Controller
{
    public function review(String $id){
        $user = session('user');
        $reviewExists = Review::where('user_id',$user[0]->id)->where('item_Id',$id)->exists();
        $review = new Review();
        if($reviewExists){
            $review = Review::where('user_id',$user[0]->id)->where('item_Id',$id)->get();
        }
        if($user != null){
            return view('review.review',['itemId'=>$id,'review'=>$review]);
        }
        return view('user.login');
    }

    public function reviewAdd(Request $request){
        $user = session('user');
        $review = new Review();
        $review->name = $request->name;
        $review->comment = $request->comment;
        $review->item_id = $request->item_id;
        $review->user_id = $user[0]->id;
        $review->star = $request->star;
        $review->save();
        $item = Item::findOrFail($request->item_id);
        return to_route('item.detail',['item'=>$item->id]);
    }

    public function reviewEdit(Request $request){
        $user = session('user');
        $review = Review::where('user_id',$user[0]->id)->where('item_Id',$request->item_id)->first();
        $review->update([
            'name' => $request->name,
            'comment' => $request->comment,
            'star' => $request->star,
        ]);
        return to_route('item.detail',['item'=>$request->item_id]);
    }
}
