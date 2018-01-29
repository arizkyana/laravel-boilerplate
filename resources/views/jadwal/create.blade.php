@extends('layouts.app')

@section('content')

    <form action="{{ action('JadwalController@store') }}" method="post">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Tambah Jadwal</h5>
            </div>

            <div class="ibox-content">
                {{ csrf_field() }}
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-3 ">Title <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="title" required/>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="form-group {{ $errors->has('keterangan') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="keterangan" class="col-md-3">Keterangan <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <textarea required name="keterangan" id="keterangan" class="form-control" cols="30"
                                      rows="10"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend>Penanggung Jawab</legend>
                            <div class="form-group {{ $errors->has('pic') ? 'has-error' : '' }}">

                                <div class="row">
                                    <label for="pic" class="col-md-3">PIC <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select name="pic" id="pic" class="form-control" data-placeholder="Pilih PIC">
                                            <option value=""></option>
                                            @foreach ($pic as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('pic'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('pic') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('pic') ? 'has-error' : '' }}">

                                <div class="row">
                                    <label for="supervisor" class="col-md-3">Supervisor <span
                                                class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select name="supervisor" id="supervisor" class="form-control"
                                                data-placeholder="Pilih Supervisor">
                                            <option value=""></option>
                                            @foreach ($supervisor as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('supervisor'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('supervisor') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            


                        </fieldset>
                    </div>
                    <div class="col-md-6">

                        <fieldset>
                            <legend>Waktu</legend>
                            <div class="form-group {{ $errors->has('mulai') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="mulai" class="col-md-3">Tanggal Mulai</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                            <input type="text" class="form-control" name="mulai" id="mulai"/>
                                        </div>
                                        @if ($errors->has('mulai'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('mulai') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('akhir') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="akhir" class="col-md-3">Tanggal Akhir</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                            <input type="text" class="form-control" name="akhir" id="akhir"/>
                                        </div>
                                        @if ($errors->has('akhir'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('akhir') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('jam_mulai') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="jam_mulai" class="col-md-3">Jam Mulai</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                            <input type="text" class="form-control" name="jam_mulai" id="jam_mulai"/>
                                        </div>
                                        @if ($errors->has('jam_mulai'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('jam_mulai') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('jam_akhir') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="jam_akhir" class="col-md-3">Jam Akhir</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                            <input type="text" class="form-control" name="jam_akhir" id="jam_akhir"/>
                                        </div>
                                        @if ($errors->has('jam_akhir'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('jam_akhir') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <fieldset>
                    <legend>Lokasi</legend>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('jenis') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="jenis" class="col-md-3">Jenis</label>
                                    <div class="col-md-9">
                                        <select name="jenis" id="jenis" class="form-control" data-placeholder="Pilih Jenis Lokasi">
                                            <option value=""></option>
                                            <option value="1">Sekolah</option>
                                            <option value="2">Fasilitas Kesehatan</option>
                                            <option value="3">Perkimtan</option>
                                            <option value="4">Apartment</option>
                                            <option value="5">Perumahan</option>
                                        </select>
                                        @if ($errors->has('jenis'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('jenis') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="alamat" class="col-md-3">Alamat</label>
                                    <div class="col-md-9">
                                        <select name="alamat" id="alamat" class="form-control" data-placeholder="Pilih Alamat"></select>
                                        @if ($errors->has('alamat'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>


            </div>
            <div class="ibox-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('jadwal') }}" class="btn btn-default">Batal</a>
            </div>
        </div>
    </form>
@endsection
