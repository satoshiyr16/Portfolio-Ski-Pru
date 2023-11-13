@extends('layouts.header')
@section('additionHeader')
    <link href="{{ asset('assets/css/calendar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/calendar_decoration.css') }}" rel="stylesheet">
@endsection
@section('content')
  <div id='calendar'></div>
<script src="{{ asset('assets/js/schedule.js') }}"></script>
@endsection
