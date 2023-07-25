@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">
        <span class="fa fa-table mr-3 text-primary"></span>
        Data Barang
      </h4>

      <div class="card-tools">
        <a href="{{ route('backend.barang.create') }}" class="btn btn-xs btn-success px-3">
          <span class="fa fa-plus mr-2"></span>
          Tambah Data Barang
        </a>
      </div>
    </div>
    
    <div class="card-body p-0 table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kode barang</th>
            <th>Nama barang</th>
            <th>Jenis Barang</th>
            <th>Satuan Barang</th>
            <th>Harga HNA</th>
            <th>Harga Jual</th>
            <th class="text-center" width="20%">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($dataBarang as $item)
            <tr>
              <td>{{ $loop->iteration }}.</td>
              <td>{{ $item->FK_BRG }}</td>
              <td>{{ $item->FN_BRG }}</td>
              <td>{{ $item->jenis->FN_JENIS }}</td>
              <td>{{ $item->satuan->FN_SAT }}</td>
              <td>Rp. {{ number_format($item->FHARGA_HNA, 0, ',', '.') }}</td>
              <td>Rp. {{ number_format($item->FHARGA_JUAL, 0, ',', '.') }}</td>
              <td class="text-center">
                <div class="btn-group">
                  <form action="{{ route('backend.barang.destroy', $item->FK_BRG) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <a href="{{ route('backend.barang.edit', $item->FK_BRG) }}" class="btn btn-warning btn-sm">
                      Edit Data
                    </a>
                  
                    <button type="submit" class="btn btn-danger btn-sm">
                      Hapus Data
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8">Belum Ada Data Barang.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      Halaman Data Barang
    </div>
  </div>
</div>
@endsection