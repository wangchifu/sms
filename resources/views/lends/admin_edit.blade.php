@extends('layouts.master')

@section('page_title','借用系統-管理者')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">借用系統</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['index'] ="";
$active['my_list'] ="";
$active['admin'] ="active";
$active['list'] ="";

?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('lends.nav')
        <br>
        <h2>管理者</h2>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    
                </div>
                <div class="col-12 col-md-4">
                    <h4 class="text-danger">修改借用品的項目</h4>
                    <form method="post" action="{{ route('lends.update_item',$lend_item->id) }}" id="lend_item_form" onsubmit="return false">
                        @csrf
                        <label class="form-label">1.借用品類別</label>
                        <select class="form-select" aria-label="Default select example" required name="lend_class_id">
                            @foreach($lend_class_array as $k=>$v)
                                <?php 
                                    $selected = ($lend_item->lend_class_id == $k)?"selected":null;
                                ?>
                                <option value="{{ $k }}" {{ $selected }}>-- {{ $v }}</option>
                            @endforeach
                        </select>
                        <br>
                        <div class="mb-3">
                            <label for="lend_name" class="form-label">2.名稱</label>
                            <input type="text" class="form-control" id="lend_name" required name="name" value="{{ $lend_item->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="lend_num" class="form-label">3.數量</label>
                            <input type="number" class="form-control" id="lend_num" required name="num" value="{{ $lend_item->num }}">
                        </div>
                        <div class="mb-3">
                            <?php
                                $checked = ($lend_item->enable==1)?"checked":null;
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" {{ $checked }} name="enable">
                                <label class="form-check-label" for="flexCheckChecked">
                                  4.打勾啟用
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="lend_ps" class="form-label">5.備註及注意事項</label>
                            <div class="form-floating">
                                <textarea class="form-control" id="lend_ps" style="height: 100px" name="ps">{{ $lend_item->ps }}</textarea>
                                <label for="lend_ps">注意事項</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <?php
                                $checked = [];
                                foreach (unserialize($lend_item->lend_sections) as $k => $v) {
                                    $checked[$v] = "checked";   
                                }
                            ?>
                            <label class="form-label">6.可供借還的節數</label>
                            @foreach(config('sms.lend_sections') as $k=>$v)
                                <?php if(!isset($checked[$k])) $checked[$k]=null; ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $k }}" id="flexCheckChecked{{ $k }}" {{ $checked[$k] }} name="lend_sections[]">
                                    <label class="form-check-label" for="flexCheckChecked{{ $k }}">
                                        {{ $v }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('lends.admin',$lend_item->lend_class_id) }}" class="btn btn-secondary btn-sm">返回</a>
                        <button class="btn btn-danger btn-sm" onclick="return sw_confirm2('確定更新嗎？','lend_item_form')">更新項目</button>
                    </form>
                    @include('layouts.errors')
                </div>
                <div class="col-12 col-md-4">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<script>
    $('#change_lend_class').on( "change", function() {
        location="{{ $_SERVER['HTTP_HOST'] }}/lends/admin/" + $('#change_lend_class').val();
        });
</script>
@endsection
