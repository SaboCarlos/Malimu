@extends('layouts.util')

@section('content')
        <div class="container-fluid">
            <div class="row h-100  align-items-center justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="rounded p-2 p-sm-4 my-2 mx-2" style="background:#d6dadf;">
                        <div class="text-center mb-4">
                            <h3>{{ __('Register') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus id="floatingText" placeholder="jhondoe">
                                <label for="floatingText">Username</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" id="floatingpassword-confirm" placeholder="Confirm Password">
                                <label for="floatingpassword-confirm">Confirm Password</label>
                            </div>
                            
                            <button type="submit" class="btn btn-success py-3 w-100 mb-4">{{ __('Register') }}</button>
                            <p class="text-center mb-0">Already have an Account? <a href="{{route('login')}}">login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

