@extends('layouts.master')

@section('page_title','社團報名系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('clubs.report') }}">報表輸出</a></li>
            <li class="breadcrumb-item active" aria-current="page">取消報名狀況</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['semester'] ="";
$active['setup'] ="";
$active['list'] ="active";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('clubs.nav')
        <br>
        <h2>社團取消報名狀況</h2>
        @if($semester != null)
        <form name=myform>
            <div class="form-group">
                {{ Form::select('semester', $club_semesters_array,$semester, ['id'=>'semester','class' => 'form-control','placeholder'=>'--請選擇學期--','onchange'=>'jump()']) }}
            </div>
        </form>
        <a href="{{ route('clubs.report') }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>
                            時間
                        </th>
                        <th>
                            事件
                        </th>
                        <th>
                            IP
                        </th>
                    </tr>
                    @foreach($not_registers as $not_register)
                        <tr>
                            <td>
                                {{ $not_register->created_at }}
                            </td>
                            <td>
                                {{ $not_register->event }}
                            </td>
                            <td>
                                {{ $not_register->ip }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @endif
        
    </div>
</div>

@endsection
