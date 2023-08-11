@extends('layouts.master')

@section('page_title','社團報名系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">社團報名系統-學期列表</li>
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
        <h2>學期列表</h2>
        <a href="{{ route('clubs.semester_create') }}" class="btn btn-success btn-sm">新增學期</a>
        <table class="table table-striped">
            <tr>
                <th>
                    學期
                </th>
                <th>
                    特色社團開始
                </th>
                <th>
                    特色社團結束
                </th>
                <th>
                    課後活動開始
                </th>
                <th>
                    課後活動結束
                </th>
                <th>
                    最多可報
                </th>
                <th>
                    動作
                </th>
            </tr>
            @foreach($club_semesters as $club_semester)
            <tr>
                <td>
                    {{ $club_semester->semester }}
                </td>
                <td>
                    {{ $club_semester->start_date }}
                </td>
                <td>
                    {{ $club_semester->stop_date }}
                </td>
                <td>
                    {{ $club_semester->start_date2 }}
                </td>
                <td>
                    {{ $club_semester->stop_date2 }}
                </td>
                <td>
                    {{ $club_semester->club_limit }}
                </td>
                <td>
                    @if(check_admin('student_admin'))
                    <a href="{{ route('users.stu_index') }}" class="btn btn-warning btn-sm">學生管理</a>
                    @else
                    <small>無學生管理權</small>
                    @endif
                    <a href="{{ route('clubs.semester_edit',$club_semester->id) }}" class="btn btn-primary btn-sm">編輯</a>
                    <a href="{{ route('clubs.semester_delete',$club_semester->semester) }}" class="btn btn-danger btn-sm" onclick="return confirm('底下所有的資料都會清除喔！')">刪除</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection
