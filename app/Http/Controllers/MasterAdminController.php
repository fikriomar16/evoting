<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use DataTables;

class MasterAdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('admin.master.admin');
    }
    public function getAdmins(Request $request, Admin $admin)
    {
        if ($request->ajax()) {
            $data = $admin->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($data)
            {
                $btn = '';
                $btn_edit = '<button type="button" class="btn btn-sm btn-warning m-1 shadow btn-edit" data-id="'.$data->id.'" data-username="'.$data->username.'"><i class="bi bi-pencil-square"></i></button>';
                $btn_delete = '<button type="button" class="btn btn-sm btn-danger m-1 shadow btn-delete" data-id="'.$data->id.'" data-username="'.$data->username.'" data-name="'.$data->name.'"><i class="bi bi-trash"></i></button>';
                if (auth()->guard('admin')->id() == $data->id || auth()->guard('admin')->user()->is_super == 1) {
                    $btn.=$btn_edit;
                }
                if (auth()->guard('admin')->user()->is_super == 1) {
                    if (auth()->guard('admin')->id() != $data->id) {
                        $btn.=$btn_delete;
                    }
                }
                return $btn;
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
            'username' => 'required|min:6|max:24|unique:admins,username',
            'name' => 'required|min:4|max:250',
            'password' => 'required|min:6|max:100',
        ]);
        $validated['password'] = bcrypt($request->password);
        $validated['is_super'] = 0;
        $admin = Admin::create($validated);
        if ($admin) {
            return response()->json([
                'success' => 'Data Admin Berhasil Ditambahkan',
                'data' => $admin
            ]);
        }
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Admin $admin)
    {
        return response()->json($admin);
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
    public function update(Request $request, Admin $admin)
    {
        $rules = [
            'name' => 'required|min:4|max:250',
        ];
        if ($request->username != $admin->username) {
            $rules['username'] = 'required|min:6|max:24|unique:admins,username';
        }
        if ($request->password != '') {
            $rules['password'] = 'required|min:6|max:100';
        }
        $cred = $request->validate($rules);
        if ($request->password != '') {
            $cred['password'] = bcrypt($request->password);
        }
        $update = $admin->update($cred);
        if ($update) {
            $admin->touch();
            $admin->save();
            return response()->json([
                'success' => 'Data Admin Berhasil Diperbarui',
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
    public function destroy(Admin $admin)
    {
        $delete = Admin::destroy($admin->id);
        if ($delete) {
            return response()->json([
                'success' => 'Data Admin Berhasil Dihapus',
                'data' => $delete
            ]);
        }
    }
}
