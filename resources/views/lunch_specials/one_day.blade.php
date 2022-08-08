@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lunch_specials.index') }}">午餐系統-特殊處理</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-特殊處理-單日供餐統一變更</li>
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
        @if($admin)
            <div class="card">
                <div class="h3 card-header">
                    某一天突然不供餐，或是又要供餐了！
                </div>
                <div class="card-body">
                    <ul class="text-danger">
                        <li>
                            注意！若該日變更為「供餐」後，所有人均仍未訂餐，老師及班級學生需要的記得補訂！(某日突然要供餐了)
                        </li>
                        <li>
                            若該日變更為「不供餐」後，所有人立即退訂！(颱風假或其他原因統一退餐)
                        </li>
                    </ul>
                    <form action="{{ route('lunch_specials.one_day_store') }}" method="post" id="this_form" onsubmit="return false">
                        @csrf
                    <label>1.欲變更的日期</label>
                    <div class="form-group">
                        {{ Form::date('order_date',null,['id'=>'order_date','class' => 'form-control','required'=>'required','maxlength'=>'10','width'=>'276']) }}
                    </div>
                    <div class="form-group">
                        <label>2.變更選項</label>
                        <select name="action" class="form-control" required>
                            <option value="">--請選擇--</option>
                            <option value="eat">供餐</option>
                            <option value="not_eat">不供餐</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" onclick="sw_confirm2('確定送出？','this_form')">送出變更</button>
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
