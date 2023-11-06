@extends('layouts.header')

@section('content')
<head>

  <link href="{{ asset('assets/css/calendar.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/calendar_decoration.css') }}" rel="stylesheet">
  <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
  <div id='calendar'></div>
<script src="{{ asset('assets/js/schedule.js') }}"></script>

@endsection
