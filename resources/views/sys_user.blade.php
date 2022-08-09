@extends('layouts.master')

@section('page_title','帳號管理')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">本校帳號</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h4>教職員工資料</h4>
            <div>
                <a href="#" class="btn btn-danger btn-sm" onclick="sw_confirm('確定登出？','{{ route('sys_logout') }}')">登出</a>
            </div>
        
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
                            管理員
                        </th>
                        <th style="width:10%">
                            狀況
                        </th>
                        <th style="width:10%">
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
                                    $admin = \App\Models\SchoolPower::where('user_id',$user->id)
                                    ->where('module','school_admin')
                                    ->where('power_type','1')
                                    ->first();
                                ?>
                                @if($admin)
                                <i class="fas fa-crown"></i>
                                @endif
                            </td>
                            <td>
                                @if($user->disable==1)
                                    <span class="text-danger">離職</span>
                                @else
                                    <span class="text-primary">在職</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-secondary" onclick="sw_confirm('確定嗎？','{{ route('impersonate',$user->id) }}')">模</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endsection
