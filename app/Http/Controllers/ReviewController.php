<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Item;
use App\Models\Review;
use App\Models\ReviewGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    // レビューの一覧の表示
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

    // 新規レビューの投稿
    public function reviewAdd(ReviewRequest $request){
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

    // レビューの編集
    public function reviewEdit(ReviewRequest $request){
        $user = session('user');
        $review = Review::where('user_id',$user[0]->id)->where('item_Id',$request->item_id)->first();
        $review->update([
            'name' => $request->name,
            'comment' => $request->comment,
            'star' => $request->star,
        ]);
        return to_route('item.detail',['item'=>$request->item_id]);
    }

    // レビューにいいねをする
    public function reviewGood(Request $request){
        $user = session('user');
        $review = Review::findOrFail($request->id);
        $reviewGoodExists = ReviewGood::where('user_id',$user[0]->id)->where('review_id',$review->id)->exists();
        if(!$reviewGoodExists){
            $reviewGood = new ReviewGood();
            $reviewGood->user_id = $user[0]->id;
            $reviewGood->review_id = $review->id;
            $reviewGood->save();
        }else{
            $reviewGood = ReviewGood::where('user_id',$user[0]->id)->where('review_id',$review->id)->get();
            $reviewGood[0]->delete();
        }
    }
}
