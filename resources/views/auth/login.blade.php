@extends('layouts.app')

@section('content')
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div >
                <img src="{{ asset('images/jasamarga-logo-400.png') }}" alt="jasamarga-logo-400" class="img-responsive center-block" width="150" />

            </div>

            <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" placeholder="Email" name="email" autofocus required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                <a href="{{ route('reset_password') }}">
                    <small>Lupa Password?</small>
                </a>
            </form>
            <p class="m-t">
                <small>{{ config('app.name', 'Laravel') }} &copy; {{ date('Y') }}</small>
            </p>
        </div>
    </div>
@endsection
