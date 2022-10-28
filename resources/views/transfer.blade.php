@extends('layouts.app')

@section('content')
<div class="container-xl">

<div class="col-md-6">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
            <div class="d-flex">
                <div>
                <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                <!-- SVG icon code with class="alert-icon" -->
                </div>
                <div>
                
                <div class="text-muted">{{ $message }}!</div>
                </div>
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
            
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
            <div class="d-flex">
                <div>
                <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                <!-- SVG icon code with class="alert-icon" -->
                </div>
                <div>
                
                <div class="text-muted">{{ $message }}!</div>
                </div>
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
                        
            @endif
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Transfer Money</h3>
               
                </div>
                <div class="card-body">
                <form method="POST" action="{{ route('saveTransfer') }}">
                                @csrf
                    <div class="form-group mb-3 ">
                      <label class="form-label">Email Address</label>
                      <div >
                      <input id="email" placeholder="Enter email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Amount</label>
                      <div >
                                        <input id="amount" min="1" step="0.1" placeholder="Enter amount to Deposit"   type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount" autofocus>

                                        @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                      </div>
                    </div>
                    
                    <div class="form-footer">
                      <button type="submit" class="btn btn-primary">Transfer</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
</div>
</div>
@endsection
            
            