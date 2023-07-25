<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Jenis::get();
        return view('backend.jenis.index', [
            'dataJenis' => $getData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'kode_jenis' => 'required|string|max:5|unique:jenis,FK_JENIS',
            'nama_jenis' => 'required|string|max:225',
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' =>'Input Harus Berupa Alphanumerik !',
            'max' => 'Makimum Karakter Yang Boleh di-Input Tidak Boleh Lebih Dari :max Karakter !',
            'unique' => 'Data Dengan Input Tersebut Sudah Ada !'
        ]);

        DB::beginTransaction();
        try {
            $createData = Jenis::create([
                'FK_JENIS' => $request->kode_jenis,
                'FN_JENIS' => $request->nama_jenis,
            ]);

            DB::commit();
            session()->flash('success', 'Data Jenis Berhasil di-Tambahkan !');
            return redirect()->route('backend.jenis.index');
        } catch (\Exception $e) {
           DB::rollBack();
           dd($e);
        }

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
        try {
            $getData = Jenis::where('FK_JENIS', '=', $id)->firstOrFail();

            return view('backend.jenis.edit', [
                'dataJenis' => $getData
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
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
        $this->validate($request, [
            'kode_jenis' => 'required|string|max:5|unique:jenis,FK_JENIS,' . $id . ',FK_JENIS',
            'nama_jenis' => 'required|string|max:255', 
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Aplhanumerik !',
            'max' => 'Maksimum Karakter Yang Boleh di-Input Tidak Boleh Lebih Dari :max Karakter !',
            'unique' => 'Data Dengan Input Tersebut Sudah Ada !'
        ]);

        DB::beginTransaction();

        try {
            $getData = Jenis::where('FK_JENIS', '=', $id)->firstOrFail();
            
            $updateData = $getData->update([
                'FK_JENIS' => $request->kode_jenis,
                'FN_JENIS' => $request->nama_jenis,
            ]);

            DB::commit();
            session()->flash('info', 'Data Jenis Berhasil di-Ubah !');
            return redirect()->route('backend.jenis.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $getData = Jenis::where('FK_JENIS', '=', $id)->firstOrFail();
            $deleteData = $getData->delete();

            DB::commit();
            session()->flash('warning', 'Data Jenis di-Hapus !');
            return redirect()->route('backend.jenis.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
