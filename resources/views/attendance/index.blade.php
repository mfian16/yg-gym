@extends('layouts.app')

@section('content')

<h2 class="mb-4">Daftar Absensi Member</h2>

@if(request('status') == 'success')
<div class="alert alert-success">
Absensi berhasil dilakukan.
</div>
@endif

@if(request('status') == 'error')
<div class="alert alert-danger">
Absensi gagal dilakukan.
</div>
@endif

<div class="mb-3">
<a href="{{ route('attendance.scan') }}"
   class="btn btn-success mb-3">

Scan Absensi

</a>

<a href="{{ route('member.index') }}"
   class="btn btn-primary mb-3">

Daftar Member

</a>

</div>

@if(request('success'))
<div class="alert alert-success">
Absensi berhasil dilakukan.
</div>
@endif

<div class="table-responsive">

<table class="table table-hover text-center align-middle shadow-sm">

<thead class="table-dark">

<tr>
<th>Nama Member</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Status</th>
</tr>

</thead>

<tbody>

@forelse($attendances as $attendance)

<tr>

<td>
{{ $attendance->member->nama ?? '-' }}
</td>

<td>
{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d M Y') }}
</td>

<td>
{{ $attendance->jam_masuk }}
</td>

<td>
<span class="badge bg-success">
{{ $attendance->status }}
</span>
</td>

</tr>

@empty

<tr>
<td colspan="4">Belum ada data absensi</td>
</tr>

@endforelse

</tbody>

</table>

</div>
@endsection