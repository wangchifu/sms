@extends('layouts.master')

@section('page_title','運動會報名系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">運動會報名系統-設定</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['index'] ="";
$active['setup'] ="active";
$active['sign_up'] ="";
$active['list'] ="";
$active['score'] ="";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('sports.nav')
        <br>
        <h2>設定</h2>
        @if(check_admin('sport_admin'))
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">報名任務</button>
              <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">教職員工</button>
              <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <br>
                <a class="btn btn-success" href="{{ route('sports.setup.action_create') }}">新增報名任務</a>
                @include('layouts.errors')
                <table class="table table-striped">
                    <thead class="table-primary">
                    <tr>
                        <th>
                            報名啟迄
                        </th>
                        <th>
                            名稱
                        </th>
                        <th>
                            動作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($actions as $action)
                        <tr>
                            <td>
                                <span @if($action->disable) style="text-decoration:line-through" @endif>
                                    {{ $action->started_at }}<br>
                                    {{ $action->stopped_at }}
                                </span>
                            </td>
                            <td>
                                <span @if($action->disable) style="text-decoration:line-through" @endif>
                                    {{ $action->name }}
                                </span>
                                <a href="{{ route('sports.setup.action_show',$action->id) }}" class="btn btn-info btn-sm">報名狀況</a>
                                <a href="{{ route('sports.setup.action_set_number',$action->id) }}" class="btn btn-outline-primary btn-sm" onclick="return confirm('確定？')">編入布牌號碼</a>
                                <a href="{{ route('sports.setup.action_set_number_null',$action->id) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('確定清空？')">學生布牌號碼清空</a>
                                @if($action->disable)
                                    <span class="text-danger">[已停止報名]</span>
                                @endif
                                <br>
                                <small class="text-secondary">每人徑賽最多報{{ $action->track }}項 田賽最多報{{ $action->field }}項  全部最多報{{ $action->frequency }} 項 號碼布為 {{ $action->numbers }} 位數</small>
                            </td>
                            <td>
                                @if($action->disable) 
                                    <a href="#" class="btn btn-outline-success btn-sm" onclick="sw_confirm('確定再開放報名？','{{ route('sports.setup.action_disable',$action->id) }}')">開放報名</a>
                                @else
                                    <a class="btn btn-success btn-sm" href="{{ route('sports.setup.item_index',$action->id) }}">比賽項目</a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('sports.setup.action_edit',$action->id) }}">修改</a>                                    
                                    <a href="#" class="btn btn-warning btn-sm" onclick="sw_confirm('確定停止報名？','{{ route('sports.setup.action_disable',$action->id) }}')">停止報名</a>
                                @endif                                    
                                    <a href="#" class="btn btn-danger btn-sm" onclick="sw_confirm('確定刪除？這次的所有項目、學生報名記錄都會一起刪除喔！','{{ route('sports.setup.action_destroy',$action->id) }}')">刪除</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                    </tbody>
                </table>



            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">                
                <br>
                <table class="table table-striped">
                    <thead class="table-primary">
                    <tr>
                        <th style="width:20%">
                            序號
                        </th>
                        <th style="width:30%">
                            職稱 (學期)
                        </th>
                        <th style="width:20%">
                            姓名
                        </th>
                        <th style="width:10%">
                            任教
                        </th>
                        <th style="width:20%">
                            動作 
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->job_title->title }} ({{ $user->job_title->semester }})
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                <?php
                                    $semester = get_date_semester(date('Y-m-d'));
                                    $check_teacher = \App\Models\StudentClass::where('semester',$semester)->where('user_ids',$user->id)->first();                            
                                ?>
                                @if($check_teacher)
                                    {{ $check_teacher->student_year }}年{{ $check_teacher->student_class }}班
                                @endif
                            </td>
                            <td>
                                @if(!check_admin('school_admin',$user->id))
                                    @if($user->id != auth()->user()->id)
                                    <a href="{{ route('sims.impersonate',$user->id) }}" class="btn btn-sm btn-secondary">模</a>
                                    @else
                                    自己
                                    @endif
                                @else
                                    系統管理者
                                @endif                        
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                333
            </div>
        </div>
                  
        @else
        <span>你不是管理者</span>
        @endif
    </div>
</div>

@endsection
