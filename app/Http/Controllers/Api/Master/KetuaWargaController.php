<?php

namespace App\Http\Controllers\Api\Master;

use App\Apartment;
use App\AreaKecamatan;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\KetuaWarga;
use App\Utils\Datatables;
use App\Utils\ResponseMod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KetuaWargaController extends Controller
{
    /**
     * Load laporan with datatables configuration
     *
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $start = $request->input('start');
        $length = $request->input('length');
        $draw = $request->input('draw');


        $count = DB::table('ketua_warga')->count();

        $data = $ketua_warga = DB::table('ketua_warga')
            ->select('ketua_warga.*', 'kecamatan.nama_kecamatan', 'kelurahan.nama_kelurahan')
            ->leftJoin('kecamatan', 'ketua_warga.kecamatan', '=', 'kecamatan.kecamatan_id')
            ->leftJoin('kelurahan', 'ketua_warga.kelurahan', '=', 'kelurahan.kelurahan_id')
            ->offset($start)
            ->limit($length)
            ->where('ketua_warga.is_visible', true);


        if ($request->query('kecamatan') && $request->query('kelurahan')) {

            $data->where('ketua_warga.kecamatan', $request->query('kecamatan'));
            $data->where('ketua_warga.kelurahan', $request->query('kelurahan'));

        }


        $data = Datatables::like($request, $data);
        $data = Datatables::order($request, $data);

        $data = $data->get();

        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $data,

        ];
    }

    public function destroy(Request $request)
    {
        $ketua_warga = KetuaWarga::find($request->input('id'));
        $ketua_warga->is_visible = false;
        $ketua_warga->save();

        return $ketua_warga;
    }


}
