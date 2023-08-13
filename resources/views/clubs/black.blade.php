@extends('layouts.master')

@section('page_title','社團報名系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('clubs.index') }}">學期列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">黑名單</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['semester'] ="active";
$active['setup'] ="";
$active['list'] ="";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('clubs.nav')
        <br>
        <h2>黑名單</h2>
        <div class="card">
            <div class="card-header">
                <h5>
                    學生黑名單列表
                </h5>
            </div>
            <div class="card-body">
                {{ Form::open(['route' => 'clubs.store_black', 'method' => 'POST']) }}
                <table>
                    <tr>
                        <td>
                            被處罰無法選社團的學期
                        </td>
                        <td>
                            社團類別
                        </td>
                        <td>
                            學號
                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ Form::text('semester',null,['id'=>'semester','class' => 'form-control', 'maxlength'=>'4','required'=>'required']) }}
                        </td>
                        <td>
                            <select class="form-control" name="class_id" required>
                                <option></option>
                                <option value="1">
                                    1.學生特色社團
                                </option>
                                <option value="2">
                                    2.學生課後活動
                                </option>
                            </select>
                        </td>
                        <td>
                            {{ Form::text('student_sn',null,['id'=>'student_sn','class' => 'form-control','maxlength'=>'6','required'=>'required']) }}
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('確定送出嗎？')">
                                <i class="fas fa-save"></i> 新增送出
                            </button>
                        </td>
                    </tr>
                </table>                
                {{ Form::close() }}
                @include('layouts.errors')
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                被處罰的學期
                            </th>
                            <th>
                                類別
                            </th>
                            <th>
                                學生
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($club_blacks as $club_black)
                            <tr>
                                <td>
                                    {{ $club_black->semester }}
                                </td>
                                <td>
                                    @if($club_black->class_id==1)
                                        1.學生特色社團
                                    @endif
                                    @if($club_black->class_id==2)
                                        2.學生課後活動
                                    @endif
                                </td>
                                <td>
                                    學號 {{ $club_black->student->student_sn }} {{ $club_black->student->student_year }}年{{ $club_black->student->student_class }}班{{ $club_black->student->num }}號 {{ $club_black->student->name }}
                                    <a href="{{ route('clubs.destroy_black',$club_black->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定嗎？')">刪除</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
