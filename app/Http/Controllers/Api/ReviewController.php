<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Review;
use App\Models\Book;
use App\Http\Requests\SaveReview;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    private $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }
    
    public function postAddReview(Request $request,Book $book)
    {
        $saveRequest = new SaveReview();
        $validator = Validator::make($request->all(),$saveRequest->rules());
        if($validator->passes()){
            if($this->review->createReview($request,$book))
                return response()->json(['success'=>'Your review has been successfully added.']);
            
            return response()->json(['error'=>'Unable to add your review at the moment, please try again.'],500);
        }
        if($validator->fails())
            return response()->json(['error' => $validator->errors()->all()],422);
    }
}
