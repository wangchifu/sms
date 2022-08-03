@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-特殊處理</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['teacher'] ="";
$active['student'] ="";
$active['list'] ="";
$active['special'] ="active";
$active['order'] ="";
$active['setup'] ="";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('lunches.nav')
        <br>
        <h2>特殊處理</h2>
        @if($admin)
            <p class="text-danger">特殊處理功能強大，請務必謹慎操作！</p>
            <a href="{{ route('lunch_specials.late_teacher') }}" class="btn btn-primary">逾期教師補訂餐</a>
            <a href="{{ route('lunch_specials.teacher_change_month') }}" class="btn btn-primary">修改教師餐期</a>
            <a href="{{ route('lunch_specials.one_day') }}" class="btn btn-primary">單日供餐統一變更</a>
            <!--
            <a href="{{ route('lunch_specials.teacher_change') }}" class="btn btn-info">單日教師退訂餐</a>
            -->
            <a href="{{ route('lunch_specials.bad_factory') }}" class="btn btn-primary">違約廠商處理</a>
            <a href="{{ route('lunch_specials.add7') }}" class="btn btn-primary">增加七月餐期</a>
        @else
            <h1 class="text-danger">你不是管理者</h1>
        @endif
    </div>
</div>
@endsection
