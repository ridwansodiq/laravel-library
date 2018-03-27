<?php 

namespace App\Validators;

use App\Models\Review;

class UniqueUserReview extends \Illuminate\Validation\Validator
{

    function validateUniqueUserReview( $attribute, $value, $parameters, $validator ) 
    {
        return UniqueUserReview::uniqueUserReview( $attribute, $value, $parameters ) ; 
    }

    static function uniqueUserReview( $attribute, $value, $parameters ) {
        $review = new Review();
        $request = (object) ['email'=>$value,'book_id'=>$parameters[0]];
        return $review->DuplicateReview($request);
    }
}