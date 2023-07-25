@extends('backend.layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">
        <span class="fa fa-edit mr-3"></span>
        Form Input Edit Data Jenis
      </h4>

      <div class="card-tools">
        <a href="{{ route('backend.jenis.index') }}" class="btn btn-xs btn-danger px-3">
          <span class="fa fa-arrow-left mr-2"></span>
          Kembali Ke Halaman Daftar Data
        </a>
      </div>
    </div>

    <div class="card-body py-2">
      <form action="{{ route('backend.jenis.update', $dataJenis->FK_JENIS) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="kode_jenis">Kode Jenis : </label>
              <input type="text" name="kode_jenis" id="kode_jenis" class="form-control {{ $errors->has('kode_jenis') ? 'is-invalid':'' }}" placeholder="Masukan Kode Jenis..." value="{{ $dataJenis->FK_JENIS }}" maxlength="5" required>
              <div class="invalid-feedback">
                {{ $errors->first('kode_jenis') }}
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="form-group">
              <label for="nama_jenis">Nama Jenis : </label>
              <input type="text" name="nama_jenis" id="nama_jenis" class="form-control {{ $errors->has('nama_jenis') ? 'is-invalid':'' }}" placeholder="Masukan Nama Jenis..." value="{{ $dataJenis->FN_JENIS }}" required>
              <div class="invalid-feedback">
                {{ $errors->first('nama_jenis') }}
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