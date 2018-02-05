@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>Welcome {{ \Illuminate\Support\Facades\Auth::user()->name }}</h1>
        <p>Login Time : {{ date('Y M d H:i:s') }}</p>
    </div>



@endsection
