@extends('layouts.app')

@section('content')

    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
        <h2>ABC BANK</h2>
        </div>
        <form class="card card-md" method="POST" action="{{ route('login') }}">
           @csrf
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Login to your account</h2>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
              
            </div>
            <div class="mb-2">
              <label class="form-label">
                Password
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </label>
             
            </div>
            <div class="mb-2">
              <label class="form-check">
               
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                 
                <span class="form-check-label">Remember me on this device</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Sign in</button>
            </div>
          </div>
          
        </form>
        <div class="text-center text-muted mt-3">
          Don't have account yet? <a href="{{ route('register') }}">Sign up</a>
        </div>
      </div>
    </div>

@endsection
