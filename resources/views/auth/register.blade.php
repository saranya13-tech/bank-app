@extends('layouts.app')

@section('content')

<div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
        <h2>ABC BANK</h2>
        </div>
        <form class="card card-md" method="POST" action="{{ route('register') }}">
           @csrf
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Create new account</h2>
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

               @error('name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
               @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <div class="input-group input-group-flat">
              <input type="password" class="form-control @error('password') is-invalid @enderror" 
              pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <label class="form-check">
              <input class="form-check-input" type="checkbox" name="terms" id="terms" {{ old("terms") ? 'checked' : '' }} required>

               <span class="form-check-label">Agree the <a  tabindex="-1">terms and policy</a>.</span>
              </label>
              @error('terms')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
                </span>
               @enderror
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Create new account</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Already have account? <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
        </div>
      </div>
    </div>

@endsection
