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

    public function __construct(Book $book)
    {
        $this->book = $book;
    }
    public function getBookHome()
    {
        // dd(Auth::check());
        // $faker = Faker::create();
        // $this->book->create([
        //     'isbn' => $faker->isbn10,
        //     'title' => $faker->sentence(5),
        //     'author' => $faker->name($gender = 'male'|'female'),
        //     'description' => $faker->text,
        //     'book_cover' => $faker->imageUrl(400, 500, 'nature', true, 'Faker'),
        //     'book_category'=> Category::all()->random(1)[0]->id,
        //     'published_year' => $faker->year,
        //     'publisher' => $faker->company,
        //     'posted_by' => User::first()->id,
        //     'status' => 1,
        // ]);
        if(Auth::check()){
           return view('books.pages.list',['categories'=>Category::filterCategory()]);
        }
        return view('books.public.pages.list',['categories'=>Category::filterCategory()]);

    }
    public function getBook(Book $book)
    {
        if(Auth::check()){
           return view('books.pages.book',['book'=>$book->getBook()]);
        }
        return view('books.public.pages.book',['book'=>$book->getBook()]);

    }

    public function getBooks()
    {
        return view('books.pages.books', ['books' => $this->book->getAll(6)]);
    }
    public function postBooks(Request $request)
    {
        return view('books.pages.books', ['books' => $this->book->search($request,6)]);
    }
    

    public function getCreateBook()
    {
        $categories = Category::all();
        return view('books.pages.create',['categories'=>$categories]);
    }

    public function postCreateBook(SaveBook $request)
    {
         if($this->book->createBook($request))
             return redirect()->back()->with(['success'=>'New book successfully added.']);
    
         return redirect()->back()->with(['fail'=>'Unable to create book, please try again.']);
    }
}
