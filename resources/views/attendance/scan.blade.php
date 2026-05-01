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
    const ATTENDANCE_PROCESS_URL = "{{ route('attendance.process') }}";
    const ATTENDANCE_INDEX_URL = "{{ route('attendance.index') }}";

    let scanner;
    let sudahScan = false;

    function onScanSuccess(decodedText, decodedResult) {
        if (sudahScan) {
            return;
        }

        sudahScan = true;
        scanner.clear();

        $.ajax({
            url: ATTENDANCE_PROCESS_URL,
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            headers: {
                "X-CSRF-TOKEN": CSRF_TOKEN,
                "Accept": "application/json"
            },
            data: JSON.stringify({
                qr: decodedText
            }),
            success: function (data) {
                if (data.success) {
                    alert(
                        "Nama : " + data.data.nama +
                        "\nStatus : " + data.data.status +
                        "\nSisa Masa Aktif : " + data.data.sisa_waktu
                    );

                    window.location.href = ATTENDANCE_INDEX_URL + "?status=success";
                } else {
                    if (data.data) {
                        alert(
                            "Nama : " + data.data.nama +
                            "\nStatus : " + data.data.status +
                            "\nSisa Masa Aktif : " + data.data.sisa_waktu
                        );
                    } else {
                        alert(data.message);
                    }

                    window.location.href = ATTENDANCE_INDEX_URL + "?status=error";
                }
            },
            error: function (xhr) {
                console.error(xhr);

                alert("Terjadi kesalahan sistem");

                window.location.href = ATTENDANCE_INDEX_URL;
            }
        });
    }

    scanner = new Html5QrcodeScanner(
        "reader",
        {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        }
    );

    scanner.render(onScanSuccess);
</script>

@endsection