@extends('layouts.master')

@section('page_title','運動會報名系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sports.setup') }}">設定</a></li>
            <li class="breadcrumb-item active" aria-current="page">運動會報名系統-新增任務</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['index'] ="";
$active['setup'] ="active";
$active['sign_up'] ="";
$active['list'] ="";
$active['score'] ="";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('sports.nav')
        <br>
        <h2>設定</h2>
        @if(check_admin('sport_admin'))
        <form action="{{ route('sports.setup.action_store') }}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="semester">學期<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="semester" name="semester" value="{{ get_date_semester(date('Y-m-d')) }}" placeholder="4碼" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="name">名稱<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ get_date_semester(date('Y-m-d')) }} 學期校慶運動會報名" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="started_at">開始報<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="started_at" name="started_at" value="{{ date('Y-m-d') }}" placeholder="11碼" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="stopped_at">最後一天<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="stopped_at" name="stopped_at" value="{{ date('Y-m-d') }}" placeholder="11碼" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="numbers">號碼布幾位數<span class="text-danger">*</span></label>
                    <select id="numbers" class="form-control" name="numbers">
                        <option value="4" selected>4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="track">每人可報名徑賽最多幾項<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="track" name="track" value="2" maxlength="1" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="field">每人可報名田賽最多幾項<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="field" name="field" value="2" maxlength="1" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="frequency">每人報名項目合計最多幾項<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="frequency" name="frequency" value="2" maxlength="1" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" onclick="return confirm('確定？')">新增</button>
        </form>                          
        @else
        <span>你不是管理者</span>
        @endif
    </div>
</div>

@endsection
