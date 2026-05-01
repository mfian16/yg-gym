@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
<div class="container py-4">

<h3 class="text-center mb-4">Tambah Member Gym</h3>

<div class="card shadow-sm p-4">

@if ($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="row g-3">

<div class="col-md-6">
<label class="form-label">Nama</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="col-md-6">
<label class="form-label">No HP</label>
<input type="text" name="no_hp" class="form-control">
</div>

<div class="col-12">
<label class="form-label">Alamat</label>
<textarea name="alamat" class="form-control" rows="2"></textarea>
</div>

<div class="col-md-6">
<label class="form-label">Paket</label>
<input type="text" name="paket" id="paket" class="form-control" value="Bulanan" readonly>
</div>

<div class="col-md-6">
<label class="form-label">Masa Aktif</label>
<input type="date" name="masa_aktif" id="masa_aktif" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Foto Member</label>
<input type="file" id="fotoInput" class="form-control">
</div>
<div class="mb-3 text-center">
<img id="preview" style="max-width:300px; display:none;">
</div>
<input type="hidden" name="foto" id="fotoCropped">
<div class="text-center mt-3">
<button class="btn btn-success px-4">
Simpan
</button>

<a href="{{ route('member.index') }}" class="btn btn-secondary px-4">
Kembali
</a>

</div>

</div>

</form>

</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
@endsection