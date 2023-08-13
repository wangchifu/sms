@extends('layouts.master')

@section('page_title','社團報名系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('clubs.index') }}">社團報名系統</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增學期</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['semester'] ="active";
$active['setup'] ="";
$active['list'] ="";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('clubs.nav')
        <br>
        <h2>新增學期</h2>
        {{ Form::open(['route' => 'clubs.semester_store', 'method' => 'POST']) }}
        <div class="form-group">
            <label for="semester"><strong>學期*</strong><small class="text-primary">(如 1091)</small></label>
            {{ Form::number('semester',null,['id'=>'semester','class' => 'form-control', 'maxlength'=>'4','placeholder'=>'4碼數字','required'=>'required']) }}
        </div>
        <div class="form-group">
            <label for="start_date"><strong>「學生特色社團」開始報名時間*</strong><small class="text-primary">(如 2020年09月20日06時30分)</small></label>
            <br>
            <input type="text" name="year_1" size="5" required maxlength="4" placeholder="4碼">年
            <input type="text" name="month_1" size="3" required maxlength="2" placeholder="2碼">月
            <input type="text" name="day_1" size="3" required maxlength="2" placeholder="2碼">日
            <input type="text" name="hour_1" size="3" required maxlength="2" placeholder="2碼">時
            <input type="text" name="min_1" size="3" required maxlength="2" placeholder="2碼">分
        </div>
        <div class="form-group">
            <label for="stop_date"><strong>「學生特色社團」結束報名時間(含)*</strong><small class="text-primary">(如 2020年09月30日06時30分)</small></label>
            <br>
            <input type="text" name="year_2" size="5" required maxlength="4" placeholder="4碼">年
            <input type="text" name="month_2" size="3" required maxlength="2" placeholder="2碼">月
            <input type="text" name="day_2" size="3" required maxlength="2" placeholder="2碼">日
            <input type="text" name="hour_2" size="3" required maxlength="2" placeholder="2碼">時
            <input type="text" name="min_2" size="3" required maxlength="2" placeholder="2碼">分
        </div>
        <hr>        
        <div class="form-group">
            <p class="text-danger">如果不需使用下方第二類社團，請在下方打勾，自動填入已過去的時間。</p>   
            <input id="cancel2" type="checkbox"><label for="cancel2">不使用第二類社團報名</label>
        </div>        
        <div class="form-group">
            <label for="start_date"><strong>「學生課後活動」開始報名時間*</strong><small class="text-primary">(如 2020年09月20日06時30分)</small></label>
            <br>
            <input id="year2_1" type="text" name="year2_1" size="5" required maxlength="4" placeholder="4碼">年
            <input id="month2_1" type="text" name="month2_1" size="3" required maxlength="2" placeholder="2碼">月
            <input id="day2_1" type="text" name="day2_1" size="3" required maxlength="2" placeholder="2碼">日
            <input id="hour2_1" type="text" name="hour2_1" size="3" required maxlength="2" placeholder="2碼">時
            <input id="min2_1" type="text" name="min2_1" size="3" required maxlength="2" placeholder="2碼">分
        </div>
        <div class="form-group">
            <label for="stop_date"><strong>「學生課後活動」結束報名時間(含)*</strong><small class="text-primary">(如 2020年09月30日06時30分)</small></label>
            <br>
            <input id="year2_2" type="text" name="year2_2" size="5" required maxlength="4" placeholder="4碼">年
            <input id="month2_2" type="text" name="month2_2" size="3" required maxlength="2" placeholder="2碼">月
            <input id="day2_2" type="text" name="day2_2" size="3" required maxlength="2" placeholder="2碼">日
            <input id="hour2_2" type="text" name="hour2_2" size="3" required maxlength="2" placeholder="2碼">時
            <input id="min2_2" type="text" name="min2_2" size="3" required maxlength="2" placeholder="2碼">分
        </div>
        <div class="form-group">
            <label for="club_limit"><strong>學生各項最多可報名幾個社團*</strong></label>
            {{ Form::number('club_limit',null,['id'=>'club_limit','class' => 'form-control', 'maxlength'=>'2','placeholder'=>'數字','required'=>'required']) }}
        </div>
        <div class="form-group">
            <a class="btn btn-secondary btn-sm" href="{{ route('clubs.index') }}"><i class="fas fa-backward"></i> 返回</a>
            <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('確定儲存嗎？')">
                <i class="fas fa-save"></i> 儲存
            </button>
        </div>
        @include('layouts.errors')
        {{ Form::close() }}
    </div>
</div>
<script>
    $("#cancel2").click(function() {
   if($("#cancel2").prop("checked")) {
     $("#year2_1").val("1978");
     $("#month2_1").val("10");
     $("#day2_1").val("26");
     $("#hour2_1").val("00");
     $("#min2_1").val("00");
     $("#year2_2").val("1978");
     $("#month2_2").val("10");
     $("#day2_2").val("26");
     $("#hour2_2").val("00");
     $("#min2_2").val("00");
     
   } else {
    $("#year2_1").val("");
     $("#month2_1").val("");
     $("#day2_1").val("");
     $("#hour2_1").val("");
     $("#min2_1").val("");
     $("#year2_2").val("");
     $("#month2_2").val("");
     $("#day2_2").val("");
     $("#hour2_2").val("");
     $("#min2_2").val("");
   }
});
</script>
@endsection