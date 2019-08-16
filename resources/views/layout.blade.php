<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
@if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
@endif

@yield('content')
</body>
</html>
