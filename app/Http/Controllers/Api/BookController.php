<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Book;
use App\Http\Requests\SaveBook;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }
    
    public function getBooks()
    {
        return response()->json(['books' => $this->book->getAll()]);
    }

    public function getBook(Book $book)
    {
        return response()->json(['book'=>$book->getBook()]);
    }

    public function postAddBook(Request $request)
    {
        $saveRequest = new SaveBook();
        $validator = Validator::make($request->all(),$saveRequest->rules());
        if($validator->passes()){
            if($this->book->createBook($request))
                return response()->json(['success'=>'New book successfully added.']);
            
            return response()->json(['error'=>'Unable to create book, please try again.'],500);
        }
        if($validator->fails())
            return response()->json(['error' => $validator->errors()->all()],422);
    }

}
