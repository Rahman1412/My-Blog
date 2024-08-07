<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
  <div class="container mr-auto">
    <a class="navbar-brand" href="{{url('/admin/')}}">
      <img src="{{asset('logo/logo.png')}}" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
  <div  class="collapse navbar-collapse" id="navbarScroll">
    <ul class="navbar-nav justify-content-end p-2">
      <li class="nav-item {{ request()->is('home') || request()->is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/home')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item {{ request()->is('about-us') ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/about-us')}}">About Us</a>
      </li>
      <li class="nav-item {{ request()->is('contact-us') ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/contact-us')}}">Contact Us</a>
      </li>
      <li class="nav-item {{ request()->is('blogs') ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/blog')}}">Blogs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li>
    </ul>
  </div>
</nav>