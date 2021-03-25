@extends('layouts.main')

{{-- @section('chart-css')
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

@endsection --}}

@section('content')
    <stat-component :orders="{{$orders}}" :chart="{{ json_encode($chart) }}" :restaurants="{{ $restaurants }}" :menuitems="{{ $menuitems }}" :user="{{ Auth::user() }}"></stat-component>


        {{-- <canvas id="userChart" width="200" height="100"></canvas> --}}

@endsection

{{-- @section('scripts')
       
        <script>   

           
        </script>
@endsection --}}