@extends('layouts.master')

@section('page_title','API 設定教學')

@section('page_subtitle')
    <a href="#" class="btn btn-secondary btn-sm" onclick="history.back();"><i class="fas fa-backward"></i> 返回</a>
@endsection

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">帳號管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">API 設定教學</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                設定參考：<a href="https://cloudschool.chc.edu.tw" target="_blank">cloudschool</a> > 系統管理  > 模組管理  >  API及憑證設定  >  +新增學校伺服器API
                <br>
                名稱：自取<br>
                類型：學校伺服器<br>
                限用伺服器IP：163.23.200.3<br>
                <a href="{{ asset('images/cloudschool/api.png') }}" target="_blank"><img src="{{ asset('images/cloudschool/api.png') }}"></a>
            </div>
        </div>
    </div>
@endsection
