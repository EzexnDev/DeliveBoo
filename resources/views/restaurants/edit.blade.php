@extends('layouts/main')

@section('content')

<div class="container">

    <h1 style="color: white">Edit Restaurant</h1>
    <form method="post" action="{{ route('restaurants.update', $restaurant->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="container-list-edit">
            <div class="title">
            </div>
            <div class="form-structor-edit" style='display:flex; justify-content:center'>

                <div class="signup">
                    <div class="form-holder">
                        <label class='edit-label'>Restaurant-Name</label>
                        <input type="name" class="form-control input" id="restaurantName" name="restaurantName"
                            placeholder="enter title..." value="{{old('restaurantName', $restaurant->name)}}">
                        @error('restaurantName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-holder">
                        <label class='edit-label'>Address</label>
                        <input type="name" class="form-control input" id="restaurantAddress" name="restaurantAddress"
                            placeholder="enter author..." value="{{old('restaurantAddress', $restaurant->address)}}">

                        @error('restaurantAddress')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-holder">
                        <label class='edit-label'>Description</label>
                        <input type="text" class="form-control input" id="restaurantDescription"
                            name="restaurantDescription" placeholder="enter author..."
                            value="{{old('restaurantDescription', $restaurant->description)}}">

                        @error('restaurantDescription')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-holder">
                        <label class='edit-label'>Delivery-Hours</label>
                        <input type="name" class="form-control input" id="restaurantDeliveryHours"
                            name="restaurantDeliveryHours" placeholder="enter author..."
                            value="{{old('restaurantDeliveryHours', $restaurant->deliveryHours)}}">

                        @error('restaurantDeliveryHours')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-holder">
                        <label class='edit-label'>Close Day</label>
                        <input type="name" class="form-control input" id="restaurantCloseDay" name="restaurantCloseDay"
                            placeholder="enter author..." value="{{old('restaurantCloseDay', $restaurant->closeDay)}}">

                        @error('restaurantCloseDay')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror </div>
                    <div class="form-holder">
                        <label class='edit-label'>Short-Description</label>
                        <input type="name" class="form-control input" id="restaurantShortDescription"
                            name="restaurantShortDescription" placeholder="enter author..."
                            value="{{old('restaurantShortDescription', $restaurant->shortDescription)}}">

                        @error('restaurantShortDescription')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror </div>
                    <div class="form-holder">
                        <label class='edit-label'>Phone-Number</label>
                        <input type="name" class="form-control input" id="restaurantPhone" name="restaurantPhone"
                            placeholder="enter author..." value="{{old('restaurantPhone', $restaurant->phone)}}">

                        @error('restaurantPhone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-holder">
                        <label class='edit-label'>City</label>
                        <input type="name" class="form-control input" id="restaurantCity" name="restaurantCity"
                            placeholder="enter author..." value="{{old('restaurantCity', $restaurant->city)}}">

                        @error('restaurantCity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="checkbox-container">

                        <h2>Selezione le tipologie</h2>
                        @foreach($cuisineTypes as $cuisineType)
                        <div>
                            <input class='icon-box' type="checkbox" id="{{$cuisineType->type}}" name="cuisinetypes[]" value="{{$cuisineType->id}}" {{  $restaurant->cuisineType->contains($cuisineType) ? 'checked' : '' }}>
                            <label class='label' for="{{$cuisineType->type}}">{{$cuisineType->type}}</label>
                        </div>
                        @endforeach
                    </div>
                        <div class="">
                            <button class="submit-btn">Update</button>
                        </div>
                </div>
            </div>
            {{-- <div class="form-group row">
                    <label for="restaurantImgUrl" class="col-md-4 col-form-label text-md-right">Immagine</label>
                    <div class="col-md-6">
                        <input id="restaurantImgUrl" type="file" class="form-control @error('restaurantImgUrl') is-invalid @enderror" name="restaurantImgUrl" value="{{ old('restaurantImgUrl') }}"
            autofocus>
            @error('restaurantImgUrl')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
</div>

{{-- CUISINETYPE CHECKBOX --}}
{{-- <fieldset>
                    <legend>Selezione le tipologie</legend>
                    @foreach($cuisineTypes as $cuisineType)
                        <div>
                            <input type="checkbox" id="{{$cuisineType->type}}" name="cuisinetypes[]"
value="{{$cuisineType->id}}" {{  $restaurant->cuisineType->contains($cuisineType) ? 'checked' : '' }}>
<label for="{{$cuisineType->type}}">{{$cuisineType->type}}</label>
</div>
@endforeach
</fieldset>


<div class="form-group row">
    <div class="col-sm-6 d-flex justify-content-end">
        <button type="submit" class="btn btn-success"> Update </button>
    </div>
</div> --}}
</form>

</div>

</div>

@endsection
