<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>彰化縣校務管理系統</title>
    @include('layouts.js_up')
    @include('layouts.css')
    @yield('page_css')
</head>

<body>
@yield('content')

@include('layouts.js')
@yield('page_js')
</body>

</html>
