@extends('layouts.master')

@section('page_title','運動會報名系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sports.setup') }}">報名任務</a></li>
            <li class="breadcrumb-item active" aria-current="page">比賽項目</li>
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
        <h2>{{ $select_action->name }}的比賽項目</h2>
        @if(check_admin('sport_admin'))
        <form name="myform">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <a class="btn btn-success" href="{{ route('sports.setup.item_create',$select_action->id) }}">新增比賽項目</a>
                </div>
            </div>
                <input type="hidden" name="select_action" value="{{ $select_action }}">
            </form>
            <form action="{{ route('sports.setup.item_import') }}" method="post">
                @csrf
                或是 從
                <select name="old_action_id">
                    @foreach($actions as $action)
                        @if($action->id <> $select_action->id)
                            <option value="{{ $action->id }}">{{ $action->name }}</option>
                        @endif
                    @endforeach
                </select>
                <input type="hidden" name="new_action_id" value="{{ $select_action }}">
                <button onclick="return confirm('確定嗎？')"><i class="fas fa-copy"></i> 複製至此</button>
            </form>
            <table class="table table-striped">
                <thead class="table-primary">
                <tr>
                    <th>
                        排序
                    </th>
                    <th>
                        名稱
                    </th>
                    <th>
                        組別
                    </th>
                    <th>
                        類別
                    </th>
                    <th>
                        參賽年級
                    </th>
                    <th>
                        動作
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                            {{ $item->order }}
                        </td>
                        <td>
                            @if($item->limit)
                                <span class="badge badge-danger">限</span>
                            @endif
                            <span @if($item->disable) style="text-decoration:line-through" @endif>
                                {{ $item->name }}
                            </span>
                            @if($item->game_type=="personal")
                                <span class="badge badge-warning">個人</span>
                            @endif
                            @if($item->game_type=="group")
                                <span class="badge badge-primary">團體</span>({{ $item->official }};{{ $item->reserve }})
                            @endif
                            @if($item->game_type=="class")
                                <span class="badge badge-info">班際</span>
                            @endif
                            @if($item->disable)
                                <span class="text-danger">[停用]</span>
                            @endif
                        </td>
                        <td>
                            <span @if($item->disable) style="text-decoration:line-through" @endif>
                                @if($item->group == 1)
                                    <span class="text-primary">男子組</span>
                                @elseif($item->group == 2)
                                    <span class="text-danger">女子組</span>
                                @elseif($item->group == 3)
                                    <span class="text-primary">男子組</span>+<span class="text-danger">女子組</span> 各
                                @endif
                                {{ $item->people }} 個(隊) 取 {{ $item->reward }} 名
                            </span>
                        </td>
                        <td>
                            <span @if($item->disable) style="text-decoration:line-through" @endif>
                                @if($item->type == 1)
                                    徑賽
                                @elseif($item->type == 2)
                                    田賽
                                @elseif($item->type == 3)
                                    其他
                                @endif
                            </span>
                        </td>
                        <td>
                            <span @if($item->disable) style="text-decoration:line-through" @endif>
                            @foreach(unserialize($item->years) as $y)
                                {{ $y }},
                            @endforeach
                            </span>
                        </td>
                        <td>
                            @if($item->disable)
                                <a href="#" class="btn btn-success btn-sm" onclick="sw_confirm('確定再啟用它？','{{ route('sports.setup.item_disable',$item->id) }}');">啟用</a>
                            @else
                                <a class="btn btn-primary btn-sm" href="{{ route('sports.setup.item_edit',$item->id) }}">修改</a>
                                <a href="#" class="btn btn-dark btn-sm" onclick="sw_confirm('確定停用它？','{{ route('sports.setup.item_disable',$item->id) }}');">停用</a>
                            @endif
                            <a href="{{ route('school_admins.item_destroy',$item->id) }}" class="btn btn-danger btn-sm" onclick="sw_confirm('連同學生報名資料、成績、名次一起刪除喔','{{ route('sports.setup.item_destroy',$item->id) }}')">刪除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>                          
        @else
        <span>你不是管理者</span>
        @endif
    </div>
</div>

@endsection
