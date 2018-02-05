@extends('layouts.app')

@section('content')

        <form action="{{ action('Setting\UsersController@update', ['id' => $users->id]) }}" method="post">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Detail User </h5>

                </div>
                <div class="ibox-content">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    @endif

                    <input type="hidden" name="id" value="{{ $users->id  }}"/>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="name" class="col-md-3 ">Nama <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" value="{{ $users->name }}"
                                       required/>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="email" class="col-md-3">Email <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="email" disabled class="form-control" name="email" value="{{ $users->email }}"
                                       required/>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="role" class="col-md-3">Role <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select name="role" id="role" class="form-control" required>
                                    @foreach($roles as $role)
                                        @if($role->id == $users->role_id)
                                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <fieldset>
                        <legend>Detail Informasi</legend>
                        <div class="form-group {{ $errors->has('nik') ? 'has-error' : '' }}">
                            <div class="row">
                                <label for="nik" class="col-md-3">NIK <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input readonly type="text" class="form-control" name="nik"
                                           value="{{ $users->nik }}" required/>
                                    @if ($errors->has('nik'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nik') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                            <div class="row">
                                <label for="nik" class="col-md-3">Jenis Kelamin <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="jenis_kelamin"
                                                   value="1" {{ $users->jenis_kelamin == 1 ? 'checked' : '' }} /> Laki
                                            - laki
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="jenis_kelamin"
                                                   value="0" {{ $users->jenis_kelamin == 0 ? 'checked' : '' }} />
                                            Perempuan
                                        </label>
                                    </div>
                                    @if ($errors->has('jenis_kelamin'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>


                    <fieldset>
                        <legend>Authentication</legend>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="row">
                                <label for="password" class="col-md-3">Password <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password" required/>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                            <div class="row">
                                <label for="password" class="col-md-3">Confirm Password <span
                                            class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="confirm_password" required/>
                                    @if ($errors->has('confirm_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                    @endif
                                    <p>
                                        Please type your latest password or new password
                                    </p>
                                </div>
                            </div>

                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Client API</legend>
                        <div class="form-group">
                            <div class="row">
                                <label for="generate_api_client" class="col-md-3">&nbsp;</label>
                                <div class="col-md-9">
                                    <p>
                                        Generate secret token for access from API
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <label for="client_name" class="col-md-3">Client Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="client_name" id="client_scope" class="form-control"
                                           value="{{ $apiClient->name ? $apiClient->name : $users->email . '-' . date('YmdHis') }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label for="client_secret" class="col-md-3">Client Secret</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="text" readonly name="client_secret" id="client-secret" class="form-control" value="{{ $apiClient->secret }}">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" data-clipboard-target="client_secret">
                                                <i class="fa fa-copy"></i> Copy
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <fieldset>
                        <legend>Membership</legend>
                        <div class="form-group">
                            <div class="row">
                                <label for="membership" class="col-md-3">&nbsp;</label>
                                <div class="col-md-9">
                                    Membership status from {{ $users->email }}
                                    <div class="checkbox">

                                        <input type="checkbox" class="js-switch" name="is_active"
                                               {{ $users->is_active == 1 ? 'checked' : '' }} value="1"/> Is Active ?

                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="ibox-footer no-overflow">

                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('users') }}" class="btn btn-default">Batal</a>
                    </div>

                </div>
            </div>
        </form>



@endsection
