@extends('layouts.master_clean')

@section('page_title','社團報名系統')

@section('content')
@include('clubs.parents_nav')
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card">
            <div class="card-body">
                <br>
                <br>      
                <ul class="nav">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#" onclick="alert('hi')">你是 {{ $user->student_year }}年{{ $user->student_class }}班{{ $user->num }}號 {{ $user->name }}</a>
                    </li>                    
                    <li class="nav-item">
                      <a class="nav-link btn btn-warning btn-sm" href="{{ route('clubs.change_pwd',$class_id) }}">更換密碼</a>
                    </li>
                    <li><a class="nav-item">　</a></li>
                    <li class="nav-item">
                      <a class="nav-link btn btn-danger btn-sm" href="{{ route('clubs.parents_logout') }}" onclick="return confirm('確定登出？')">登出</a>
                    </li>
                </ul>          
                <h1>社團報名-更改密碼</h1>                    
                <div class="card">
                    <div class="card-header">
                        密碼
                    </div>
                    <div class="card-body">
                        <form action="{{ route('clubs.change_pwd_do') }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="exampleInputPassword0">舊密碼*</label>
                                <input type="password" class="form-control" name="password0" id="exampleInputPassword0" required tabindex="1" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">新密碼*</label>
                                <input type="password" class="form-control" name="password1" id="exampleInputPassword1" required tabindex="2">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword2">確認新密碼*</label>
                                <input type="password" class="form-control" name="password2" id="exampleInputPassword2" required tabindex="3">
                            </div>
                            <a href="{{ route('clubs.parents_do',$class_id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
                            <input type="hidden" name="class_id" value="{{ $class_id }}">
                            <button type="submit" class="btn btn-primary btn-sm" tabindex="5" onclick="return confirm('確定？')"><i class="fas fa-save"></i> 送出</button>
                        </form>
                        @include('layouts.errors')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
