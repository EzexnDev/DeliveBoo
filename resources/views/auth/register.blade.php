@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-structor">
                        <div class="signup">
                            <h2 class="form-title" id="login">Signup</h2>
                            <div class="form-holder">
                                <input type="text" placeholder="Name & Surname" id="nam"
                                    class="form-control @error('name') is-invalid @enderror input" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <input type="text" id="pIva" placeholder="VAT Number"
                                    class="form-control @error('pIva') is-invalid @enderror input" name="pIva"
                                    value="{{ old('pIva') }}" required autocomplete="pIva" autofocus>
                                @error('pIva')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input type="text" id="phone" placeholder="Phone"
                                    class="form-control @error('phone') is-invalid @enderror input" name="phone"
                                    value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input type="text" id="email" placeholder="Email"
                                    class="form-control @error('email') is-invalid @enderror input" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input type="password" id="password" placeholder="Password"
                                    class="form-control @error('password') is-invalid @enderror input" name="password"
                                    value="{{ old('password') }}" required autocomplete="password" autofocus>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input type="password" id="password-confirm" placeholder="Password-Confirm"
                                    class="form-control input" name="password_confirmation"
                                     required autocomplete="new-password" autofocus>

                            </div>
                            <button class="submit-btn">{{ __('Register') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
