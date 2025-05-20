@extends('layouts.authentication.master')
@section('title', 'Login-bs-validation')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-7 order-1"><img class="bg-img-cover bg-center" src="{{asset('assets/images/login/1.jpg')}}" alt="looginpage"></div>
            <div class="col-xl-5 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo text-start" href="{{ route('index') }}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/login.png')}}" alt="looginpage"><img
                                    class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>
                        <div class="login-main">
                            <form class="theme-form needs-validation" method="POST" action="{{ route('login.submit') }}" novalidate>
                                @csrf
                                <h4>Sign in</h4>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
                                    @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0 pt-2">
                                    <button class="btn btn-primary btn-block pt1" type="submit">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
