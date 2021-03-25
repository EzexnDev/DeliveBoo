@extends('layouts.main')

@section('content')

<hero-component v-bind:types="{{ $cuisineTypes }}"></hero-component>

@endsection
