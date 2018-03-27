<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Title -->
    <title>@yield('title') | Book Library</title>
    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ URL::to('assets/books/material/css/materialize.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::to('assets/books/css/custom.css')}}"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('styles')

</head>
<body class="indigo lighten-5">
    @include('books.public.layouts.includes.menu')
    <section class="page-content">
        <!-- Page Content goes here -->
         @yield('content')
    </section>
<footer class="page-footer page-footer no-padding center blue darken-1">
          <div class="footer-copyright">
            <div class="container">
             &copy {{date('Y')}} Copyright
            </div>
          </div>
        </footer>
          <a id="scrollTop" class="btn-floating btn-large waves-effect waves-light red" style="
    position: fixed;
    bottom: 0;
    right: 0;
    margin: 50px 10px 60px;
"><i class="material-icons">arrow_upward</i></a>
</body>
<!-- Javascripts -->
<script src="{{ URL::to('assets/books/js/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::to('assets/books/material/js/materialize.min.js')}}"></script>
<script src="{{ URL::to('assets/books/js/custom.js')}}"></script>
<script>
    $(document).ready(function(){
        $("a#scrollTop").click(function() {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });
        $(".dropdown-trigger").dropdown();
        $('.sidenav').sidenav();
    })
</script>
@yield('scripts')
</html>