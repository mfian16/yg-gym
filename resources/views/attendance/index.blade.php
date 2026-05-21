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

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <a href="{{ route('attendance.scan') }}" class="btn btn-success">
            Scan Absensi
        </a>

        <a href="{{ route('member.index') }}" class="btn btn-primary">
            Daftar Member
        </a>
    </div>

    <div style="width: 300px;">
        <div class="input-group">
            <span class="input-group-text">🔍</span>
            <input type="text"
                   class="form-control search-table"
                   data-target="#tableAttendance"
                   placeholder="Cari absensi...">
        </div>
    </div>
</div>
@if(request('success'))
<div class="alert alert-success">
Absensi berhasil dilakukan.
</div>
@endif

<div class="table-responsive">

<table class="table table-hover text-center align-middle shadow-sm" id="tableAttendance">

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