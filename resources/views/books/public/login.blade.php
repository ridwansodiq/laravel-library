@extends('books.public.layouts.default')
@section('title') Login @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 m7 " style="float: none;margin:auto;">
            @include('books.public.layouts.includes.info')
            <div class="col s12 white" style="padding:20px">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12">
                        <input id="email" name="email" required type="email"  value="{{old('email')}}" class="validate">
                        <label for="email">E-Mail Address</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                        <input id="password"  name="password" required type="password" class="validate">
                        <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="center">
                        <button class="btn waves-effect waves-light blue darken-1" type="submit" name="action">Login
                            <i class="material-icons right">send</i>
                        </button>
                        <a class="btn waves-effect waves-light blue darken-1" href="{{route('register')}}" name="action">Signup
                            <i class="material-icons right">send</i>
                        </a>
                    </div>           
                </form>
            </div>
        </div>
    </div>
    
</div>

@endsection