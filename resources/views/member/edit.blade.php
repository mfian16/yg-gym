@extends('layouts.app')
@section('content')
<div class="container py-4">
<h3 class="mb-4 text-center">Edit Data Member</h3>
<div class="card shadow-sm p-4">
<form action="{{ route('member.update', $member->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="row g-3">
<!-- FOTO -->
<div class="row mb-4 align-items-center">
<div class="col-md-6 text-center">
@if($member->foto)
<img src="{{ asset('uploads/members/' . $member->foto) }}"
class="rounded shadow mb-2"
style="width:200px;height:200px;object-fit:cover;">
@else
<div class="text-muted">Belum ada foto</div>
@endif
<br><label class="form-label">Ganti Foto</label>
<input type="file" class="form-control" name="foto">
</div>
<div class="col-md-6 text-center">
@if($member->qr_code)
<h6 class="fw-bold mb-2">{{ $member->qr_code }}</h6>
<div class="mb-2">
{!! QrCode::size(150)->generate($member->qr_code) !!}
</div>
<label class="form-label">QR Code Member</label><br>
<a href="{{ route('member.qrcode.download',$member->id) }}"
class="btn btn-success btn-sm">
Download QR Code
</a>
@endif
</div>
</div>
<!-- NAMA -->
<div class="col-md-6">
<label class="form-label">Nama</label>
<input type="text" name="nama" class="form-control" value="{{ old('nama', $member->nama) }}" required>
</div>
<!-- NO HP -->
<div class="col-md-6">
<label class="form-label">No HP</label>
<input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $member->no_hp) }}">
</div>
<!-- ALAMAT -->
<div class="col-12">
<label class="form-label">Alamat</label>
<textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $member->alamat) }}</textarea>
</div>
<!-- PAKET -->
<div class="col-md-6">
<label class="form-label">Paket</label>
<select name="paket" id="paket" class="form-select" required>
<option value="Bulanan" {{ $member->paket == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
</select>
</div>
<!-- MASA AKTIF -->
<div class="col-md-6">
<label class="form-label">Masa Aktif</label>
<input type="date"
name="masa_aktif"
id="masa_aktif"
class="form-control"
value="{{ old('masa_aktif', $member->masa_aktif ? $member->masa_aktif->format('Y-m-d') : '') }}">
</div>
<!-- TOMBOL -->
<div class="col-12 text-center mt-4">
<button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
<br><br>
<a href="{{ route('member.index') }}" class="btn btn-secondary px-4 ms-2">Kembali</a>
</div>
</div>
</form>
</div>
</div>
<!-- Script otomatis hitung masa aktif -->
<script>
    document.getElementById('paket').addEventListener('change', function() {
        const masaAktifInput = document.getElementById('masa_aktif');
        const paket = this.value;
        const today = new Date();

        if (paket === 'Bulanan') {
            today.setDate(today.getDate() + 29);
        } else {
            masaAktifInput.value = '';
            return;
        }

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        masaAktifInput.value = `${year}-${month}-${day}`;
    });
</script>
@endsection