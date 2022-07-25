@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lunch_setups.index') }}">午餐系統-午餐設定</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-新增學期設定</li>
        </ol>
    </nav>
@endsection

@section('content')
    <?php
    $active['teacher'] ="";
    $active['list'] ="";
    $active['special'] ="";
    $active['order'] ="";
    $active['setup'] ="active";
    ?>
    <div class="row justify-content-center">
        <div class="col-md-11">
            @include('lunches.nav')
            @include('layouts.errors')
            {{ Form::open(['route' => 'lunch_setups.store', 'method' => 'POST','id'=>'setup','files'=>true,'id'=>'this_form','onsubmit'=>'return false']) }}
            <div class="card my-4">
                <div class="h3 card-header">
                    新增學期設定
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="semester"><strong>學期*</strong><small class="text-primary">(如 1062)</small></label>
                        {{ Form::text('semester',null,['id'=>'semester','class' => 'form-control', 'maxlength'=>'4','placeholder'=>'4碼數字','required'=>'required']) }}
                    </div>
                    <div class="form-group">
                        <label for="eat_styles"><strong>供餐別*</strong></label>
                        <ul>
                            <li>
                                <input type="checkbox" name="eat_styles[]" value="1" id="eat_style1" checked> <label for="eat_style1"><span class="text-danger">葷食</span>合菜</label>
                            </li>
                            <li>
                                <input type="checkbox" name="eat_styles[]" value="2" id="eat_style2"> <label for="eat_style2"><span class="text-success">素食</span>合菜</label>
                            </li>
                            <li>
                                <input type="checkbox" name="eat_styles[]" value="3" id="eat_style3"> <label for="eat_style3"><span class="text-danger">葷食</span>便當</label>
                            </li>
                            <li>
                                <input type="checkbox" name="eat_styles[]" value="4" id="eat_style4" checked> <label for="eat_style4"><span class="text-success">素食</span>便當</label>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="die_line"><strong>允許最慢幾天前訂退餐*</strong></label>
                        {{ Form::text('die_line',null,['id'=>'die_line','class' => 'form-control', 'maxlength'=>'1','required'=>'required']) }}
                    </div>
                    <div class="form-group">
                        <label for="tea_open">隨時可訂餐<small class="text-primary">(僅供暫時開放，切記關閉它)</small></label>
                        <div class="form-check">
                            {{ Form::checkbox('teacher_open',null,null,['id'=>'tea_open','class'=>'form-check-input']) }}
                            <label class="form-check-label" for="tea_open"><span class="btn btn-danger btn-sm">打勾為隨時可訂</span></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="disable">停止退餐<small class="text-primary">(僅供學期末計費時使用)</small></label>
                        <div class="form-check">
                            {{ Form::checkbox('disable',null,null,['id'=>'disable','class'=>'form-check-input']) }}
                            <label class="form-check-label" for="disable"><span class="btn btn-danger btn-sm">打勾為全面停止退餐</span></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="all_rece_name"><strong>全學期收據抬頭名稱*</strong><small class="text-primary">(如 彰化縣xx鎮xx國民小學)</small></label>
                        {{ Form::text('all_rece_name',null,['id'=>'all_rece_name','class' => 'form-control','required'=>'required']) }}
                    </div>
                    <div class="form-group">
                        <label for="all_rece_date"><strong>全學期收據開立日期*</strong><small class="text-primary">(如 2019/06/30)</small></label>
                        <input id="all_rece_date" class="form-control" name="all_rece_date" required maxlength="10" value="{{ old('all_rece_date') }}" type="date">
                    </div>
                    <div class="form-group">
                        <label for="all_rece_name"><strong>全學期收據字號*</strong><small class="text-primary">(如 彰和東午字)</small></label>
                        {{ Form::text('all_rece_no',null,['id'=>'all_rece_no','class' => 'form-control','required'=>'required']) }}
                    </div>
                    <div class="form-group">
                        <label for="all_rece_num"><strong>全學期收據起始號*</strong></label>
                        {{ Form::text('all_rece_num',null,['id'=>'all_rece_num','class' => 'form-control','required'=>'required']) }}
                    </div>
                    <div class="form-group">
                        <label for="teacher_money"><strong>每餐價格*</strong></label>
                        <input type="text" class="form-control" name="teacher_money" id="teacher_money" required>
                    </div>
                    <div class="form-group">
                        <label for="all_rece_num">經手人印章圖檔</label>
                        {{ Form::file('file1', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label for="all_rece_num">主辦出納印章圖檔</label>
                        {{ Form::file('file2', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label for="all_rece_num">主辦會計印章圖檔</label>
                        {{ Form::file('file3', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label for="all_rece_num">機關長官印章圖檔</label>
                        {{ Form::file('file4', ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" onclick="return sw_confirm2('確定儲存嗎？','this_form')">
                            <i class="fas fa-save"></i> 儲存設定
                        </button>
                        <a href="#" class="btn btn-secondary" onclick="history.go(-1);"><i class="fas fa-backward"></i> 返回</a>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <script>
        var validator = $("#this_form").validate();
    </script>
@endsection
