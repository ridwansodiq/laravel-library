@extends('books.layouts.default')
@section('title') Create - Book @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 m6 " style="float: none;margin: auto;">
            @include('books.public.layouts.includes.info')
            <div class="col s12 white" style="padding:20px">
                <form method="POST" action="{{route('book.create')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12 m6">
                        <input id="book_title" name="title" required type="text" value="{{old('title')}}" class="validate">
                        <label for="book_title">Book Title</label>
                        </div>
                        <div class="input-field col s12 m6">
                        <input id="isbn"  name="isbn" required type="text" value="{{old('isbn')}}" class="validate">
                        <label for="isbn">Book ISBN</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                        <input id="author"  name="author" required type="text" value="{{old('author')}}" class="validate">
                        <label for="author">Author</label>
                        </div>
                        <div class="input-field col s6">
                        <input id="published_year"  name="published_year" required value="{{old('published_year')}}" type="text" class="validate">
                        <label for="published_year">Year Published</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s12">
                            <select id="category" name="book_category" required>
                                <option value="" disabled selected>Choose Book Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{old('category') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach  
                                </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="textarea2" name="description" required class="materialize-textarea" rows="10">{{old('description')}}</textarea>
                            <label for="textarea2">Book Summary</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6" >
                            <div class="file-field input-field" style="margin-top:0;">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file" name="book_cover" accept="image/*" >
                                </div>
                                <div class="file-path-wrapper">
                                    <input id="book_cover" class="file-path validate" type="text" placeholder="Book Cover">
                                </div>
                            </div>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="publisher"  name="publisher" value="{{old('publisher')}}" required type="text" class="validate">
                            <label for="publisher">Publisher</label>
                        </div>
                    </div>
                    <div class="center">
                        <button class="btn waves-effect waves-light blue darken-1" type="submit" name="action">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </div>           
                </form>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('select').formSelect();
        });
    </script>
@endsection