@extends('layouts.util')

@section('content')
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="rounded p-4 p-sm-4 my-2 mx-2" style="background:#d6dadf;">
                        <div class="text-center mb-4">
                            <h3>{{ __('Login') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" id="floatingPassword"
                                placeholder="Password">
                                <label for="floatingPassword">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleCheck1">{{ __('Remember Me') }}</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success py-3 w-100 mb-4">{{ __('Login') }}</button>
                            <p class="text-center mb-0">Don't have an Account? <a href="{{ route('register') }}">Sign
                                    Up</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
    
