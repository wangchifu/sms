@extends('layouts.master_clean')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/pages/auth.css') }}">
@endsection

@section('content')
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('index') }}"><img src="{{ asset('images/logo/logo.png') }}" alt="Logo"></a>
                        <img src="{{ asset('images/logo/gsuite_logo.png') }}" alt="Logo">
                    </div>
                    <?php $school_code = school_code();$schools = config('app.schools')  ?>
                    <h1 class="auth-title">系統管理員登入 {{ $schools[$school_code] }}</h1>
                    <form id="login_form" action="{{ route('sys_auth') }}" method="post">
                        @csrf                   
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-lg" name="username" value="{{ old('username') }}" placeholder="帳號" required tabindex="1" autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-lg" name="password" placeholder="密碼" required tabindex="2">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <img src="{{ route('pic') }}" class="img-fluid" id="captcha_img">
                            <a href="#" onclick="change_img()"><i class="fas fa-recycle"></i> 重置</a>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-lg" name="chaptcha" placeholder="上圖數字" required maxlength="5" tabindex="3">
                            <div class="form-control-icon">
                                <i class="bi bi-image"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" tabindex="4">登入</button>
                        @include('layouts.errors')
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
    <script>
        function change_img(){
            var d = new Date();
            $('#captcha_img').attr('src',  'https://{{ $_SERVER['HTTP_HOST'] }}/pic?' + d.getTime());
        }
    </script>
@endsection
