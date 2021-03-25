@extends('layouts.main')

@section('content')

<show-component :restaurant="{{$restaurant}}" :menuitems="{{$menuitems}}"></show-component>

@endsection