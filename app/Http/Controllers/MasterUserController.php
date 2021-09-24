<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use DateTime;

class MasterUserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('admin.master.pemilih', [
            'profile' => new User
        ]);
    }
    
    public function getUsers(Request $request, User $user)
    {
        if ($request->ajax()) {
            $data = $user->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($data)
            {
                return '<button type="button" class="btn btn-sm btn-warning m-1 shadow btn-edit" data-id="'.$data->id.'" data-username="'.$data->username.'"><i class="bi bi-pencil-square"></i></button><button type="button" class="btn btn-sm btn-danger m-1 shadow btn-delete" data-id="'.$data->id.'" data-username="'.$data->username.'" data-name="'.$data->name.'"><i class="bi bi-trash"></i></button>';
            })->addColumn('birth_date', function ($data){
                return date_format(new DateTime($data->birth_date), "d/M/Y");
            })->addColumn('active', function ($data){
                $is_act = ($data->active == 1) ? 'Aktif' : 'Nonaktif' ;
                return $is_act;
            })->addColumn('created_at', function ($data){
                return $data->created_at->format('d/M/Y-H:i');
            })->addColumn('updated_at', function ($data){
                return $data->updated_at->format('d/M/Y-H:i');
            })->rawColumns(['action'])->make(true);
        }
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|min:14|max:18|unique:users,username',
            'name' => 'required|max:250',
            'password' => 'required|min:6|max:100',
            'birth_date' => 'required'
        ]);
        $validated['password'] = bcrypt($request->password);
        if ($request->is_active) {
            $validated['active'] = 1;
        } else {
            $validated['active'] = 0;
        }
        $user = User::create($validated);
        if ($user) {
            return response()->json([
                'success' => 'Data Pemilih Berhasil Ditambahkan',
                'data' => $user
            ]);
        }
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(User $user)
    {
        return response()->json($user);
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:250',
            'birth_date' => 'required'
        ];
        if ($request->username != $user->username) {
            $rules['username'] = 'required|min:14|max:18|unique:users,username';
        }
        if ($request->password != '') {
            $rules['password'] = 'required|min:6|max:100';
        }
        $cred = $request->validate($rules);
        if ($request->password != '') {
            $cred['password'] = bcrypt($request->password);
        }
        if ($request->is_active) {
            $cred['active'] = 1;
        } else {
            $cred['active'] = 0;
        }
        $update = $user->update($cred);
        if ($update) {
            $user->touch();
            $user->save();
            return response()->json([
                'success' => 'Data Pemilih Berhasil Diperbarui',
                'data' => $cred
            ]);
        }
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $user)
    {
        $delete = User::destroy($user->id);
        if ($delete) {
            return response()->json([
                'success' => 'Data Pemilih Berhasil Dihapus',
                'data' => $delete
            ]);
        }
    }

    public function active_all(Request $request)
    {
        $update = User::where('active', 0)->update(['active' => $request->active]);
        if ($update) {
            return response()->json([
                'success' => 'Data Pemilih Telah Diaktifkan Semua',
                'data' => $update
            ]);
        }
    }

    public function inactive_all(Request $request)
    {
        $update = User::where('active', 1)->update(['active' => $request->active]);
        if ($update) {
            return response()->json([
                'success' => 'Data Pemilih Telah Dinonaktifkan Semua',
                'data' => $update
            ]);
        }
    }
}
