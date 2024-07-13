<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Responsive Sidebar</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <script src="{{asset('assets/js/sweetalert2.js')}}"></script>
    <script src="{{asset('assets/js/jquery-3.5.1.slim.min.js')}}"></script>
    @if(request()->route()->getPrefix())
    <link rel="stylesheet" href="{{asset('assets/css/backend-header.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
    
    @else
    <link rel="stylesheet" href="{{asset('assets/css/frontend-header.css')}}">
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    @endif
    
  
    
</head>
<body>

@yield('style')


@if(request()->route()->getPrefix())
    @include('component.backend-header')
@else
    @include('component.frontend-header')
@endif


@yield('content')



<script src="{{asset('assets/js/jquery.js')}}"></script>
@yield('script')


@if(request()->route()->getPrefix())
    <script src="{{asset('assets/js/ckeditor.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
    @include('component.footer')
@else
    @include('component.frontend-footer')
@endif




