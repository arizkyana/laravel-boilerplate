@extends('layouts.app')

@section('content')
    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div class="ibox">

            <div class="ibox-title">
                <h3>Reset Password</h3>
            </div>

            <div class="ibox-content">
                <form class="m-t" role="form" action="{{ action('RegistrasiController@store_reset_password') }}"
                      method="post">
                    {{ csrf_field() }}

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    @endif


                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" placeholder="Email" name="email" required
                               value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>


                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" placeholder="Password" name="password" required
                               value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        <input type="password" name="password_confirmation" placeholder="Confirm Password"
                               class="form-control" required/>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Reset</button>

                    <p class="text-muted text-center">
                        <small>Sudah punya akun?</small>
                    </p>
                    <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Login</a>
                </form>
            </div>

            <div class="ibox-footer">
                <p class="m-t">
                    <small>{{ config('app.name', 'Laravel') }} &copy; 2018</small>
                </p>
            </div>

        </div>
    </div>
@endsection
