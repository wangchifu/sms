@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-報表輸出</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['teacher'] ="";
$active['list'] ="active";
$active['special'] ="";
$active['order'] ="";
$active['setup'] ="";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('lunches.nav')
        <br>
        <h2>報表輸出</h2>
        @if($admin)
            <a href="{{ route('lunch_lists.every_day') }}" class="btn btn-primary">分期記錄</a>
            <a href="{{ route('lunch_lists.all_semester') }}" class="btn btn-primary">全學期記錄</a>
            <a href="{{ route('lunch_lists.factory') }}" class="btn btn-primary" target="_blank">廠商入口</a>
        @else
            <h1 class="text-danger">你不是管理者</h1>
        @endif
    </div>
</div>
@endsection
