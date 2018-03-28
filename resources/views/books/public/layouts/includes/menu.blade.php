
<nav class="blue darken-1">
  <div class="nav-wrapper">
    <a href="{{route('book.list')}}" class="brand-logo left"> <i class="material-icons">ac_unit</i></a>
    <a href="#" data-target="slide-out" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li class="{{(Request::is('/')) ? 'active' : (Request::is('book*') ? 'active' : '')}}"><a href="{{route('book.list')}}">Books</a></li>
      <li class="{{(Request::is('login*')) ? 'active' : (Request::is('register*') ? 'active' : '')}}"><a href="{{route('login')}}">Get Started</a></li>
      <li><a href="{{ URL::to('documentation/')}}">Documentation</a></li>
    </ul>
  </div>
</nav>



  <ul id="slide-out" class="sidenav">
    <li class="{{(Request::is('/')) ? 'active' : (Request::is('book*') ? 'active' : '')}}"><a href="{{route('book.list')}}">Books</a></li>
      <li class="{{(Request::is('login*')) ? 'active' : (Request::is('register*') ? 'active' : '')}}"><a href="{{route('login')}}">Get Started</a></li>
      <li><a href="{{ URL::to('documentation/')}}">Documentation</a></li>
  </ul>
    