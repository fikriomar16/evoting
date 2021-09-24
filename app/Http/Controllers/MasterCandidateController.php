<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasterCandidateController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('admin.master.kandidat');
    }
    
    public function getCandidates(Request $request, Candidate $candidate)
    {
        if ($request->ajax()) {
            $data = $candidate->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($data)
            {
                return '<button type="button" class="btn btn-sm btn-warning m-1 shadow btn-edit" data-id="'.$data->id.'"><i class="bi bi-pencil-square"></i></button><button type="button" class="btn btn-sm btn-danger m-1 shadow btn-delete" data-id="'.$data->id.'" data-calon="'.$data->nama_calon.'" data-wakil="'.$data->nama_wakil_calon.'"><i class="bi bi-trash"></i></button>';
            })->addColumn('identity', function ($data)
            {
                return $data->id_calon.' / '.$data->id_wakil_calon;
            })->addColumn('candidate', function ($data)
            {
                return $data->nama_calon.' / '.$data->nama_wakil_calon;
            })->addColumn('foto', function ($data){
                return '<img src="'.asset('storage/candidate/'.$data->foto).'" class="img-fluid rounded" alt="'.$data->foto.'">';
            })->addColumn('created_at', function ($data){
                return $data->created_at->format('d/M/Y-H:i');
            })->addColumn('updated_at', function ($data){
                return $data->updated_at->format('d/M/Y-H:i');
            })->rawColumns(['action','foto'])->make(true);
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
            'id_calon' => 'required|min:14|max:18|unique:candidates',
            'id_wakil_calon' => 'required|min:14|max:18|unique:candidates',
            'nama_calon' => 'required|min:4|max:250',
            'nama_wakil_calon' => 'required|min:4|max:250',
            'visi' => 'required',
            'misi' => 'required',
            'foto' => 'image|file|max:2048'
        ]);
        // check php.ini for max upload
        if($request->hasFile('foto')){
            $size = $request->foto->getMaxFilesize();
            $fileNameWithExt = $request->foto->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->foto->getClientOriginalExtension();
            $fileNameToStore = $request->id_calon.'_'.$request->id_wakil_calon.'.'.$extension;
            $path = $request->foto->storeAs('candidate', $fileNameToStore, 'public');
        } else {
            $fileNameToStore = 'default.png';
        }
        $validated['foto'] = $fileNameToStore;
        $candidate = Candidate::create($validated);
        if ($candidate) {
            return response()->json([
                'success' => 'Data Kandidat Berhasil Ditambahkan',
                'data' => $candidate
            ]);
        }
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Candidate $candidate)
    {
        return response()->json($candidate);
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
    public function update(Request $request, Candidate $candidate)
    {
        return $request;
    }
    public function update_data(Request $request, Candidate $candidate)
    {
        $rules = [
            'nama_calon' => 'required|min:4|max:250',
            'nama_wakil_calon' => 'required|min:4|max:250',
            'visi' => 'required',
            'misi' => 'required'
        ];
        if ($request->id_calon != $candidate->id_calon) {
            $rules['id_calon'] = 'required|min:14|max:18|unique:candidates';
        }
        if ($request->id_wakil_calon != $candidate->id_wakil_calon) {
            $rules['id_wakil_calon'] = 'required|min:14|max:18|unique:candidates';
        }
        if($request->hasFile('foto')){
            $rules['foto'] = 'image|file|max:2048';
            $extension = $request->foto->getClientOriginalExtension();
            $fileNameToStore = $request->id_calon.'_'.$request->id_wakil_calon.'.'.$extension;
            $path = $request->foto->storeAs('candidate', $fileNameToStore, 'public');
        } else {
            $fileNameToStore = 'default.png';
        }
        $cred = $request->validate($rules);
        if ($candidate->foto != 'default.png') {
            if ($candidate->id_calon != $request->id_calon || $candidate->id_wakil_calon != $request->id_wakil_calon) {
                Storage::disk('public')->delete('candidate/'.$candidate->foto);
            }
        }
        $cred['foto'] = $fileNameToStore;
        $update = $candidate->update($cred);
        if ($update) {
            $candidate->touch();
            $candidate->save();
            return response()->json([
                'success' => 'Data Kandidat Berhasil Diperbarui',
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
    public function destroy(Candidate $candidate)
    {
        $delete = Candidate::destroy($candidate->id);
        if ($delete) {
            if ($candidate->foto != 'default.png') {
                Storage::disk('public')->delete('candidate/'.$candidate->foto);
            }
            return response()->json([
                'success' => 'Data Kandidat Berhasil Dihapus',
                'data' => $delete
            ]);
        }
    }
}
