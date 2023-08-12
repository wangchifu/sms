@extends('layouts.master_clean')

@section('page_title','社團報名系統')

@section('content')
@include('clubs.parents_nav')
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card">
            <div class="card-body">
                <br>
                <br>      
                <ul class="nav">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#" onclick="alert('hi')">你是 {{ $user->student_year }}年{{ $user->student_class }}班{{ $user->num }}號 {{ $user->name }}</a>
                    </li>                    
                    <li class="nav-item">
                      <a class="nav-link btn btn-warning btn-sm" href="{{ route('clubs.change_pwd',$class_id) }}">更換密碼</a>
                    </li>
                    <li><a class="nav-item">　</a></li>
                    <li class="nav-item">
                      <a class="nav-link btn btn-danger btn-sm" href="{{ route('clubs.parents_logout') }}" onclick="return confirm('確定登出？')">登出</a>
                    </li>
                </ul>          
                <h1>社團資訊</h1>                    
                <div class="card">
                    <div class="card-body">
                        <h4>{{ $club->semester }}社團資訊</h4>
                        <div class="form-group">
                            <a class="btn btn-secondary btn-sm" href="{{ route('clubs.parents_do',$club->class_id) }}"><i class="fas fa-backward"></i> 返回</a>
                        </div>
                        <div class="form-group">
                            <label for="no"><strong>社團編號*</strong></label><br>
                            {{ $club->no }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="name"><strong>社團名稱*</strong></label><br>
                            {{ $club->name }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="contact_person">聯絡人</label><br>
                            {{ $club->contact_person }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="telephone_num">聯絡電話</label><br>
                            {{ $club->telephone_num }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="money"><strong>收費標準*</strong></label><br>
                            {{ $club->money }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="teacher_info">師資</label><br>
                            {{ $club->teacher_info }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="start_date">開課日期</label><br>
                            {{ $club->start_date }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="start_time"><strong>上課時間*</strong></label><br>
                            {{ $club->start_time }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="place">首次上課集合地點</label><br>
                            {{ $club->place }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="people"><strong>開課人數(最少)*</strong></label><br>
                            {{ $club->people }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="taking"><strong>正取人數(最多)*</strong></label><br>
                            {{ $club->taking }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="prepare"><strong>候補人數*</strong></label><br>
                            {{ $club->prepare }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="year_limit"><strong>年級限制*</strong></label><br>
                            {{ $club->year_limit }}<hr>
                        </div>
                        <div class="form-group">
                            <label for="ps">備註</label><br>
                            {{ $club->ps }}
                        </div>
                        <div class="form-group">
                            <a class="btn btn-secondary btn-sm" href="{{ route('clubs.parents_do',$club->class_id) }}"><i class="fas fa-backward"></i> 返回</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
