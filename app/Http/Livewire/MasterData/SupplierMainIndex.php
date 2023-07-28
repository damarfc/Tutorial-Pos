<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SupplierMainIndex extends Component
{
    public $form = false;

    public $supplierData = [];

    public $state = [];
    public $params = [
        'kode_supplier' => null,
        'nama_supplier' => null,
        'nomor_telfon' => null,
        'alamat' => null,
        'kontak' => null,
    ];

    public function mount()
    {
        $this->state = $this->params;
    }

    public function render()
    {
        $getData = Supplier::get();

        return view('livewire.master-data.supplier-main-index', [
            'dataSupplier' => $getData
        ]);
    }

    public function resetForm()
    {
        $this->reset('state');
        $this->state = $this->params;

        if ($this->supplierData != null) {
            $this->state['kode_supplier'] = $this->supplierData['FK_SUP'];
            $this->state['nama_supplier'] = $this->supplierData['FNA_SUP'];
            $this->state['nomor_telfon'] = $this->supplierData['FNOTELP'];
            $this->state['alamat'] = $this->supplierData['FALAMAT'];
            $this->state['kontak'] = $this->supplierData['FCONTACT'];
        }
    }

    public function openForm($show)
    {
        $this->form = $show;


        if ($show == false) {
            $this->reset('supplierData');
        }


        $this->resetForm();
    }

    public function tambahData()
    {
        $this->validate([
        'state.kode_supplier' => 'required|string|max:5|unique:suppliers,FK_SUP',
        'state.nama_supplier' => 'required|string',
        'state.nomor_telfon' => 'required|string',
        'state.alamat' => 'required|string',
        'state.kontak' => 'required|string',
        ],[
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Alphanumerik !',
            'max' => 'Maksimum Karakter Tidak Boleh Lebih Dari :max Karakter !',
            'unique' => 'Data Sudah Ada, Silahkan Masukan Kode Baru !'
        ]);
        
        DB::beginTransaction();
        try {
            $createData = Supplier::create([
                'FK_SUP' => $this->state['kode_supplier'],
                'FNA_SUP' => $this->state['nama_supplier'],
                'FNOTELP' =>$this->state['nomor_telfon'],
                'FALAMAT' =>$this->state['alamat'],
                'FCONTACT' =>$this->state['kontak']
            ]);

            DB::commit();
            $this->emit('success', 'Data Supplier Berhasil di-Tambahkan !');
            $this->openForm(false);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
        
    }

    public function editData($id)
    {
        try {
            $getData = Supplier::where('FK_SUP', '=', $id)->firstOrFail();
            $this->supplierData = $getData->toArray();

            $this->openForm(true);
        } catch (\Exception $e) {
            
            dd($e);
        }
    }

    public function updateData()
    {
        
        $this->validate([
            'state.kode_supplier' => 'required|string|max:5|unique:suppliers,FK_SUP,' . $this->supplierData['FK_SUP'] . ',FK_SUP',
            'state.nama_supplier' => 'required|string',
            'state.nomor_telfon' => 'required|string',
            'state.alamat' => 'required|string',
            'state.kontak' => 'required|string',
            ],[
                'required' => 'Input Tidak Boleh Kosong !',
                'string' => 'Input Harus Berupa Alphanumerik !',
                'max' => 'Maksimum Karakter Tidak Boleh Lebih Dari :max Karakter !',
                'unique' => 'Data Sudah Ada, Silahkan Masukan Kode Baru !'
            ]);
        
        DB::beginTransaction();
        try {
            $getData = Supplier::where('FK_SUP', '=', $this->supplierData['FK_SUP'])->firstOrFail();
            $upadteData = $getData->update([
                'FK_SUP' => $this->state['kode_supplier'],
                'FNA_SUP' => $this->state['nama_supplier'],
                'FNOTELP' => $this->state['nomor_telfon'],
                'FALAMAT' => $this->state['alamat'],
                'FCONTACT' => $this->state['kontak']

            ]);
            DB::commit();
            $this->emit('info', 'Pembaharuan Data Supplier di-Simpan');
            $this->openForm(false);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
    
    public function deleteData($id)
    {
        DB::beginTransaction();
        try {
            $getData = Supplier::where('FK_SUP', '=', $id)->firstOrFail();
            $deleteData = $getData->delete();

            DB::commit();
            $this->emit('warning', 'Data Supplier di-Hapus !');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
