<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use DB;
class Book extends Eloquent
{
    protected $table = 'book_list';
    protected $fillable = [
        'isbn','title', 'author', 'description','book_cover','published_year','book_category','publisher','avg_ratings','posted_by'
    ];

    protected $attributes  = [
        'isbn' => '',
        'title' => '',
        'author' => '',
        'avg_ratings'=> 0,
        'description' => '',
        'book_cover' => '',
        'published_year' => '',
        'publisher' => '',
        'posted_by' => '',
        'status' => 1,
    ];
    protected $casts  = [
        'avg_ratings' => 'integer',
        'published_year' => 'integer',
        'status' => 'integer',
    ];



    public function category()
    {
        return $this->belongsTo("App\Models\Category",'book_category');
    }

    public function reviews()
    {
        return $this->hasMany("App\Models\Review",'book_id');
    }
    
    public function avgRating(){
        return $this->reviews->avg('ratings');
    }    
    
    public function getReviewsCountAttribute(){
        return $this->reviews->count();
    }
    public function getAvgStarWidthAttribute()
    {
        return ($this->avg_ratings / 5) * 140;
    }
        
    public function getBook(){
        return $this->load(['category','reviews' => function ($query) {
                $query->select('book_id','ratings','review','name');
            }]);
    }
    
    public function getAll($paginate = ''){
        if($paginate)
            return Book::with('category')->orderBy('created_at', 'desc')->paginate($paginate);
        return Book::with('category')->orderBy('created_at', 'desc')->get();
    }

    public function createBook($request){
        $data = $this->uploadBookCover($request);
        if($data){
            $book = new Book();
            if($book->create($data)){
                return true;
            }
        }        
        return false;        
    }

    private function uploadBookCover($request){
        $new_file_name = str_random().uniqid().'.'.$request->book_cover->getClientOriginalExtension();
        $upload = Storage::disk('s3')->putFileAs('libraryimages', $request->file('book_cover'),$new_file_name,'public');
        if(!$upload)
            return false;
        $data = $request->only([ 'isbn','title', 'author', 'description','published_year','book_category','publisher']);    
        $data['book_cover'] = Storage::disk('s3')->url('libraryimages/'.$new_file_name);
        $data['posted_by'] = Auth::user()->id;
        return $data;
    }
    public function updateAvgRatings(){
        return $this->update(['avg_ratings'=>$this->avgRating()]);
    }

    public function search($request,$paginate){
        $books = Book::with('category'); 
        if($request->filter_category)
            $books->whereIn('book_category',$request->filter_category);   
        if($request->filter_star)
        {
            $star = (int) $request->filter_star;
            $books->where('avg_ratings','>=',$star);
            $books->where('avg_ratings','<',$star + 1);
        }           
        return $books->orderBy('created_at', 'desc')->paginate($paginate);
    }
}