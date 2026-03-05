@extends('layouts.app')

@section('content')

<h2 class="text-center mb-4">Scan Absensi Member</h2>

<div class="card shadow-sm p-4">

<div class="text-center mb-3">
Arahkan QR Code Member ke kamera
</div>

<div id="reader" class="mx-auto"></div>

<div class="text-center mt-4">
<a href="{{ route('attendance.index') }}" class="btn btn-secondary">
Kembali
</a>
</div>

</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>

const CSRF_TOKEN = "{{ csrf_token() }}";

let scanner;
let sudahScan = false;

function onScanSuccess(decodedText, decodedResult){

if(sudahScan) return;

sudahScan = true;

scanner.clear();

fetch("{{ route('attendance.process') }}",{

method:"POST",

headers:{
"Content-Type":"application/json",
"X-CSRF-TOKEN":CSRF_TOKEN,
"Accept":"application/json"
},

body:JSON.stringify({
qr:decodedText
})

})

.then(response => {

if(!response.ok){
throw new Error("Server error");
}

return response.json();

})

.then(data => {

if(data.success){

alert(
"Nama : " + data.data.nama +
"\nStatus : " + data.data.status +
"\nSisa Masa Aktif : " + data.data.sisa_waktu
);

window.location.href = "{{ route('attendance.index') }}?status=success";

}else{

if(data.data){

alert(
"Nama : " + data.data.nama +
"\nStatus : " + data.data.status +
"\nSisa Masa Aktif : " + data.data.sisa_waktu
);

}else{

alert(data.message);

}

window.location.href = "{{ route('attendance.index') }}?status=error";

}

})

.catch(error => {

console.error(error);

alert("Terjadi kesalahan sistem");

window.location.href = "{{ route('attendance.index') }}";

});

}

scanner = new Html5QrcodeScanner(
"reader",
{
fps:10,
qrbox:{ width:250, height:250 }
}
);

scanner.render(onScanSuccess);

</script>

@endsection