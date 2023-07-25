@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">
        <span class="fa fa-edit mr-3"></span>
        Form Input Tambah Data Barang
      </h4>

      <div class="card-tools">
        <a href="{{ route('backend.barang.index') }}" class="btn btn-xs btn-danger px-3">
          <span class="fa fa-arrow-left mr-2"></span>
          Kembali Ke Halaman Daftar Data
        </a>
      </div>
    </div>

    <div class="card-body py-2">
      <form action="{{ route('backend.barang.store') }}" method="post">
        @csrf

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="kode_barang">Kode Barang : </label>
              <input type="text" name="kode_barang" id="kode_barang" class="form-control {{ $errors->has('kode_barang') ? 'is-invalid':'' }}" placeholder="Masukan Kode Barang..." value="{{ old('kode_barang') }}" maxlength="5" required>
              <div class="invalid-feedback">
                {{ $errors->first('kode_barang') }}
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="form-group">
              <label for="nama_barang">Nama Barang : </label>
              <input type="text" name="nama_barang" id="nama_barang" class="form-control {{ $errors->has('nama_barang') ? 'is-invalid':'' }}" placeholder="Masukan Nama Barang..." value="{{ old('nama_barang') }}" required>
              <div class="invalid-feedback">
                {{ $errors->first('nama_barang') }}
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="jenis_barang">Jenis Barang : </label>
              <select name="jenis_barang" id="jenis_barang" class="form-control {{ $errors->has('jenis_barang') ? 'is-invalid':'' }}" required>
                <option value="">- Pilih Data -</option>
                @foreach ($dataJenis as $item)
                  <option value="{{ $item->FK_JENIS }}" {{ old('jenis_barang') == $item->FK_JENIS ? 'selected':'' }}>{{ $item->FN_JENIS }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                {{ $errors->first('jenis_barang') }}
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="satuan_barang">Satuan Barang : </label>
              <select name="satuan_barang" id="satuan_barang" class="form-control {{ $errors->has('satuan_barang') ? 'is-invalid':'' }}" required>
                <option value="">- Pilih Data -</option>
                @foreach ($dataSatuan as $item)
                  <option value="{{ $item->FK_SAT }}" {{ old('satuan_barang') == $item->FK_SAT ? 'selected':'' }}>{{ $item->FN_SAT }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                {{ $errors->first('satuan_barang') }}
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="harga_hna">Harga HNA : </label>
              <input type="number" name="harga_hna" id="harga_hna" class="form-control {{ $errors->has('harga_hna') ? 'is-invalid':'' }}" placeholder="Masukan Harga HNA..." value="{{ old('harga_hna') }}" required>
              <div class="invalid-feedback">
                {{ $errors->first('harga_hna') }}
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="harga_jual">Harga Jual : </label>
              <input type="number" name="harga_jual" id="harga_jual" class="form-control {{ $errors->has('harga_jual') ? 'is-invalid':'' }}" placeholder="Masukan Harga Jual..." value="{{ old('harga_jual') }}" required>
              <div class="invalid-feedback">
                {{ $errors->first('harga_jual') }}
              </div>
            </div>
          </div>

          <div class="col-12">
            <hr class="mt-0 mb-2">
          </div>

          <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-success">
              <span class="fa fa-check mr-3"></span>
              Buat Data Barang
            </button>
          </div>
          
          <div class="col-md-3">
            <button type="reset" class="btn btn-block btn-danger">
              <span class="fa fa-undo mr-3"></span>
              Reset Input
            </button>
          </div>



        </div>

      </form>
    </div>

  </div>
</div>
@endsection