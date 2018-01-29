<?php

namespace App\Http\Controllers;

use App\KetuaWarga;
use App\Petugas;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Validator;

class RegistrasiController extends Controller
{
    private $js = 'registrasi.js';

    public function index()
    {
        $roles = Role::where('name', 'not like', '%admin%')
            ->where('name', 'not like', '%manager%')
            ->where('name', 'not like', '%dinkes%')
            ->where('name', 'not like', '%rs%')
            ->where('name', 'not like', '%puskesmas%')
            ->where('name', 'not like', '%ketua_warga%')
            ->get();
        return view('registrasi/index')
            ->with([
                'roles' => $roles,
                'js' => $this->js
            ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required',
            'no_ktp' => 'required|unique:users,nik',
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'required|unique:users,phone',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            'jenis_kelamin' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('registrasi')
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::find($request->input('role'));

        // save user
        $user = new User();
        $user->name = $request->input('nama');
        $user->nik = $request->input('no_ktp');
        $user->email = $request->input('email');
        $user->phone = $request->input('telepon');
        $user->password = bcrypt($request->input('password'));
        $user->is_active = true;
        $user->role_id = $request->input('role');
        $user->jenis_kelamin = $request->input('jenis_kelamin');

        $user->save();

//        switch role

        if ($role->name == 'jumantik') {
            $petugas = new Petugas();
            $petugas->nama = $user->name;
            $petugas->pic = $user->id;
            $petugas->created_by = 8;
            $petugas->save();
        }

        return redirect('registrasi')->with('success', 'Berhasil Registrasi Akun Jumantik Sebagai ' . $role->name);
    }

    public function reset_password()
    {
        return view('registrasi/reset');
    }

    public function store_reset_password(Request $request)
    {
        $messages = [
            'exists' => ':attribute tidak terdaftar.',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password'
        ], $messages);

        if ($validator->fails()) {
            return redirect('reset_password')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('email', $request->input('email'))->first();

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect('reset_password')->with('success', 'Berhasil Reset Password');
    }
}
