@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">
        <span class="fa fa-table mr-3 text-primary"></span>
        Data Satuan
      </h4>

      <div class="card-tools">
        <a href="{{ route('backend.satuan.create') }}" class="btn btn-xs btn-success px-3">
          <span class="fa fa-plus mr-2"></span>
          Tambah Data Satuan
        </a>
      </div>
    </div>
    
    <div class="card-body p-0 table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kode Satuan</th>
            <th>Nama Satuan</th>
            <th class="text-center" width="20%">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($dataSatuan as $item)
            <tr>
              <td>{{ $loop->iteration }}.</td>
              <td>{{ $item->FK_SAT }}</td>
              <td>{{ $item->FN_SAT }}</td>
              <td class="text-center">
                <div class="btn-group">
                  <form action="{{ route('backend.satuan.destroy', $item->FK_SAT) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <a href="{{ route('backend.satuan.edit', $item->FK_SAT) }}" class="btn btn-warning btn-sm">
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
              <td colspan="4">Belum Ada Data Satuan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      Halaman Data Satuan
    </div>
  </div>
</div>
@endsection