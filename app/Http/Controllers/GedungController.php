<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gedungs = Gedung::latest()->paginate(5);

        //render view with gedungs
        return view('gedungs.index', compact('gedungs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('gedungs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nama_gedung'     => 'required',
            'alamat_gedung'   => 'required',
            'lantai'          => 'required',
            'fasilitas_gedung'=> 'required'
            
        ]);

        //create gedung
        Gedung::create($request->all());
     
        //redirect to index
        return redirect()->route('gedungs.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function show(Gedung $gedung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function edit(Gedung $gedung)
    {
        //
        return view('gedungs.edit', compact('gedung'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gedung $gedung)
    {
        //
        $this->validate($request, [
            'nama_gedung'     => 'required',
            'alamat_gedung'   => 'required',
            'lantai'   => 'required',
            'fasilitas_gedung'   => 'required'
            
        ]);

        // $gedung->update([
        //     'nama_gedung'  => $request->nama_gedung,
        //     'alamat_gedung'     => $request->alamat_gedung,
        //     'lantai'     => $request-lantai,
        //     'fasilitas_gedung'  => $request->fasilitas_gedung,
        // ]);
        $gedung->update($request->all());
    
        //redirect to index
        return redirect()->route('gedungs.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gedung $gedung)
    {
        //
        Storage::delete('public/gedungs/'. $gedung->image);

        //delete gedung
        $gedung->delete();

        //redirect to index
        return redirect()->route('gedungs.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
