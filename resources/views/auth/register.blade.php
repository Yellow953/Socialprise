@extends('auth.app')

@section('content')
<div class="container">
    <div class="login-wrap">
        <div class="login-content">
            <div class="login-logo">
                <a href="/">
                    <h1>Socialprise | Register</h1>
                </a>
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="my-4">
                        <label for="name">{{ __('Name') }}</label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="my-4">
                        <label for="email">{{ __('Email Address')
                            }}</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="my-4">
                        <label for="password">{{ __('Password')
                            }}</label>

                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="my-4">
                        <label for="password-confirm">{{ __('Confirm
                            Password') }}</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Register') }}
                    </button>
                </form>
                <div class="register-link">
                    <p>
                        Already have an account?
                        <a href="{{ route('login') }}">Login In Here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection