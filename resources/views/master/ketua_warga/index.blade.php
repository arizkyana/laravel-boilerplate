@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('success') }}
        </div>
    @endif

    {{--filter--}}
    <div class="ibox">
        <div class="ibox-content no-overflow">
            <form id="form-filter">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control" data-placeholder="Pilih Kecamatan" name="kecamatan"
                                        id="kecamatan">
                                    <option value=""></option>
                                    @foreach ($kecamatan as $item)
                                        <option value="{{$item->kecamatan_id}}">{{$item->nama_kecamatan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="kelurahan">Kelurahan</label>
                                <select name="kelurahan" data-placeholder="Pilih Kelurahan" class="form-control"
                                        id="kelurahan-ketua-warga"></select>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--/filter--}}

    <div class="ibox">
        <div class="ibox-title">
            <h5>Daftar Ketua Warga</h5>
            <div class="ibox-tools">
                <a href="{{ route('master/ketua_warga/create') }}" class="btn btn-primary">
                    <i class="glyphicon glyphicon-plus-sign"></i> Tambah Ketua Warga
                </a>
            </div>
        </div>
        <div class="ibox-content ">

            <table id="table-dinkes" class="table table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Alamat</th>
                    <th class="text-center" colspan="3">Masa Bakti</th>
                    <th rowspan="2" class="text-center">Telepon</th>
                    <th class="text-center" rowspan="2">Action</th>
                </tr>
                <tr>
                    <th class="text-center">Ketua</th>
                    <th class="text-center">Mulai</th>
                    <th class="text-center">Akhir</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection
