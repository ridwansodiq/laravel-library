 @foreach($books as $book)
        <div class="col s12 m4">
            <div class="card">
                
                <a href="{{route('book.index',['book'=>$book->id])}}">
                    <div class="card-image waves-effect waves-block waves-light">
                    <img src="{{$book->book_cover}}" alt="product-img">
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <ul class="review-summary"><li class="ratings">
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
                            <div class="col s12">
                                <p class="book-title card-title grey-text text-darken-4"><span>{{$book->title}}</span>
                                </p>
                                <span class="new badge blue"  data-badge-caption="">{{$book->category->name}}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
     @endforeach