@extends('layouts.main')

@section('content')
<form method="post" id="order-form" action="{{route('orders.store')}}">

           @csrf
           @method('post')
            <div class="container-list-edit">
                <div class="title">
                    <h1 style='color:white'>Checkout</h1>
                </div>
                <div class="form-structor-edit">
                    <div class="signup">
                        <div class="form-holder">
                            <label class='edit-label' for="orderName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="orderName" name="orderName" placeholder="enter title..." value=" {{ old('orderName') }} ">

                                @error('orderName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- SURNAME INPUT --}}
                        <div class="form-holder">
                            <label class='edit-label' for="orderSurname" class="col-sm-2 col-form-label">Surname</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="orderSurname" name="orderSurname" placeholder="enter title..." value=" {{ old('orderSurname') }} ">

                                @error('orderSurname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- ADDRESS INPUT --}}
                        <div class="form-holder">
                            <label class='edit-label' for="orderAddress" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="orderAddress" name="orderAddress" placeholder="enter author..." value=" {{ old('orderAddress') }} ">

                                @error('orderAddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- PHONE INPUT --}}
                        <div class="form-holder">
                            <label class='edit-label' for="orderPhone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="orderPhone" name="orderPhone" placeholder="enter author..." value=" {{ old('orderPhone') }} ">

                                @error('orderPhone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- MAIL INPUT --}}
                        <div class="form-holder">
                            <label class='edit-label' for="orderEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input  type="text" id="orderEmail"
                                    class="form-control input @error('orderEmail') is-invalid @enderror input" name="orderEmail"
                                    value="{{ old('orderEmail') }}" required autocomplete="orderEmail" autofocus>

                                    @error('orderEmail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        {{-- NOTES INPUT --}}
                        <div class="form-holder">
                            <label class='edit-label' for="orderNotes" class="col-sm-2 col-form-label">Commenti</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control input" id="orderNotes" name="orderNotes" placeholder="enter author..." value=" {{ old('orderNotes') }} ">

                                @error('orderNotes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="checkbox-container"><h2 style='text-align:center;color: #5433ff;'>Prezzo Finale: {{number_format($totalPrice, 2)}}</h2></div>

                            <button class="submit-btn" href='/checkout'>Checkout</button>
                    </div>
                </div>
            </div>

</form>

@endsection
