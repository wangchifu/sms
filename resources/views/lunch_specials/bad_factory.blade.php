@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lunch_specials.index') }}">午餐系統-特殊處理</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-特殊處理：違約廠商處理1</li>
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
                    某廠商違約了，有訂此廠商的分配至其他廠商！
                </div>
                <div class="card-body">
                    <form action="{{ route('lunch_specials.bad_factory2') }}" method="post" id="this_form" onsubmit="return false">
                        @csrf
                    一、步驟一：<br>
                    <div class="form-group">
                        <label>1.選擇違約廠商</label>
                        {{ Form::select('bad_factory_id',$factories,null,['class'=>'form-control','required'=>'required']) }}
                    </div>
                    <label>2.從哪日起？</label>
                    <div class="form-group">
                        {{ Form::date('order_date1',null,['id'=>'order_date1','class' => 'form-control','required'=>'required','maxlength'=>'10','width'=>'276']) }}
                    </div>
                    <label>3.到哪日止？</label>
                    <div class="form-group">
                        {{ Form::date('order_date2',null,['id'=>'order_date2','class' => 'form-control','required'=>'required','maxlength'=>'10','width'=>'276']) }}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" onclick="sw_confirm2('確定送出？','this_form')">送出至步驟二</button>
                        <a href="{{ route('lunch_specials.index') }}" class="btn btn-secondary"><i class="fas fa-backward"></i> 返回</a>
                        @include('layouts.errors')
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
