<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Http\Requests\SaveBook;
class BookController extends Controller
{
    private $book;
    
    /**
    * Injecting the Book model into the book controller
    *
    */    
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Show the home page and passes book categories to the view.
     *
     * @return \Illuminate\Http\Response
     */    
    public function getBookHome()
    {
        if(Auth::check()){
           return view('books.pages.list',['categories'=>Category::filterCategory()]);
        }
        return view('books.public.pages.list',['categories'=>Category::filterCategory()]);
    }
    
    /**
     * Shows the book page using the book id passed into the param.
     *
     * @param \App\Models\Book
     * @return \Illuminate\Http\Response
     */ 
    public function getBook(Book $book)
    {
        if(Auth::check()){
           return view('books.pages.book',['book'=>$book->getBook()]);
        }
        return view('books.public.pages.book',['book'=>$book->getBook()]);
    }
    
    /**
     * Returns a paginated view of all the books.
     *
     * @param \App\Models\Book
     * @return \Illuminate\Http\Response
     */
    public function getBooks()
    {
        return view('books.pages.books', ['books' => $this->book->getAll(6)]);
    }

    /**
     * A post request to filter all books using the search function in the book model.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
    */
    public function postBooks(Request $request)
    {
        return view('books.pages.books', ['books' => $this->book->search($request,6)]);
    }
    
    /**
     * Show the create book page and pass the book categories to the view.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
    */
    public function getCreateBook()
    {
        $categories = Category::all();
        return view('books.pages.create',['categories'=>$categories]);
    }

    /**
     * Post request function to create new book. 
     *
     * @param \App\Http\Requests\SaveBook
     * @return \Illuminate\Http\Response
    */
    public function postCreateBook(SaveBook $request)
    {
         if($this->book->createBook($request)){
             return redirect()->back()->with(['success'=>'New book successfully added.']);
         }
         return redirect()->back()->with(['fail'=>'Unable to create book, please try again.']);
    }
}
