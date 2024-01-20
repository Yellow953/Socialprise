@extends('auth.app')

@section('content')
<div class="container">
    <div class="login-wrap">
        <div class="login-content">
            <div class="login-logo">
                <a href="/">
                    <h1>Socialprise | Login</h1>
                </a>
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="my-4">
                        <label for="email">{{ __('Email Address')
                            }}</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                            autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="login-checkbox my-4">
                        <label>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            Remember Me
                        </label>
                    </div>

                    <button class="btn btn-primary btn-block" type="submit">
                        Sign In
                    </button>
                </form>

                <div class="register-link">
                    <p>
                        Don't you have account?
                        <a href="{{ route('register') }}" class="text-primary">Sign Up Here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection