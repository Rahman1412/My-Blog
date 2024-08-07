@extends('app')

@section('style')

<link rel="stylesheet" href="{{asset('assets/css/about-us.css')}}">

@endsection

@section('content')

<div class="container-fluid banner">
    <h3 class="banner-title">About Us</h3>
</div>
<div class="container-fluid">
    <div class="p-4">
    {!! $data->content !!}
    </div>
</div>

@endsection

@section('script')

@endsection