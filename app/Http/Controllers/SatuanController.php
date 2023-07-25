<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Satuan::get();
        return view('backend.satuan.index',[
            'dataSatuan' => $getData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.satuan.create');
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
            'kode_satuan' => 'required|string|max:5|unique:satuans,FK_SAT',
            'nama_satuan' => 'required|string|max:225',
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' =>'Input Harus Berupa Alphanumerik !',
            'max' => 'Makimum Karakter Yang Boleh di-Input Tidak Boleh Lebih Dari :max Karakter !',
            'unique' => 'Data Dengan Input Tersebut Sudah Ada !'
        ]);

        DB::beginTransaction();

        try {
            $createData = Satuan::create([
                'FK_SAT' => $request->kode_satuan,
                'FN_SAT' => $request->nama_satuan,
            ]);

            DB::commit();
            session()->flash('success', 'Data Satuan Berhasil di-Buat !');
            return redirect()->route('backend.satuan.index');
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
            $getData = Satuan::where('FK_SAT', '=', $id)->firstOrFail();

            return view('backend.satuan.edit', [
                'dataSatuan' => $getData
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
            'kode_satuan' => 'required|string|max:5|unique:satuans,FK_SAT,' . $id . ',FK_SAT',
            'nama_satuan' => 'required|string|max:255', 
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Aplhanumerik !',
            'max' => 'Maksimum Karakter Yang Boleh di-Input Tidak Boleh Lebih Dari :max Karakter !',
            'unique' => 'Data Dengan Input Tersebut Sudah Ada !'
        ]);

        DB::beginTransaction();

        try {
            $getData = Satuan::where('FK_SAT', '=', $id)->firstOrFail();
            
            $updateData = $getData->update([
                'FK_SAT' => $request->kode_satuan,
                'FN_SAT' => $request->nama_satuan,
            ]);

            DB::commit();
            session()->flash('info', 'Data Satuan Berhasil di-Ubah !');
            return redirect()->route('backend.satuan.index');
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
            $getData = Satuan::where('FK_SAT', '=', $id)->firstOrFail();
            $deleteData = $getData->delete();

            DB::commit();
            session()->flash('warning', 'Data Satuan di-Hapus !');
            return redirect()->route('backend.satuan.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
    
}
