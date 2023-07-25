<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Jenis;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Barang::with([
            'jenis',
            'satuan',
        ])->get();
        return view('backend.barang.index', [
            'dataBarang' => $getData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getJenis = Jenis::get();
        $getSatuan = Satuan::get();

        return view('backend.barang.create', [
            'dataJenis' => $getJenis,
            'dataSatuan' => $getSatuan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_barang' => 'required|string|unique:barangs,FK_BRG',
            'nama_barang' => 'required|string',
            'jenis_barang' => 'required|string|exists:jenis,FK_JENIS',
            'satuan_barang' => 'required|string|exists:satuans,FK_SAT',
            'harga_hna' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Aplhanumerik !',
            'max' => 'Maksimum Karakter Yang Boleh di-Input Tidak Boleh Lebih Dari :max Karakter !',
            'unique' => 'Data Dengan Input Tersebut Sudah Ada !',
            'exists' => 'Data Tidak Valid, Silahkan Pilih Ulang Data !',
            'numeric' => 'Input Harus Berupa Angka !',
            'min' => 'Nominal Tidak Boleh Kurang Dari :min !',
        ]);

        DB::beginTransaction();

        try {
            $createData = Barang::create([
                'FK_BRG' => $request->kode_barang,
                'FN_BRG' => $request->nama_barang,
                'FK_JENIS' => $request->jenis_barang,
                'FK_SAT' => $request->satuan_barang,
                'FHARGA_HNA' => $request->harga_hna,
                'FHARGA_JUAL' => $request->harga_jual,
                'FPROFIT' => 0,
                'FSALDO' => 0,
                'FIN' => 0,
                'FOUT' => 0,
            ]);

            DB::commit();
            session()->flash('success', 'Data Barang Berhasil di-Tambahkan !');
            return redirect()->route('backend.barang.index');
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
            $getData = Barang::where('FK_BRG', '=', $id)->firstOrFail();
            $getJenis = Jenis::get();
            $getSatuan = Satuan::get();

            return view('backend.barang.edit', [
                'dataBarang' => $getData,
                'dataJenis' => $getJenis,
                'dataSatuan' => $getSatuan
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
            'kode_barang' => 'required|string|unique:barangs,FK_BRG,' . $id . ',FK_BRG',
            'nama_barang' => 'required|string',
            'jenis_barang' => 'required|string|exists:jenis,FK_JENIS',
            'satuan_barang' => 'required|string|exists:satuans,FK_SAT',
            'harga_hna' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Aplhanumerik !',
            'max' => 'Maksimum Karakter Yang Boleh di-Input Tidak Boleh Lebih Dari :max Karakter !',
            'unique' => 'Data Dengan Input Tersebut Sudah Ada !',
            'exists' => 'Data Tidak Valid, Silahkan Pilih Ulang Data !',
            'numeric' => 'Input Harus Berupa Angka !',
            'min' => 'Nominal Tidak Boleh Kurang Dari :min !',
        ]);

        DB::beginTransaction();
        try {
            $getData = Barang::where('FK_BRG', '=', $id)->firstOrFail();

            $updateData = $getData->update([
                'FK_BRG' => $request->kode_barang,
                'FN_BRG' => $request->nama_barang,
                'FK_JENIS' => $request->jenis_barang,
                'FK_SAT' => $request->satuan_barang,
                'FHARGA_HNA' => $request->harga_hna,
                'FHARGA_JUAL' => $request->harga_jual,
            ]);

            DB::commit();
            session()->flash('info', 'Perubahan Data Barang di-Simpan !');
            return redirect()->route('backend.barang.index');
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
            $getData = Barang::where('FK_BRG', '=', $id)->firstOrFail();
            $delete = $getData->delete();

            DB::commit();
            session()->flash('warning', 'Data Barang di-Hapus !');
            return redirect()->route('backend.barang.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);

        }
    }
}
