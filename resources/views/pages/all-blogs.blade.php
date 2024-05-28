@extends('app')


@section('style')

<link rel="stylesheet" href="{{asset('assets/css/new-blog.css')}}">

@endsection

@section('content')


<div class="content p-3">
    <div class="d-flex">
        <div class="mr-3">
            <h2>New Blog</h2>
        </div>
        <!-- <div class="ml-auto header-advertisement flex-grow-1">
            <img src="" alt="Advertisement">
        </div> -->
    </div>



    <div class="row mt-2">
        <div class="col-12 col-sm-9 col-md-9 mb-2">
            <input type="text" class="form-control" placeholder="Search">
        </div>
        <div class="col-12 col-sm-3 col-md-3">
            <a class="btn btn-dark" href="#">New Blog</a>
        </div>
    </div>
    
</div>

@endsection