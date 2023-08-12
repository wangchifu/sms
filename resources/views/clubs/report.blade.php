@extends('layouts.master')

@section('page_title','社團報名系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">社團報名系統-報表輸出</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['semester'] ="";
$active['setup'] ="";
$active['list'] ="active";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('clubs.nav')
        <br>
        <h2>報表輸出</h2>
        <a href="{{ route('clubs.report_situation') }}" class="btn btn-info btn-sm">報名狀況</a>
        <a href="{{ route('clubs.report_not_situation') }}" class="btn btn-info btn-sm">取消報名狀況</a>
        <a href="{{ route('clubs.report_money') }}" class="btn btn-info btn-sm">收費報表</a>                    
        <a href="{{ route('clubs.semester_select') }}" class="btn btn-info btn-sm" target="_blank">學生入口 <i class="fas fa-forward"></i> </i></a>
    </div>
</div>

@endsection
