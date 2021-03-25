@extends('layouts.main')

@section('content')

<dashboard-component :restaurants="{{ $restaurants }}" :menuitems="{{ $menuitems }}" :user="{{ Auth::user() }}"></dashboard-component>

@endsection
