@extends('app')

@section('style')

<link rel="stylesheet" href="{{asset('assets/css/home.css')}}">

@endsection

@section('content')

<div class="container-fluid">

      <div class="row p-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
        <div id="demo" class="carousel slide" data-ride="carousel">
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
          </ul>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="https://picsum.photos/500/1000" alt="Los Angeles" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Los Angeles</h3>
                <p>We had such a great time in LA!</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="https://picsum.photos/200/300" alt="Chicago" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Chicago</h3>
                <p>Thank you, Chicago!</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="https://picsum.photos/200/300" alt="New York" width="1100" height="500">
              <div class="carousel-caption">
                <h3>New York</h3>
                <p>We love the Big Apple!</p>
              </div>   
            </div>
          </div>
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div>
        </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 trending-section">
            <div class="trending">
              <h3>Trending Blogs</h3>
            <div class="trending-items">

            <div class="d-flex trending-item">
              <div class="p-2 trending-image">
                <img src="https://via.placeholder.com/150" alt="">
              </div>
              <div class="p-2 flex-grow-1">
                <div class="trending-title">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odit, sed.
                </div>
                <div class="d-flex trending-tags">
                <span class="badge badge-dark">Dark</span>
                <span class="badge badge-dark">Dark</span>
                <span class="badge badge-dark">Dark</span>
                </div>
              </div>
            </div>

            <div class="d-flex trending-item">
              <div class="p-2 trending-image">
                <img src="https://via.placeholder.com/150" alt="">
              </div>
              <div class="p-2 flex-grow-1">
                <div class="trending-title">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odit, sed.
                </div>
                <div class="d-flex trending-tags">
                <span class="badge badge-dark">Dark</span>
                <span class="badge badge-dark">Dark</span>
                <span class="badge badge-dark">Dark</span>
                </div>
              </div>
            </div>


            <div class="d-flex trending-item">
              <div class="p-2 trending-image">
                <img src="https://via.placeholder.com/150" alt="">
              </div>
              <div class="p-2 flex-grow-1">
                <div class="trending-title">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odit, sed.
                </div>
                <div class="d-flex trending-tags">
                <span class="badge badge-dark">Dark</span>
                <span class="badge badge-dark">Dark</span>
                <span class="badge badge-dark">Dark</span>
                </div>
              </div>
            </div>

            <div class="d-flex trending-item">
              <div class="p-2 trending-image">
                <img src="https://via.placeholder.com/150" alt="">
              </div>
              <div class="p-2 flex-grow-1">
                <div class="trending-title">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odit, sed.
                </div>
                <div class="d-flex trending-tags">
                <span class="badge badge-dark">Dark</span>
                <span class="badge badge-dark">Dark</span>
                <span class="badge badge-dark">Dark</span>
                </div>
              </div>
            </div>

            <div class="d-flex trending-item">
              <div class="p-2 trending-image">
                <img src="https://via.placeholder.com/150" alt="">
              </div>
              <div class="p-2 flex-grow-1">
                <div class="trending-title">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odit, sed.
                </div>
                <div class="d-flex trending-tags">
                <span class="badge badge-dark">Dark</span>
                <span class="badge badge-dark">Dark</span>
                <span class="badge badge-dark">Dark</span>
                </div>
              </div>
            </div>

            <div class="d-flex trending-item">
              <div class="p-2 trending-image">
                <img src="https://via.placeholder.com/150" alt="">
              </div>
              <div class="p-2 flex-grow-1">
                <div class="trending-title">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odit, sed.
                </div>
                <div class="d-flex trending-tags">
                <span class="badge badge-dark">Dark</span>
                <span class="badge badge-dark">Dark</span>
                <span class="badge badge-dark">Dark</span>
                </div>
              </div>
            </div>


            </div>
          </div>
      </div>
  
        <div class="row p-3">
           <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <!-- Card Image -->
                    <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <!-- Card Title -->
                      <h5 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, nulla.</h5>
                      <!-- Card Content -->
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <!-- Optional Button -->
                      <a href="blog.html" class="btn btn-dark">Read More</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <!-- Card Image -->
                    <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <!-- Card Title -->
                      <h5 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, nulla.</h5>
                      <!-- Card Content -->
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <!-- Optional Button -->
                      <a href="blog.html" class="btn btn-dark">Read More</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <!-- Card Image -->
                    <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <!-- Card Title -->
                      <h5 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, nulla.</h5>
                      <!-- Card Content -->
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <!-- Optional Button -->
                      <a href="blog.html" class="btn btn-dark">Read More</a>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <!-- Card Image -->
                    <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <!-- Card Title -->
                      <h5 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, nulla.</h5>
                      <!-- Card Content -->
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <!-- Optional Button -->
                      <a href="blog.html" class="btn btn-dark">Read More</a>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <!-- Card Image -->
                    <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <!-- Card Title -->
                      <h5 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, nulla.</h5>
                      <!-- Card Content -->
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <!-- Optional Button -->
                      <a href="blog.html" class="btn btn-dark">Read More</a>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <!-- Card Image -->
                    <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <!-- Card Title -->
                      <h5 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, nulla.</h5>
                      <!-- Card Content -->
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <!-- Optional Button -->
                      <a href="blog.html" class="btn btn-dark">Read More</a>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <!-- Card Image -->
                    <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <!-- Card Title -->
                      <h5 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, nulla.</h5>
                      <!-- Card Content -->
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <!-- Optional Button -->
                      <a href="blog.html" class="btn btn-dark">Read More</a>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <!-- Card Image -->
                    <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <!-- Card Title -->
                      <h5 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, nulla.</h5>
                      <!-- Card Content -->
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <!-- Optional Button -->
                      <a href="blog.html" class="btn btn-dark">Read More</a>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <!-- Card Image -->
                    <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <!-- Card Title -->
                      <h5 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, nulla.</h5>
                      <!-- Card Content -->
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <!-- Optional Button -->
                      <a href="blog.html" class="btn btn-dark">Read More</a>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <!-- Card Image -->
                    <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <!-- Card Title -->
                      <h5 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, nulla.</h5>
                      <!-- Card Content -->
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <!-- Optional Button -->
                      <a href="blog.html" class="btn btn-dark">Read More</a>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <!-- Card Image -->
                    <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <!-- Card Title -->
                      <h5 class="card-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, nulla.</h5>
                      <!-- Card Content -->
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <!-- Optional Button -->
                      <a href="blog.html" class="btn btn-dark">Read More</a>
                    </div>
                  </div>
                </div>
              </div>
              
           </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 side-container">
                <div>

                </div>
                <div class="sticky-sidebar">
                    <img id="sticky-img" src="https://picsum.photos/id/237/200/300" alt="Advertisement">
                </div>
            </div>
        </div>
    </div>
@endsection