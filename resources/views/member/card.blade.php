<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

body{
    font-family: Arial, sans-serif;
}

.card{
    width:520px;
    border:3px solid #000;
    border-radius:10px;
    padding:15px;
}

.header{
    font-size:20px;
    font-weight:bold;
    margin-bottom:10px;
}

.photo{
    width:120px;
    height:160px;
    object-fit:cover;
    border-radius:6px;
}

.qr{
    width:150px;
}

.info{
    margin-top:10px;
}

.label{
    font-weight:bold;
}

</style>

</head>

<body>

<div class="card">

<div class="header">
YG GYM
</div>

<table width="100%">

<tr>

<td width="50%" align="center">

@if($member->foto)

<img src="{{ public_path('uploads/members/'.$member->foto) }}"
     class="photo">

@endif

</td>

<td width="50%" align="center">

<img src="data:image/svg+xml;base64,{{ $qr }}" class="qr">

</td>

</tr>

</table>

<div class="info">

<div>
<span class="label">Nama :</span>
{{ $member->nama }}
</div>

<br>

<div>
<span class="label">ID QR-CODE :</span>
{{ $member->qr_code }}
</div>

<br>

<div>
<span class="label">Expired :</span>
{{ $member->masa_aktif }}
</div>

</div>

</div>

</body>
</html>