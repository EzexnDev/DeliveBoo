@extends('layouts.main')

@section('content')
{{-- @dd(session('success_message'),$errors); --}}
    {{-- @if(session('success_message'))
        <div class="alert alert-success">
            {{session('success_message')}}
        </div>
    @endif

    @if(count($errors) > 0)
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach;
            </ul>
        </div>
    @endif   --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <div class="form-structor-edit">
                        <div class="form-holder">
                            <div class="checkbox-container">
                                @if(isset($successMessage))
                    <div class="alert alert-success">
                        {{$successMessage}}
                    </div>
                @endif

                @if(count($errors) > 0)
                    <div>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                            </div>
                            <button class="submit-btn" style=""> <a href="/home">RETURN TO HOME</a></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
