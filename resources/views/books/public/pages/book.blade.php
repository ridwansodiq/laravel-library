@extends('books.public.layouts.default')
@section('title') {{$book->title}} @endsection
@section('styles')
    <style>
           .tabs .indicator { background-color: #2081d7; } 
           .tabs .tab a,.tabs .tab a:hover, .tabs .tab a.active{color:#2081d7;}
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
                    @include('books.public.layouts.includes.info')
        <div class="col s12 m6 center"><img src="{{$book->book_cover}}" alt="product-img" class="responsive-img book-cover"></div>
        <div class="col s12 m6">
            <h3>{{$book->title}}</h3>
            <ul class="review-summary">
                <li class="ratings">
                    
                    <span class="full-cont" style="width:{{$book->avg_star_width}}px">
                        <span class="full-star">
                            <i class="material-icons">star</i>
                            <i class="material-icons">star</i>
                            <i class="material-icons">star</i>
                            <i class="material-icons">star</i>
                            <i class="material-icons">star</i>
                        </span>
                    </span>
                    
                    <span>
                        <i class="material-icons">star_border</i>
                        <i class="material-icons">star_border</i>
                        <i class="material-icons">star_border</i>
                        <i class="material-icons">star_border</i>
                        <i class="material-icons">star_border</i>
                    </span>
                </li>
                <li class="reviews-total  grey-text text-darken-4">{{$book->reviews_count}} Review(s)</li>
            </ul>
            <div class="col s12 divider"></div>
            <div class="col s12">
                <p>Author : {{$book->author}}</p>
            </div>
            <div class="col s12 divider"></div>
            <div class="col s12">
                <p>{{$book->description}}</p>
            </div>
            <div class="col s12 divider"></div>
            <div class="col s12">
                <p>Category : <span class="new badge blue"  data-badge-caption="" style="float:none;">{{$book->category->name}}</span></p>
                <p>Publisher : {{$book->publisher}}</p>
                <p>ISBN : {{$book->isbn}}</p>                
            </div>
            

        </div>
        <div class="col s12">
  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a  class="active" href="#reviews">Reviews</a></li>
        <li class="tab col s3"><a class="" href="#write-review">Write Review</a></li>
      </ul>
    </div>
    <div id="reviews" class="col s12">
        <div class="col s12">
                @if($book->reviews_count == 0)
                    <p class="center">No reviews yet.</p>
                @endif
                <ul class="collection">
                    @foreach($book->reviews as $review)
                    <li class="collection-item avatar">
                        <i class="material-icons circle">person_pin</i>
                        <span class="title"><b>{{$review->name}}</b></span>
                        <p>{{$review->review}}</p>
                        <ul class="review-summary">
                            <li class="ratings" style="float:none">
                                <span class="full-cont" style="width:{{$review->review_star_width}}px">
                                    <span class="full-star">
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                    </span>
                                </span>
                                
                                <span>
                                    <i class="material-icons">star_border</i>
                                    <i class="material-icons">star_border</i>
                                    <i class="material-icons">star_border</i>
                                    <i class="material-icons">star_border</i>
                                    <i class="material-icons">star_border</i>
                                </span>
                            </li>
                        </ul>

                    </li>
                    @endforeach
                </ul>
            </div>
    </div>
    
    <div id="write-review" class="col s12">
        <br>
        <div class="white col s12">
     <form method="POST" action="{{ route('review.create',['book'=>$book->id]) }}" >
                    {{ csrf_field() }}
                    <div class="col s12 m5">
                         <div class="row">
                        <div class="input-field col s12 center">
                            <p>Your Ratings</p>
                    <ul class="filter-star">
                            @for($i=5;$i>=1;$i--)
                                <li class="ratings">
                                    <label>
                                        <input type="radio" name="ratings" {{old('ratings') == $i ? 'checked' : ''}}  value="{{$i}}" class="filled-in rating-filter-check checkbox-blue" />
                                        <span class="star">
                                            @for($j=1;$j<=$i;$j++)
                                                <i class="material-icons">star</i>
                                            @endfor
                                            @for($k=1;$k<=(5 - ($j - 1));$k++)
                                                <i class="material-icons">star_border</i>
                                            @endfor
                                        </span>
                                    </label>
                                        
                                </li>
                            @endfor
                        </ul>   
                        </div>
                    </div>
                    </div>
                    <div class="col s12 m7">

                   
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="textarea2" name="review" required class="materialize-textarea" rows="10">{{old('review')}}</textarea>
                            <label for="textarea2">Book Review</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                        <input id="name" name="name" required type="text" value="{{old('name')}}" class="validate">
                        <label for="name">Name</label>
                        </div>
                        <div class="input-field col s6">
                        <input id="email" name="email" required type="email"  value="{{old('email')}}" class="validate">
                        <label for="email">E-Mail Address</label>
                        </div>
                    </div>
                    <div class="col s12 center">
                        <button class="btn waves-effect waves-light blue darken-1" type="submit" name="action">Write Review
                        </button>
                    </div>
                    </div>

                               
                </form>
    
        </div>
    </div>
  </div>

            
        </div>
    </div>
    
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function(){
    $('.tabs').tabs();
  });
</script>

@endsection