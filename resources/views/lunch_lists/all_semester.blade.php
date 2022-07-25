@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lunch_lists.index') }}">午餐系統-報表輸出</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-報表輸出-全學期記錄</li>
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
        @if($admin)
            <form action="{{ route('lunch_lists.semester_print') }}" method="post"  target="_blank">
                @csrf
                <div class="form-group">
                    {{ Form::select('lunch_setup_id', $lunch_setup_array,null, ['class' => 'form-control','required'=>'required','placeholder'=>'--請選擇--']) }}
                </div>
                <div class="form-group">
                    <a href="{{ route('lunch_lists.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
                    <input name="submit" type="submit" class="btn btn-dark btn-sm" value="印出教師全學期收費通知">
                    <input name="submit" type="submit" class="btn btn-dark btn-sm" value="印出教師全學期收據">
                    <input name="submit" type="submit" class="btn btn-dark btn-sm" value="印出廠商全學期收入">
                </div>
            </form>
        @else
            <h1 class="text-danger">你不是管理者</h1>
        @endif
    </div>
</div>
@endsection
