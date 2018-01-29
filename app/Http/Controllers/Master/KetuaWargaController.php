<?php

namespace App\Http\Controllers\Master;

use App\KetuaWarga;
use App\Petugas;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KetuaWargaController extends Controller
{
    private $js = 'master/ketua_warga.js';

    public function __construct()
    {
        $this->middleware('auth');


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



        $kecamatan = Kecamatan::all();
        $init_kecamatan = $request->query('kecamatan');

        return view('master/ketua_warga/index')->with([
            'js' => $this->js,
            'kecamatan' => $kecamatan,
            'init_kecamatan' => $init_kecamatan,
            'title' => 'Ketua Warga'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::all();
        $roles = Role::all();

        return view('master/ketua_warga/create')
            ->with([
                'kecamatan' => $kecamatan,
                'js' => $this->js,
                'roles' => $roles,
                'title' => 'Daftar Ketua Warga'
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
            'nama' => 'required|max:100|unique:petugas,nama',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'pic_nama' => 'required',
            'pic_nik' => 'required|unique:users,nik',
            'email' => 'required|email|unique:users,email',
            'pic_phone' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'masa_bakti_mulai' => 'required',
            'masa_bakti_akhir' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'ketua' => 'required'
        ]);


        if ($validator->fails()) {

            return redirect('master/ketua_warga/create')
                ->withErrors($validator)
                ->withInput();
        }

        $petugas = new KetuaWarga();
        $petugas->nama = $request->input('nama');
        $petugas->alamat= $request->input('alamat');
        $petugas->kelurahan = $request->input('kelurahan');
        $petugas->kecamatan = $request->input('kecamatan');

        $petugas->rt = $request->input('rt');
        $petugas->rw = $request->input('rw');
        $petugas->masa_bakti_mulai = date('Y-m-d', strtotime($request->input('masa_bakti_mulai')));
        $petugas->masa_bakti_akhir = date('Y-m-d', strtotime($request->input('masa_bakti_akhir')));
        $petugas->ketua = $request->input('ketua');

        $petugas->is_visible = true;

        // create new user by pic
        $user = new User();
        $user->name = $request->input('pic_nama');
        $user->nik = $request->input('pic_nik');
        $user->email = $request->input('email');
        $user->phone = $request->input('pic_phone');
        $user->role_id = $request->input('role');
        $user->password = bcrypt($request->input('password'));
        $user->is_active = true;
        $user->save();

        $petugas->pic = $user->id;
        $petugas->created_by = Auth::user()->id;
        $petugas->save();


        return redirect('master/ketua_warga/create')->with('success', 'Berhasil Tambah Ketua Warga ' . $petugas->nama);


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
    public function edit(KetuaWarga $ketuaWarga)
    {

        $pic = User::find($ketuaWarga->pic);

        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::where('kecamatan_id', $ketuaWarga->kecamatan)->get();
        $roles = Role::all();

        return view('master/ketua_warga/edit')->with([
            'js' => $this->js,
            'petugas' => $ketuaWarga,
            'kecamatan' => $kecamatan,
            'roles' => $roles,
            'pic' => $pic,
            'kelurahan' => $kelurahan,
            'title' => 'Edit Ketua Warga'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KetuaWarga $_petugas)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:100|unique:petugas,nama',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'pic_nama' => 'required',
            'pic_nik' => 'required|unique:users,nik',
            'email' => 'required|email|unique:users,email',
            'pic_phone' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'masa_bakti_mulai' => 'required',
            'masa_bakti_akhir' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'ketua' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('master/petugas/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $petugas = $_petugas->find($request->input('id'));
        $petugas->nama = $request->input('nama');
        $petugas->alamat= $request->input('alamat');
        $petugas->kelurahan = $request->input('kelurahan');
        $petugas->kecamatan = $request->input('kecamatan');

        $petugas->rt = $request->input('rt');
        $petugas->rw = $request->input('rw');
        $petugas->masa_bakti_mulai = date('Y-m-d', strtotime($request->input('masa_bakti_mulai')));
        $petugas->masa_bakti_akhir = date('Y-m-d', strtotime($request->input('masa_bakti_akhir')));
        $petugas->ketua = $request->input('ketua');

        $petugas->is_visible = true;

        // create new user by pic
        $user = User::find($request->input('pic_id'));
        $user->name = $request->input('pic_nama');
        $user->nik = $request->input('pic_nik');
        $user->email = $request->input('email');
        $user->phone = $request->input('pic_phone');
        $user->role_id = $request->input('role');
        $user->password = bcrypt($request->input('password'));
        $user->is_active = true;
        $user->save();

        $petugas->pic = $user->id;
        $petugas->created_by = Auth::user()->id;
        $petugas->save();


        return redirect('master/ketua_warga/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update Ketua Warga ' . $_petugas->nama);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = KetuaWarga::find($id);

        $role->is_visible = false;

        $role->save();

        return redirect('master/ketua_warga')->with('success', 'Berhasil Hapus Ketua Warga ' . $id);
    }
}
