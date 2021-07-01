@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td>{{ auth()->user()->full_name }}</td>
                               
                               
                                <td>{{ auth()->user()->email }}</td>
                                <td><a href="" onclick="event.preventDefault();document.getElementById('logoutForm').submit();">Logout</a></td>
                                
                                {{-- <form action="{{ route('user.logout') }}" method="POST" id="logoutForm">@csrf</form> --}}
                                
                                <form action="{{ route('doctor.logout') }}" method="POST" id="logoutForm">@csrf</form>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
