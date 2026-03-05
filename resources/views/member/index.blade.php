@extends('layouts.app')

@section('content')

<h2 class="mb-4">Daftar Member Gym</h2>
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
{{ session('success') }}
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
<div class="mb-3">
<a href="{{ route('member.create') }}" class="btn btn-primary mb-3">
Tambah Member
</a>
<a href="{{ route('attendance.index') }}" class="btn btn-success mb-3">
Daftar Absensi
</a>
</div>
<table class="table table-hover text-center">

<thead>
<tr>
<th>Foto</th>
<th>Nama</th>
<th>No HP</th>
<th>Masa Aktif</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@foreach($members as $member)

<tr>

<td>
@if($member->foto)
<img src="{{ asset('uploads/members/'.$member->foto) }}" class="member-photo-index">
@endif
</td>

<td>{{ $member->nama }}</td>
<td>{{ $member->no_hp }}</td>
<td>
{{ $member->masa_aktif->format('d M Y') }}
</td>
<td>
@php
$today = Carbon\Carbon::today();
$masaAktif = Carbon\Carbon::parse($member->masa_aktif);
$diff = $today->diffInDays($masaAktif, false);
@endphp
@if ($diff > 1)
<span class="badge bg-success">Aktif ({{ $diff }} hari lagi)</span>
@elseif ($diff == 1)
<span class="badge bg-warning text-dark">Segera Perpanjang (1 hari lagi)</span>
@else 
<span class="badge bg-danger">Sudah Habis Segera Perpanjang</span>
@endif
</td>
<td>
<div class="d-flex flex-column align-items-center gap-1">
<a href="{{ route('member.edit',$member->id) }}" 
   class="btn btn-warning btn-sm">
Lihat
</a>
<a href="{{ route('member.card',$member->id) }}" 
   class="btn btn-info btn-sm">
Print Kartu
</a>
<form action="{{ route('member.destroy',$member->id) }}" 
      method="POST" 
      style="display:inline">
@csrf
@method('DELETE')
<button type="submit"
        class="btn btn-danger btn-sm"
        onclick="return confirm('Yakin ingin menghapus member ini?')">
Hapus
</button>
</form>
</div>
</td>
</tr>

@endforeach

</tbody>

</table>

@endsection