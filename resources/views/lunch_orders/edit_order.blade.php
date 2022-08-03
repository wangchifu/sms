@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lunch_orders.index') }}">午餐系統-餐期管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-修改餐期</li>
        </ol>
    </nav>
@endsection

@section('content')

<?php
$active['teacher'] ="";
$active['student'] ="";
$active['list'] ="";
$active['special'] ="";
$active['order'] ="active";
$active['setup'] ="";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('lunches.nav')
        <div class="card">
            <h3 class="card-header">
                修改 {{ $lunch_order->name }} 餐期
            </h3>
            <div class="card-body">
                <form action="{{ route('lunch_orders.order_save',$lunch_order->id) }}" method="post" id="update_order" onsubmit="return false">
                    @csrf
                    @method('patch')
                <div class="form-group">
                    <label>收據抬頭*</label>
                    <input type="text" name="rece_name" value="{{ $lunch_order->rece_name }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>收據日期*</label>
                    {{ Form::date('rece_date',$lunch_order->rece_date,['id'=>'rece_date','class' => 'form-control','required'=>'required','maxlength'=>'10','width'=>'276']) }}
                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                    <script>
                        $('#rece_date').datepicker({
                            uiLibrary: 'bootstrap4',
                            format: 'yyyy-mm-dd',
                            locale: 'zh-TW',
                        });
                    </script>
                </div>
                <div class="form-group">
                    <label>收據字號*</label>
                    <input type="text" name="rece_no" value="{{ $lunch_order->rece_no }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>收據啟始號*</label>
                    <input type="text" name="rece_num" value="{{ $lunch_order->rece_num }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>備註</label>
                    <input type="text" name="order_ps" value="{{ $lunch_order->order_ps }}" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" onclick="sw_confirm2('確定？','update_order')"><i class="fas fa-save"></i> 儲存</button>
                    <a href="#" class="btn btn-secondary" onclick="history.go(-1);"><i class="fas fa-backward"></i> 返回</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var validator = $("#this_form").validate();
</script>

@endsection
