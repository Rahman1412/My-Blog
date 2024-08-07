@extends('app')

@section('style')

<link rel="stylesheet" href="{{asset('assets/css/view-blog.css')}}">

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                <div class="sticky-sidebar">
                    Lorem Ipsum
                </div>
            </div>

            <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-7 mt-2">
                {!! $blog->meta->description !!}
            </div>

            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                <div class="sticky-sidebar">
                Lorem Ipsum
                </div>
            </div>
        </div>
    </div>

    @endsection
