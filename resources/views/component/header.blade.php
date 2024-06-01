

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="d-flex">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    </div>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin-dashboard')}}">Dashboard</a>
      </li>
      <li class="nav-item {{ request()->is('blogs') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('blogs')}}">Blogs</a>
      </li>

      <li class="nav-item {{ request()->is('category') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('category')}}">Category</a>
      </li>
      
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li> -->
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar text-center">
    <img class="mt-3" src="https://cc-prod.scene7.com/is/image/CCProdAuthor/mascot-logo-design_P1_900x420?$pjpeg$&jpegSize=200&wid=900">
    <ul class="navbar-nav sidebar-nav mt-2">
      <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin-dashboard')}}">Dashboard</a>
      </li>

      <li class="nav-item {{ request()->is('blogs') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('blogs')}}">Blogs</a>
      </li>

      <li class="nav-item {{request()->is('new-blog') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('new_blog')}}">New Blog</a>
      </li>

      <li class="nav-item {{ request()->is('category') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('category')}}">Category</a>
      </li>

      <!-- <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li> -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li> -->
    </ul>
</div>