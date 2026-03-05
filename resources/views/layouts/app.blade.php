<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>YG GYM</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand" href="{{ route('member.index') }}">
YG GYM
</a>
</div>
</nav>
<div class="container mt-4">
@yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
setTimeout(function(){
let alert = document.querySelector('.alert');
if(alert){
alert.style.display = 'none';
}
},3000);
</script>
</html>