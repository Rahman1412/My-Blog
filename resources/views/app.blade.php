<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Responsive Sidebar</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/header.css')}}">
</head>
<body>

@yield('style')

@include('component.header')


@yield('content')


<script src="{{asset('assets/js/jquery-3.5.1.slim.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@yield('script')

@include('component.footer')



