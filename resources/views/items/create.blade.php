@extends('layouts/main')

@section('content')

<div class="container">
        <h1 style="color: white">Create Menu Item</h1>
        <form method="post" action="{{ route('menuitems.store') }}">
            @csrf
            @method('post')
            <div class="container-list-edit">
                <div class="form-structor-edit" style='display:flex; justify-content:center'>
                    <div class="signup">
                        <div class="form-holder">
                            <label for="menuItemName" class="edit-label">Name</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control  input" id="menuItemName" name="menuItemName" placeholder="enter title..." value=" {{ old('menuItemName') }}" >

                                @error('menuItemName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- input description --}}
                        <div class="form-holder">
                            <label for="menuItemDescription" class="edit-label">Description</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="menuItemDescription" name="menuItemDescription" placeholder="enter author..." value=" {{ old('menuItemDescription') }}">

                                @error('menuItemDescription')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- input ingredients --}}
                        {{-- <div class="form-holder">
                            <label for="menuItemIngredients" class="edit-label">Ingredients</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="menuItemIngredients" name="menuItemIngredients" placeholder="enter author..." value=" {{ old('menuItemIngredients') }}">

                                @error('menuItemIngredients')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- input price --}}
                        <div class="form-holder">
                            <label for="menuItemPrice" class="edit-label">Price</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control  input" id="menuItemPrice" name="menuItemPrice" placeholder="enter author..." value=" {{ old('menuItemPrice') }}">

                                @error('menuItemPrice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- option checkbox --}}
                        <div class="checkbox-container">
                            <h2>Seleziona le opzioni: </h2>
                            @foreach($options as $option)
                                <div>
                                    <input class='icon-box'type="checkbox" id="{{$option->option}}" name="options[]" value="{{ $option->id }}"
                                           class="@error('options[]') is-invalid @enderror"
                                           @if( is_array(old('options')) && in_array($option->id, old('options')))
                                            checked
                                           @endif>
                                    <label class='label' for="{{$option->option}}">{{$option->option}}</label>
                                </div>
                            @endforeach
                        </div>
                                <button type="submit" class="submit-btn"> Create </button>
                    </div>
                </div>
            </div>
            {{-- input name --}}

        </form>
</div>
@endsection
