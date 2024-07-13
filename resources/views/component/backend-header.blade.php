
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="d-flex">
        <a class="navbar-brand" href="{{url('/')}}">
          <img src="{{asset('logo/logo.png')}}" alt="Logo">
        </a>
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    </div>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ request()->is('admin/dashboard') || request()->is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin-dashboard')}}">Dashboard</a>
      </li>
      <li class="nav-item {{ request()->is('admin/blogs') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('blogs')}}">Blogs</a>
</li>

      <li class="nav-item {{ request()->is('admin/menus') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('menus')}}">Menus</a>
      </li>

      <li class="nav-item {{ request()->is('admin/all-technologies') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('all-technologies')}}">Technologies</a>
      </li>

      <li class="nav-item {{ request()->is('admin/page-settingss') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('page-settings')}}">Page Settings</a>
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
  <a href="{{url('/')}}">
  <img class="mt-3" src="{{asset('logo/logo.png')}}" alt="Logo">
  </a>
    
    <ul class="navbar-nav sidebar-nav mt-2">
      <li class="nav-item {{ request()->is('admin/dashboard') || request()->is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin-dashboard')}}">Dashboard</a>
      </li>

      <li class="nav-item {{ request()->is('admin/blogs') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('blogs')}}">Blogs</a>
      </li>

      <li class="nav-item {{ request()->is('admin/menus') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('menus')}}">Menus</a>
      </li>

      <li class="nav-item {{ request()->is('admin/all-technologies') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('all-technologies')}}">Technologies</a>
      </li>

      <li class="nav-item {{ request()->is('admin/page-settings') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('page-settings')}}">Page Settings</a>
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