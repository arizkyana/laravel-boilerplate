@extends('layouts.app')

@section('content')
    <div class="middle-box loginscreen   animated fadeInDown">
        <div class="ibox">

            <div class="ibox-title text-center">
                <h3>Daftar Akun Jumantik</h3>
            </div>

            <div class="ibox-content">
                <form class="m-t" role="form" action="{{ action('RegistrasiController@store') }}" method="post">
                    {{ csrf_field() }}

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    @endif

                    <button type="button" class="btn btn-info block full-width m-b" data-toggle="modal"
                            data-target="#modal-disduk"><i class="fa fa-search"></i> Cari Warga via DISDUKCAPIL
                    </button>
                    <hr/>
                    <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">

                        <select name="role" id="role" data-placeholder="Pilih Daftar Sebagai" class="form-control">
                            <option value=""></option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role'))
                            <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                        @endif
                    </div>

                    <hr/>

                    <div class="form-group {{ $errors->has('no_ktp') ? 'has-error' : '' }}">
                        <input type="text" name="no_ktp" class="form-control" readonly required
                               placeholder="No KTP. Contoh: 3273051xxxx"/>
                        @if ($errors->has('no_ktp'))
                            <span class="help-block">
                            <strong>{{ $errors->first('no_ktp') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" placeholder="Nama" name="nama" readonly required
                               value="{{ old('nama') }}">
                        @if ($errors->has('nama'))
                            <span class="help-block">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" placeholder="Email" name="email" required
                               value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('telepon') ? 'has-error' : '' }}">
                        <input type="text" name="telepon" placeholder="Telepon" class="form-control" required
                               value="{{ old('telepon') }}"/>
                        @if ($errors->has('telepon'))
                            <span class="help-block">
                            <strong>{{ $errors->first('telepon') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="jenis_kelamin" value="1"/> Laki - laki
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="jenis_kelamin" value="0"/> Perempuan
                            </label>
                        </div>
                        @if ($errors->has('jenis_kelamin'))
                            <span class="help-block">
                                <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                            </span>
                        @endif
                    </div>

                    <hr/>

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
                    <button type="submit" class="btn btn-primary block full-width m-b">Daftar Akun</button>

                    <p class="text-muted text-center">
                        <small>Sudah punya akun?</small>
                    </p>
                    <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Login</a>
                </form>
            </div>

            <div class="ibox-footer text-center">
                <p class="m-t">
                    <small>{{ config('app.name', 'Laravel') }} &copy; 2018</small>
                </p>
            </div>
        </div>
    </div>

    {{--modal disduk--}}
    <div class="modal inmodal fade" id="modal-disduk" tabindex="-1" role="dialog" aria-hidden="true">
        <form name="form-cari-warga" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span
                                    aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">DISDUKCAPIL Kota Bekasi</h4>

                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-address-card"></i>
                                </span>
                                <input type="text" name="nik" placeholder="NIK (No. KTP)" class="form-control"
                                       required/>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-address-card"></i>
                                </span>
                                <input type="text" name="kk" placeholder="No. KK(Kartu Keluarga)" class="form-control"
                                       required/>

                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="ladda-button ladda-button-demo btn btn-primary"
                                data-style="zoom-in">Submit
                        </button>
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    {{--/modal disduk--}}
@endsection
