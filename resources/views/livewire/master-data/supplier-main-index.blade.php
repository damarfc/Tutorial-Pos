<div>
    <div class="row">
        <div class="col-12 {{ $form == true ? 'd-block' : 'd-none' }}">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="fa fa-edit mr-2 text-success"></span>
                        Form Input {{ $supplierData != null ? 'Edit' : 'Tambah' }} Data Supplier
                    </h4>

                    <div class="card-tools">
                        <button class="btn btn-danger btn-xs px-3" wire:click="openForm(false)">
                            <span class="fa fa-times mr-2"></span>
                            Tutup Form Input 
                        </button>
                    </div>

                </div>

                <div class="card-body py-2">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kode_supplier">Kode Supplier : </label>
                                <input type="text" wire:model="state.kode_supplier" name="kode_supplier" id="kode_supplier" class="form-control {{ $errors->has('state.kode_supplier') ? 'is-invalid' :'' }}" placeholder="Masukan Kode Supplier...">
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.kode_supplier') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="nama_supplier">Nama Supplier : </label>
                                <input type="text" wire:model="state.nama_supplier" name="nama_supplier" id="nama_supplier" class="form-control {{ $errors->has('state.nama_supplier') ? 'is-invalid' :'' }}" placeholder="Masukan Nama Supplier...">
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.nama_supplier') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nomor_telfon">Nomor Telfon : </label>
                                <input type="text" wire:model="state.nomor_telfon" name="nomor_telfon" id="nomor_telfon" class="form-control {{ $errors->has('state.nomor_telfon') ? 'is-invalid' :'' }}" placeholder="Masukan Nomor Telfon Supplier...">
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.nomor_telfon') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="alamat">Alamat Supplier : </label>
                                <textarea wire:model="state.alamat" name="alamat" id="alamat" cols="1" rows="1" class="form-control {{ $errors->has('state.alamat') ? 'is-invalid':'' }}" placeholder="Masukan Alamat Supplier..."></textarea>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.alamat') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kontak">Nama Kontak Supplier : </label>
                                <input type="text" wire:model="state.kontak" name="kontak" id="kontak" class="form-control {{ $errors->has('state.kontak') ? 'is-invalid' :'' }}" placeholder="Masukan Nama Kontak Supplier...">
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.kontak') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-success btn-block" wire:click="{{ $supplierData != null ? 'updateData' : 'tambahData' }}">
                                <span class="fa fa-check mr-2"></span>
                                {{ $supplierData != null ? 'Simpan' : 'Tambah' }} Data Supplier 
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="fa fa-edit mr-2 text-primary"></span>
                        Data Supplier
                    </h4>

                    <div class="card-tools">
                        <button class="btn btn-xs btn-primary px-3" wire:click="openForm(true)">
                            <span class="fa fa-plus mr-2"></span>
                            Tambah Data Supplier
                        </button>
                    </div>
                </div>

                <div class="card-body p-0 table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Supplier</th>
                                <th>Nama Supplier</th>
                                <th>Nomor Telfon</th>
                                <th>Alamat</th>
                                <th>Nama Kontak</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataSupplier as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $item->FK_SUP }}</td>
                                    <td>{{ $item->FNA_SUP }}</td>
                                    <td>{{ $item->FNOTELP }}</td>
                                    <td>{{ $item->FALAMAT }}</td>
                                    <td>{{ $item->FCONTACT }}</td>
                                    <td class="test-center">
                                        <button class="btn btn-sm btn-warning" wire:click="editData('{{ $item->FK_SUP }}')">
                                            Edit Data 
                                        </button>
                                        <button class="btn btn-sm btn-danger" wire:click="deleteData('{{ $item->FK_SUP }}')">
                                            Hapus Data 
                                        </button>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="7">Belum Ada Data Supplier</td>
                            </tr>
                            @endforelse
                           
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
