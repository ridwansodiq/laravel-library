<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;
use App\Models\Review;
use App\Http\Requests\SaveReview;
class ReviewController extends Controller
{
    private $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function postReview(SaveReview $request,Book $book)
    {
        if($this->review->createReview($request,$book)){
            return redirect()->back()->with(['success'=>'Your review has been successfully added.']);
         }
         return redirect()->back()->with(['fail'=>'Unable to add your review at the moment, please try again.']);
    }
    
}
