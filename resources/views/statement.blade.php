@extends('layouts.app')

@section('content')
<div class="page-wrapper">
<div class="container-xl">

<div class="col-md-6">

            <div class="card" id="statement">
                <div class="card-header">
                    <h3 class="m-0 font-weight-bold">Statement of Account</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">DATE & TIME</th>
                                <th scope="col">AMOUNT</th>
                                <th scope="col">TYPE</th>
                                <th scope="col">DETAILS</th>
                                <th scope="col">BALANCE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($statement as $k => $s)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ date('d-m-Y h:i A', strtotime($s['datetime'])) }}</td>
                                <td>{{ $s['amount'] }}</td>
                                <td>{{ $s['type'] }}</td>
                                <td>{{ $s['details'] }}</td>
                                <td>{{ $s['current_balance'] }}</td>
                            </tr>
                            @php($i++)
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection