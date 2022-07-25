@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lunch_specials.index') }}">午餐系統-特殊處理</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-特殊處理-修改教師餐期</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['teacher'] ="";
$active['list'] ="";
$active['special'] ="active";
$active['order'] ="";
$active['setup'] ="";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('lunches.nav')
        @if($admin)
            <div class="card">
                <div class="h3 card-header">
                    教師某一餐期的一些資料錯了！！
                </div>
                <div class="card-body">
                    @include('layouts.errors')
                    <form action="{{ route('lunch_specials.teacher_change_month_show') }}" method="post" id="this_form">
                        @csrf
                    <div class="form-group">
                        <label>
                            選擇教職員
                        </label>
                        {{ Form::select('user_id', $user_array,null, ['class' => 'form-control','placeholder'=>'--請選擇--','required'=>'required']) }}
                    </div>
                    <div class="form-group">
                        <label>
                            選擇餐期
                        </label>
                        {{ Form::select('lunch_order_id', $lunch_order_array,null, ['class' => 'form-control','placeholder'=>'--請選擇--','required'=>'required']) }}
                    </div>
                        <div class="form-group">
                            <button class="btn btn-primary">送出</button>
                            <a href="{{ route('lunch_specials.index') }}" class="btn btn-secondary"><i class="fas fa-backward"></i> 返回</a>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <h1 class="text-danger">你不是管理者</h1>
        @endif
    </div>
</div>
<script>
    var validator = $("#this_form").validate();
</script>
@endsection
