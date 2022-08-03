@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-學生午餐</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['teacher'] ="";
$active['student'] ="active";
$active['list'] ="";
$active['special'] ="";
$active['order'] ="";
$active['setup'] ="";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('lunches.nav')
        <br>
        <h2>學生訂餐</h2>
        @if($admin)
        <a href="{{ route('users.stu_index') }}" class="btn btn-primary btn-sm">學生帳號管理</a>
        <form name=myform>
            <div class="form-control">
                {{ Form::select('lunch_order_id', $lunch_order_array,$lunch_order_id, ['class' => 'form-control','placeholder'=>'--請選擇--','onchange'=>'jump()']) }}
            </div>
        </form>
        <span>*填第一日，即可自動複製至各日。</span>
        <div class="overflow-auto">
            <style>
                table, th, td {
                                border: 1px solid black;
                                border-collapse: collapse;
                }
            </style>
        <table>
            <thead>
                <tr>
                    <td>
                        班級
                    </td>
                    @foreach($lunch_order_dates as $lunch_order_date)
                    <td colspan="2">
                        {{ substr($lunch_order_date->order_date,-2) }}<br>
                        @if( get_chinese_weekday2($lunch_order_date->order_date) == "六")
                        <span class="text-success fw-bolder">{{ get_chinese_weekday2($lunch_order_date->order_date) }}</span>
                        @elseif( get_chinese_weekday2($lunch_order_date->order_date) == "日")
                        <span class="text-danger fw-bolder">{{ get_chinese_weekday2($lunch_order_date->order_date) }}</span>
                        @else
                        <span class="text-primary fw-bolder">{{ get_chinese_weekday2($lunch_order_date->order_date) }}</span>
                        @endif
                    </td>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($student_classes as $student_class)
                <tr onmouseover="this.style.backgroundColor='#FFCDE5';" onMouseOut="this.style.backgroundColor='#FFFFFF';">
                    <td>
                        {{ $student_class->student_year }}{{ sprintf("%02s",$student_class->student_class) }}
                    </td>
                    @foreach($lunch_order_dates as $lunch_order_date)
                    <td>
                        <input type="text" style="width:40px" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $student_class->student_year }}{{ sprintf("%02s",$student_class->student_class) }} {{ substr($lunch_order_date->order_date,5,5) }} 葷">
                    </td>
                    <td>
                        <input type="text" style="width:25px" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $student_class->student_year }}{{ sprintf("%02s",$student_class->student_class) }} {{ substr($lunch_order_date->order_date,5,5) }} 素">
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        @else
            <h1 class="text-danger">你不是管理者</h1>
        @endif
    </div>
</div>
<script>

    function jump(){
        if(document.myform.lunch_order_id.options[document.myform.lunch_order_id.selectedIndex].value!=''){
            location="/lunch_stus/index/" + document.myform.lunch_order_id.options[document.myform.lunch_order_id.selectedIndex].value;
        }
    }
</script>
@endsection
