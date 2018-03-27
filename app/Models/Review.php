<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Review extends Eloquent
{
    protected $table = 'book_ratings';
    protected $fillable = [
        'book_id','ratings','review','name','email'
    ];
    protected $attributes  = [
        'book_id' => '',
        'ratings' => '',
        'review' => '',
        'name' => '',
        'email' => '',
        'status' => 1,
    ];
    protected $casts  = [
        'ratings' => 'integer',
        'status' => 'integer',
    ];

    public function book()
    {
        return $this->belongsTo("App\Models\Book",'book_id');
    }

    public function getReviewStarWidthAttribute()
    {
        return ($this->ratings / 5) * 140;
    }
    
    public function createReview($request,$book){
        $request->merge(['book_id'=>$book->id]);
        $review = new Review();
        if($s_review = $review->create($request->all())){
            $s_review->book->updateAvgRatings();
            return true;
        }
        return false;
    }

    public function DuplicateReview($request){
       $review = Review::where('email',$request->email)->where('book_id',$request->book_id)->count(); 
       if($review)
            return false; 
       return true;
    }

}
