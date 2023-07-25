@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">
        <span class="fa fa-edit mr-3"></span>
        Form Input Edit Data Satuan
      </h4>

      <div class="card-tools">
        <a href="{{ route('backend.satuan.index') }}" class="btn btn-xs btn-danger px-3">
          <span class="fa fa-arrow-left mr-2"></span>
          Kembali Ke Halaman Daftar Data
        </a>
      </div>
    </div>

    <div class="card-body py-2">
      <form action="{{ route('backend.satuan.update', $dataSatuan->FK_SAT) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="kode_satuan">Kode Satuan : </label>
              <input type="text" name="kode_satuan" id="kode_satuan" class="form-control {{ $errors->has('kode_satuan') ? 'is-invalid':'' }}" placeholder="Masukan Kode Satuan..." value="{{ $dataSatuan->FK_SAT }}" maxlength="5" required>
              <div class="invalid-feedback">
                {{ $errors->first('kode_satuan') }}
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="form-group">
              <label for="nama_satuan">Nama Satuan : </label>
              <input type="text" name="nama_satuan" id="nama_satuan" class="form-control {{ $errors->has('nama_satuan') ? 'is-invalid':'' }}" placeholder="Masukan Nama Satuan..." value="{{ $dataSatuan->FN_SAT }}" required>
              <div class="invalid-feedback">
                {{ $errors->first('nama_satuan') }}
              </div>
            </div>
          </div>

          <div class="col-12">
            <hr class="mt-0 mb-2">
          </div>

          <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-success">
              <span class="fa fa-check mr-3"></span>
              Simpan Perubahan
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