@extends('layouts.master')

@section('page_title','運動會報名系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sports.setup') }}">設定</a></li>
            <li class="breadcrumb-item active" aria-current="page">運動會報名系統-修改任務</li>
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
        <h2>設定-修改任務</h2>
        @if(check_admin('sport_admin'))
        <form action="{{ route('sports.setup.action_update',$action->id) }}" method="post">
            @method('patch')
            @csrf
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="semester">學期<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="semester" name="semester" value="{{ $action->semester }}" placeholder="4碼" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="name">名稱<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $action->name }}" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="started_at">開始報<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="started_at" name="started_at" value="{{ $action->started_at }}" placeholder="11碼" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="stopped_at">最後一天<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="stopped_at" name="stopped_at" value="{{ $action->stopped_at }}" placeholder="11碼" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <?php
                    $s1 = ($action->numbers==4)?"selected":null;
                    $s2 = ($action->numbers==5)?"selected":null;
                    ?>
                    <label for="numbers">號碼布幾位數<span class="text-danger">*</span></label>
                    <select id="numbers" class="form-control" name="numbers">
                        <option value="4" {{ $s1 }}>4</option>
                        <option value="5" {{ $s2 }}>5</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="track">每人可報名徑賽最多幾項<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="track" name="track" value="{{ $action->track }}" maxlength="1" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="field">每人可報名田賽最多幾項<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="field" name="field" value="{{ $action->field }}" maxlength="1" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="frequency">每人報名項目合計最多幾項<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="frequency" name="frequency" value="{{ $action->frequency }}" maxlength="1" required>
                </div>
            </div>            
            <button type="submit" class="btn btn-primary" onclick="return confirm('確定？')">儲存</button>
        </form>                       
        @else
        <span>你不是管理者</span>
        @endif
    </div>
</div>

@endsection
