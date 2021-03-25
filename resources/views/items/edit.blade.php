@extends('layouts/main')

@section('content')

<div class="container">     
        <h1 style="color:white">Create Menu Item</h1>         
         <form method="post" action="{{ route('menuitems.update', $menuitem->id ) }}">
            @csrf
            @method('put')
            {{-- input name --}}
            <div class="container-list-edit edit-item" style='display:flex;justify-content:center'>
                <div class="signup">
                    <div class="form-holder">
                        <label for="menuItemName" class="edit-label">Name</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control input" id="menuItemName" name="menuItemName" placeholder="enter title..." value="{{old('menuItemName', $menuitem->name)}}">

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
                            <input type="name" class="form-control input" id="menuItemDescription" name="menuItemDescription" placeholder="enter author..." value="{{old('menuItemDescription', $menuitem->description)}}">
            
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
                            <input type="name" class="form-control input" id="menuItemIngredients" name="menuItemIngredients" placeholder="enter author..." value="{{old('menuItemIngredients', $menuitem->ingredients)}}">

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
                            <input type="name" class="form-control input" id="menuItemPrice" name="menuItemPrice" placeholder="enter author..." value="{{old('menuItemPrice', $menuitem->price)}}">

                            @error('menuItemPrice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- options checkbox --}}
                    <div class="checkbox-container">
                        <h2>Selezionare le opzioni: </h2>
                        @foreach($options as $option)
                            <div>
                                <input class='icon-box' type="checkbox" id="{{$option->option}}" name="options[]" value="{{$option->id}}" {{  $menuitem->options->contains($option) ? 'checked' : '' }}>
                                <label class='label' for="{{$option->option}}">{{$option->option}}</label>
                            </div>
                        @endforeach
                    </div>

                    <div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <button type="submit" class="submit-btn"> Update </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 