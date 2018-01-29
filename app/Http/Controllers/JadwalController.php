<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Dinkes;
use App\Faskes;
use App\Jadwal;
use App\Kecamatan;
use App\Kelurahan;
use App\Perkimtan;
use App\Perumahan;
use App\Role;
use App\Sekolah;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    private $js = 'jadwal.js';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $jadwal = DB::table('jadwal')
            ->select(
                'jadwal.id',
                'jadwal.mulai',
                'jadwal.akhir',
                'jadwal.jam_mulai',
                'jadwal.jam_akhir',
                'jadwal.status',
                'jadwal.title',
                'jadwal.keterangan',

                'pic.name as pic',
                'supervisor.name as supervisor'
            )
            ->join('role as pic', 'jadwal.pic', '=', 'pic.id')
            ->join('role as supervisor', 'jadwal.supervisor', '=', 'supervisor.id')
            ->orderByDesc('jadwal.created_at')
            ->where('jadwal.is_visible', true)
            ->get();

//        return $jadwal;

        return view('jadwal/index')->with([
            'js' => $this->js,
            'jadwal' => $jadwal,
            'title' => 'Jadwa Monitoring'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pic = DB::table('role')
            ->select('role.*')
            ->where('role.name', 'like', '%jumantik%')
            ->get();

        $supervisor = DB::table('role')
            ->select('role.*')
            ->where('role.name', 'like', '%puskesmas%')
            ->orWhere('role.name', 'like', '%dinkes%')
            ->orWhere('role.name', 'like', '%rs%')
            ->get();

        return view('jadwal/create')
            ->with([
                'js' => $this->js,
                'pic' => $pic,
                'supervisor' => $supervisor,
                'title' => 'Buat Jadwal Monitoring'
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mulai' => 'required',
            'akhir' => 'required',
            'jam_mulai' => 'required',
            'jam_akhir' => 'required',
            'pic' => 'required',
            'supervisor' => 'required',
            'title' => 'required|unique:jadwal,title',
            'keterangan' => 'required',
            'alamat' => 'required',

            'jenis' => 'required', // sekolah, apartment

        ]);


        if ($validator->fails()) {

            return redirect('jadwal/create')
                ->withErrors($validator)
                ->withInput();
        }

        $jadwal = new Jadwal();
        $jadwal->mulai = date('Y-m-d', strtotime($request->input('mulai')));
        $jadwal->akhir = date('Y-m-d', strtotime($request->input('akhir')));
        $jadwal->jam_mulai = $request->input('jam_mulai');
        $jadwal->jam_akhir = $request->input('jam_akhir');
        $jadwal->pic = $request->input('pic');
        $jadwal->supervisor = $request->input('supervisor');
        $jadwal->title = $request->input('title');
        $jadwal->keterangan = $request->input('keterangan');

        $jadwal->alamat = json_encode(Jadwal::lokasi($request->input('jenis'), $request->input('alamat')));
        $jadwal->jenis = $request->input('jenis');

        $jadwal->is_visible = true;
        $jadwal->status = 1;

        $jadwal->created_by = Auth::user()->id;

        $jadwal->save();

        return redirect('jadwal/create')->with('success', 'Berhasil Tambah Jadwal ' . $jadwal->title);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        $pic = Role::where('name', 'like', '%jumantik%')->get();

        $supervisor = Role::where('name', 'like', '%puskesmas%')
            ->orWhere('name', 'like', '%dinkes%')
            ->orWhere('name', 'like', '%rs%')
            ->get();

        switch ($jadwal->jenis){
            case 1:
                $lokasi = Sekolah::all();
                break;
            case 2:
                $lokasi = Faskes::all();
                break;
            case 3:
                $lokasi = Perkimtan::all();
                break;
            case 4:
                $lokasi = Apartment::all();
                break;
            case 5:
                $lokasi = Perumahan::all();
                break;
        }

        $jadwal->alamat = json_decode($jadwal->alamat);



        return view('jadwal/edit')->with([
            'js' => $this->js,
            'jadwal' => $jadwal,
            'pic' => $pic,
            'supervisor' => $supervisor,
            'title' => 'Edit Jadwal Monitoring',
            'lokasi' => $lokasi

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {

        $validator = Validator::make($request->all(), [
            'mulai' => 'required',
            'akhir' => 'required',
            'jam_mulai' => 'required',
            'jam_akhir' => 'required',
            'pic' => 'required',
            'supervisor' => 'required',
            'title' => 'required',
            'keterangan' => 'required',
            'alamat' => 'required',
            'jenis' => 'required', // sekolah, apartment

        ]);


        if ($validator->fails()) {

            return redirect('jadwal/create')
                ->withErrors($validator)
                ->withInput();
        }

        $jadwal->mulai = date('Y-m-d', strtotime($request->input('mulai')));
        $jadwal->akhir = date('Y-m-d', strtotime($request->input('akhir')));
        $jadwal->jam_mulai = $request->input('jam_mulai');
        $jadwal->jam_akhir = $request->input('jam_akhir');
        $jadwal->pic = $request->input('pic');
        $jadwal->supervisor = $request->input('supervisor');
        $jadwal->title = $request->input('title');
        $jadwal->keterangan = $request->input('keterangan');

        $jadwal->alamat = json_encode(Jadwal::lokasi($request->input('jenis'), $request->input('alamat')));
        $jadwal->jenis = $request->input('jenis');

        $jadwal->is_visible = true;
        $jadwal->status = 1;

        $jadwal->created_by = Auth::user()->id;

        $jadwal->save();

        return redirect('jadwal/' . $jadwal->id . '/edit')->with('success', 'Berhasil Update Jadwal ' . $jadwal->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);

        $jadwal->is_visible = false;

        $jadwal->save();

        return redirect('jadwal')->with('success', 'Berhasil Hapus Jadwal ' . $jadwal->title);
    }


}
