<!DOCTYPE html>
<html lang="zh-TW">
    <?php $school_code = school_code();$schools = config('app.schools')  ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $schools[$school_code] }}校務管理系統</title>
    @include('layouts.js_up')
    @include('layouts.css')
    @yield('page_css')
</head>

<body>
<div style="padding:20px;">
@yield('content')
</div>
@include('layouts.js')
@yield('page_js')
</body>

</html>
