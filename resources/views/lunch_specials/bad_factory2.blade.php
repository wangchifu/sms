@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lunch_specials.index') }}">午餐系統-特殊處理</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-特殊處理：違約廠商處理2</li>
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
                        <span class="text-danger">要將 <span class="h4">{{ $bad_factory }}</span> 從 <span class="h4">{{ $order_date1 }} 到 {{ $order_date2 }}</span> 之間的訂餐分配</span><br>
                        <form action="{{ route('lunch_specials.bad_factory3') }}" method="post" id="this_form" onsubmit="return false">
                            @csrf
                        二、步驟二：<br>
                        <div class="form-group">
                            <label>4.選擇分給哪家廠商</label>
                            {{ Form::select('good_factory_id',$factories,null,['class'=>'form-control','required'=>'required']) }}
                        </div>
                        <label>5.選擇教職員</label>
                        <div class="form-group">
                            {{ Form::select('teas[]',$teas,null,['id'=>'order_date','class' => 'form-control','required'=>'required', 'multiple'=>'multiple','size'=>'10']) }}
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" onclick="sw_confirm2('確定送出？','this_form')">送出儲存</button>
                            <a href="{{ route('lunch_specials.index') }}" class="btn btn-secondary"><i class="fas fa-backward"></i> 返回</a>

                            @include('layouts.errors')
                        </div>
                            <input type="hidden" name="bad_factory_id" value="{{ $bad_factory_id }}">
                            <input type="hidden" name="order_date1" value="{{ $order_date1 }}">
                            <input type="hidden" name="order_date2" value="{{ $order_date2 }}">
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
