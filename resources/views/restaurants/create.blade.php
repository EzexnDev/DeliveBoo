@extends('layouts.main')

@section('content')

<div class="container">
    <h1 style="color: white">Create Restaurant</h1>
    <form method="post" action="{{ route('restaurants.store') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="container-list-edit">
            <div class="title">

                {{-- NAME INPUT --}}
                <div class="form-structor-edit" style='display:flex; justify-content:center'>
                    <div class="signup">
                        <div class="form-holder">
                            <label for="restaurantName" class="edit-label">Name</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="restaurantName" name="restaurantName" placeholder="enter title..." value=" {{ old('restaurantName') }} ">

                                @error('restaurantName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- ADDRESS INPUT --}}
                        <div class="form-holder">
                            <label for="restaurantAddress" class="edit-label">Address</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="restaurantAddress" name="restaurantAddress" placeholder="enter author..." value=" {{ old('restaurantAddress') }} ">

                                @error('restaurantAddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- DESCRIPTION INPUT --}}
                        <div class="form-holder">
                            <label for="restaurantDescription" class="edit-label">Description</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="restaurantDescription" name="restaurantDescription" placeholder="enter author..." value=" {{ old('restaurantDescription') }} ">

                                @error('restaurantDescription')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- DELIVERY HOURS INPUT --}}
                        <div class="form-holder">
                            <label for="restaurantDeliveryHours" class="edit-label">Delivery Hours</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="restaurantDeliveryHours" name="restaurantDeliveryHours" placeholder="enter author..." value=" {{ old('restaurantDeliveryHours') }} ">

                                @error('restaurantDeliveryHours')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- CLOSE DAY INPUT --}}
                        <div class="form-holder">
                            <label for="restaurantCloseDay" class="edit-label">Close Day</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="restaurantCloseDay" name="restaurantCloseDay" placeholder="enter author..." value=" {{ old('restaurantCloseDay') }} ">

                                @error('restaurantCloseDay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- SHORT DESCRIPTION INPUT --}}
                        <div class="form-holder">
                            <label for="restaurantShortDescription" class="edit-label">Short Description</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="restaurantShortDescription" name="restaurantShortDescription" placeholder="enter author..." value=" {{ old('restaurantShortDescription') }} ">

                                @error('restaurantShortDescription')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- PHONE INPUT --}}
                        <div class="form-holder">
                            <label for="restaurantPhone" class="edit-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="restaurantPhone" name="restaurantPhone" placeholder="enter author..." value=" {{ old('restaurantPhone') }} ">

                                @error('restaurantPhone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- CITY INPUT --}}
                        <div class="form-holder">
                            <label for="restaurantCity" class="edit-label">City</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="restaurantCity" name="restaurantCity" placeholder="enter author..." value=" {{ old('restaurantCity') }} ">

                                @error('restaurantCity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- IMAGE INPUT --}}
                        {{-- <div class="form-holder">
                            <label for="restaurantImgUrl" class="col-sm-2 col-form-label">Url Image</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="restaurantImgUrl" name="restaurantImgUrl" placeholder="enter author..." value=" {{ old('restaurantImgUrl') }} ">

                                @error('restaurantImgUrl')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-holder">
                            <label for="restaurantImgUrl" class="edit-label">Immagine</label>
                            <div class="col-md-6">
                                <input id="restaurantImgUrl" type="file" class="form-control @error('restaurantImgUrl') is-invalid @enderror" name="restaurantImgUrl" value="{{ old('restaurantImgUrl') }}" autofocus>
                                @error('restaurantImgUrl')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="checkbox-container">

                            <h2>Seleziona la tipologia: </h2>
                            @foreach($cuisineTypes as $cuisineType)
                            <div>
                                <input class='icon-box'type="checkbox" id="{{$cuisineType->type}}" name="cuisinetypes[]" value="{{ $cuisineType->id }}"
                                class="@error('cuisinetypes[]') is-invalid @enderror"
                                @if( is_array(old('cuisinetypes')) && in_array($cuisineType->id, old('cuisinetypes')))
                                checked
                                @endif>
                                <label class="label" for="{{$cuisineType->type}}">{{$cuisineType->type}}</label>
                            </div>
                            @endforeach
                        </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                    <button type= 'sub,it'class="submit-btn">Create Restaurant</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
