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
<div id="app">
    @include('layouts.sidebar')

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>@yield('page_title')</h3>
                        <p class="text-subtitle text-muted">@yield('page_subtitle')</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        @yield('page_nav')
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@yield('card_title')</h4>
                        </div>
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @yield('main')

        @include('layouts.footer')
    </div>
</div>
@include('layouts.js')
@yield('page_js')
</body>

</html>
