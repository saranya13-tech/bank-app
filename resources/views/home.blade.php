@extends('layouts.app')

@section('content')
<div class="page-wrapper">
<div class="container-xl">
<div class="col-md-6">
            <ul class="list-group list-unstyled">
                <li class="list-group-item">
                    <h3 class="m-0">Welcome {{ ucfirst(Auth::user()->name) }}</h3>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-4">
                            <p class="m-0 text-muted">YOUR ID</label>
                        </div>
                        <div class="col-8">
                            <p class="m-0">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="row">
                        <div class="col-4">
                            <p class="m-0 text-muted">YOUR BALANCE</label>
                        </div>
                        <div class="col-8">
                            <p class="m-0">{{ Auth::user()->balance }} INR</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-md-2">
    </div>
    </div>
</div>
</div>
</div>
@endsection