<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin.pages.kegiatan.index');
        $data = Kegiatan::All();

        return view('admin.pages.kegiatan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'nama_kegiatan' => 'required',
            'foto_kegiatan' => 'required',
            'deskripsi_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
        ]);

        //store kegiatan
        $kegiatan = new Kegiatan();
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->deskripsi_kegiatan = $request->deskripsi_kegiatan;
        $kegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;

        $imagePath = "";
        if ($request->hasFile('foto_kegiatan')) {
            $image = $request->foto_kegiatan;
            $imageName = time() . $image->getClientOriginalName();
            $image->move('backend/img/kegiatan/', $imageName);
            $imagePath = 'backend/img/kegiatan/' . $imageName;
        }
        $kegiatan->foto_kegiatan = $imagePath;

        $kegiatan->save();
        return redirect()->route('list.kegiatan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kegiatan::find($id);
        if (!$data) return view('error-404');
        return view('admin.pages.kegiatan.update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::where('id', $id)->first();
        if (file_exists($kegiatan->foto_kegiatan)) {
            unlink($kegiatan->kegiatan);
        }
        $kegiatan->delete();
        return redirect()->route('list.kegiatan');
    }
}
