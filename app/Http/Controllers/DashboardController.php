<?php

namespace App\Http\Controllers;

use App\AreaKecamatan;
use App\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        return view('dashboard')->with([
            'title' => 'Dashboard',
        ]);
    }

    public function get_all_kecamatan(){
        return Kecamatan::where('is_active', TRUE)->get();
    }

    public function get_area_by_kecamatan(Request $request){
        $nama_kecamatan = $request->input('nama_kecamatan');
        return AreaKecamatan::where('nama_kecamatan', $nama_kecamatan)->get();
    }
}
