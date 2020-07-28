@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center login">
        <div class="col-md-8 h-100 d-flex justify-content-center align-items-center">
            <div class="d-flex flex-column justify-content-center align-items-center login__form">
                <img src="{{ asset('svg/fixandfree.co_logo.svg') }}" alt="Fix and Free Co Login">
                <form class="w-100 my-4" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <select class="form-control w-400px vh-50px" id="login__type" name="home_type">
                            <option disabled readonly>Select Account</option>
                            <option value="fix-and-free.co">fix&free.co</option>
                            <option value="fix-and-free.salon">fix&free.salon</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control @error('email') is-invalid @enderror w-400px vh-50px" name="email"
                            id="login__email" value="{{ old('email') }}"
                            placeholder="Enter your email" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control w-400px vh-50px"
                            id="login__password" name="password" placeholder="Password" required
                            autocomplete="current-password">
                    </div>
                    <button type="submit"
                        class="btn btn-primary btn-block text-bold text-uppercase btn--ff w-400px vh-50px">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
