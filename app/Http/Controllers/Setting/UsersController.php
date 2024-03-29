<?php

namespace App\Http\Controllers\Setting;

use App\ApiClient;
use App\Http\Controllers\MyController;
use App\Menu;
use App\Role;
use App\RoleMenu;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;

class UsersController extends MyController
{

    private $js = 'users.js';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderByDesc('created_at')->get();

        foreach ($users as $user) :
            $role = Role::find($user->role_id);
            $user->role = $role;
        endforeach;

        return view('setting/users/index')->with([
            'users' => $users,
            'js' => $this->js,
            'title' => 'Users'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::all();
        return view('setting/users/create')->with([
            'roles' => $roles,
            'title' => 'Buat Users'
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
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'jenis_kelamin' => 'required',
            'nik' => 'required|unique:users,nik'
        ]);

        if ($validator->fails()) {
            return redirect('setting/users/create')
                ->withErrors($validator)
                ->withInput()
                ->with($request->input());
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = $request->input('role');
        $user->nik = $request->input('nik');
        $user->jenis_kelamin = $request->input('jenis_kelamin');

        $user->save();

        return redirect('setting/users/create')->with('success', 'Berhasil Tambah User ' . $user->email);


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
    public function edit($id)
    {


        $users = User::find($id);

        $roles = Role::all();

        $apiClient = ApiClient::where('user_id', $id)->get();

        if (count($apiClient) <= 0) {
            $apiClient = new \stdClass();

            $apiClient->name = '';
            $apiClient->secret = '';
        } else {
            $apiClient = $apiClient[0];
//            return 'ada api';
        }



        return view('setting/users/edit')->with([
            'users' => $users,
            'roles' => $roles,
            'js' => $this->js,
            'apiClient' => $apiClient,
            'title' => 'Edit User'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'jenis_kelamin' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('setting/users/' . $request->input('id') . '/edit')
                ->withErrors($validator)
                ->withInput()
                ->with($request->input());
        }

        $_user = User::find($request->input('id'));

        $_user->name = $request->input('name');
        $_user->email = $request->input('email') ? $request->input('email') : $_user->email;
        $_user->password = bcrypt($request->input('password'));
        $_user->role_id = $request->input('role');
        $_user->nik = $request->input('nik');
        $_user->jenis_kelamin = $request->input('jenis_kelamin');

        // status membership (is_active)
        $_user->is_active = $request->input('is_active') ? true : false;

        $_user->save();

        // Store Client API
        if ($request->input('client_name')){
            $apiClient = ApiClient::where('user_id', $request->input('id'));
            $apiClient = $apiClient->get();
            if ($apiClient) {
                if (is_array($apiClient)){
                    foreach ($apiClient as $api) {
                        $_api = ApiClient::find($api->id);
                        $_api->delete();
                    }
                }
            }

            $_api = new ApiClient();

            $_api->user_id = $request->input('id');
            $_api->name = $request->input('client_name');
            $_api->secret = str_random(40);
            $_api->redirect = 'http://localhost:8000/callback'; // sementara statik dulu
            $_api->personal_access_client = false;
            $_api->password_client = true;
            $_api->revoked = false;

            $_api->save();


        }

        return redirect('setting/users/' . $request->input('id') . '/edit')->with('success', 'Berhasil Update User ' . $_user->email);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = User::find($id);
        $role->delete();

        return redirect('setting/users')->with('success', 'Berhasil Hapus User ' . $id);
    }


    /**
     * Show user profile
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $users = Auth::user();
        $roles = Role::all();


        return view('setting/users/profile')->with([
            'users' => $users,
            'roles' => $roles,
            'js' => $this->js
        ]);
    }
}
