@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('index') }}">午餐系統-特殊處理</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-特殊處理-增加七月餐期</li>
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
        <br>
        <h3>因應疫情，有時七月還在上課，要加開七月的餐期！</h3>
        @if(!$semester)
            <form method="get">
            <div class="form-group">
                <label for="semester"><strong>要增加7月訂餐的學期*</strong><small class="text-primary">(如 1082)</small></label>
                {{ Form::text('semester',null,['id'=>'semester','class' => 'form-control', 'maxlength'=>'4','placeholder'=>'4碼數字','required'=>'required']) }}
                <br>
                <button class="btn btn-primary">送出</button>
                <a href="{{ route('lunch_specials.index') }}" class="btn btn-secondary"><i class="fas fa-backward"></i> 返回</a>
            </form>
            </div>
        @else
            @if($has7)
                <span class="text-danger">本學期已有7月餐期</span>
            @else
            {{ Form::open(['route' => 'lunch_specials.store7', 'method' => 'POST','id'=>'store','onsubmit'=>'return false']) }}
            <table class="table table-striped table-hover">
            <tbody>
            @foreach($semester_dates as $k=>$v)
                <?php
                $this_date_w = get_chinese_weekday($v);
                ?>
                <tr>
                @if($this_date_w=="星期六")
                    <?php
                    $checked = "";
                    ?>
                    <td>{{ $v }}-<label class="text-success" for=id"{{ $v }}">{{ $this_date_w }}</label>
                @elseif($this_date_w=="星期日")
                    <?php
                    $checked = "";
                    ?>
                    <td>{{ $v }}-<label class="text-danger" for=id"{{ $v }}">{{ $this_date_w }}</label>

                @else
                    <?php
                    $checked = "checked";
                    ?>
                    <td>{{ $v }}-<label for=id"{{ $v }}">{{ $this_date_w }}</label>
                @endif
                <input type="checkbox" name="order_date[{{ $v }}]" {{ $checked }} id=id"{{ $v }}"></td>
                <td><input type="text" placeholder="備註" name="ps[{{ $v }}]" class="form-control"></td>
                </tr>
            @endforeach
            </tbody>
            </table>
            <input type="hidden" name="name" value="{{ $this_year }}-07">
            <input type="hidden" name="semester" value="{{ $semester }}">
            <button class="btn btn-success" onclick="sw_confirm2('確定？','store')">送出</button>
            <a href="{{ route('lunch_specials.index') }}" class="btn btn-secondary"><i class="fas fa-backward"></i> 返回</a>
            {{ Form::close() }}
            @endif
        @endif
    </div>
</div>
@endsection
