@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-午餐設定</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['teacher'] ="";
$active['student'] ="";
$active['list'] ="";
$active['special'] ="";
$active['order'] ="";
$active['setup'] ="active";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('lunches.nav')
        <br>
        <h2>午餐設定</h2>
        @if($admin)
            <a href="{{ route('lunch_setups.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> 新增學期設定</a>
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th>學期</th>
                    <th>訂餐設定</th>
                    <th>退餐設定</th>
                    <th>供餐日數</th>
                    <th>管理動作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lunch_setups as $lunch_setup)
                    <?php
                    $order_dates = \App\Models\LunchOrderDate::where('semester',$lunch_setup->semester)->where('enable','1')->get();
                    $has_ordered = (count($order_dates)==0)?0:1;
                    $tea_order_dates = \App\Models\LunchTeaDate::where('semester',$lunch_setup->semester)->get();
                    $tea_has_ordered = (count($tea_order_dates)==0)?0:1;
                    ?>
                    <tr>
                        <td>
                            @if($lunch_setup->disable==1)
                                <i class="fas fa-times-circle text-danger"></i>
                            @else
                                <i class="fas fa-check-circle text-success"></i>
                            @endif
                            {{ $lunch_setup->semester }}
                        </td>
                        <td>
                            @if($lunch_setup->teacher_open)
                                <strong class="text-danger">隨時可訂(請盡速關閉)</strong>
                            @else
                                <strong class="text-primary">最晚前 <span class="text-danger">{{ $lunch_setup->die_line }}</span> 天可訂餐</strong><br>
                                <small class="text-secondary">(如，2月的餐期，最晚 含1月{{ 32-$lunch_setup->die_line }}日前要訂餐)</small>
                            @endif
                        </td>
                        <td>
                            @if($lunch_setup->disable)
                                <strong class="text-danger">期末結算，停止退餐</strong>
                            @else
                                <strong class="text-primary">最晚前 <span class="text-danger">{{ $lunch_setup->die_line }}</span> 天可退餐</strong><br>
                                <small class="text-secondary">(如，2月1日，可以退 含2月{{ $lunch_setup->die_line+1 }}日 以後的餐)</small>
                            @endif
                        </td>
                        <td>
                            {{ count($order_dates) }}
                        </td>
                        <td>
                            @if($has_ordered)
                                @if($tea_has_ordered)
                                    <span class="text-danger">已有訂餐記錄</span>
                                @else
                                    <a href="{{ route('lunch_orders.edit',$lunch_setup->semester) }}" class="btn btn-secondary btn-sm"><i class="fas fa-calendar-alt"></i> 修改供餐日</a>
                                @endif
                            @else
                                <a href="{{ route('lunch_orders.create',$lunch_setup->semester) }}" class="btn btn-primary btn-sm"><i class="fas fa-calendar-alt"></i> 設定供餐日</a>
                            @endif
                            <a href="{{ route('lunch_setups.edit',$lunch_setup->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> 修改</a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="sw_confirm2('當真刪除？已有訂餐資料，將一併刪除喔！','delete{{ $lunch_setup->id }}');"><i class="fas fa-trash"></i> 刪除</a>
                        </td>
                        {{ Form::open(['route' => ['lunch_setups.destroy',$lunch_setup->id], 'method' => 'DELETE','id'=>'delete'.$lunch_setup->id]) }}
                        {{ Form::close() }}
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $lunch_setups->links() }}
            <hr>
            <div class="card">
                <div class="h3 card-header">
                    取餐地點管理
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-primary">
                        <tr>
                            <th>
                                停用?
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
                        <form action="{{ route('lunch_setups.place_add') }}" method="post" id="add_place" onsubmit="return false">
                            @csrf
                        <tr>
                            <td>
                                <input type="checkbox" name="disable" id="disable" value="1"> <label for="disable">停用</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="name">
                            </td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="sw_confirm2('確定新增地點？','add_place')">新增地點</button>
                            </td>
                        </tr>
                        </form>
                        @foreach($places as $place)
                            <?php $bgcolor =($place->disable)?"#FFB7DD":""; ?>
                            <form action="{{ route('lunch_setups.place_update',$place->id) }}" method="post" id="update_place{{ $place->id }}" onsubmit="return false">

                            <tr style="background-color: {{ $bgcolor }}">
                                <td>
                                    <?php $check = ($place->disable)?"checked":""; ?>
                                    <input type="checkbox" name="disable" {{ $check }} value="1" id="disable{{ $place->id }}"> <label for="disable{{ $place->id }}"> 停用</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="name" value="{{ $place->name }}" required>
                                </td>
                                <td>

                                        @csrf
                                        @method('patch')
                                        <button class="btn btn-primary btn-sm" onclick="sw_confirm2('確定更新地點？','update_place{{ $place->id }}')">更新資料</button>
                                </td>
                            </tr>
                            </form>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            @include('layouts.errors')
            <div class="card">
                <div class="h3 card-header">
                    廠商管理
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-info">
                        <tr>
                            <th>
                                停用?
                            </th>
                            <th>
                                名稱
                            </th>
                            <th width="200">
                                帳號
                            </th>
                            <th width="200">
                                密碼
                            </th>
                            <th>
                                動作
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <form action="{{ route('lunch_setups.factory_add') }}" method="post" id="add_factory" onsubmit="return false">
                            @csrf
                            <tr>
                                <td>
                                    <input type="checkbox" name="disable" id="disable_f" value="1"> <label for="disable_f">停用</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="name" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fid" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fpwd" required>
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="sw_confirm2('確定新增廠商？','add_factory')">新增廠商</button>
                                </td>
                            </tr>
                        </form>
                        @foreach($factories as $factory)
                            <?php $bgcolor =($factory->disable)?"#FFB7DD":""; ?>
                            <form action="{{ route('lunch_setups.factory_update',$factory->id) }}" method="post" id="update_factory{{ $factory->id }}" onsubmit="return false">
                                <tr style="background-color: {{ $bgcolor }}">
                                    <td>
                                        <?php $check = ($factory->disable)?"checked":""; ?>
                                        <input type="checkbox" name="disable" {{ $check }} value="1" id="disable_f{{ $factory->id }}"> <label for="disable_f{{ $factory->id }}"> 停用</label>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="name" value="{{ $factory->name }}" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="fid" value="{{ $factory->fid }}" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="fpwd" value="{{ $factory->fpwd }}" required>
                                    </td>
                                    <td>
                                        @csrf
                                        @method('patch')
                                        <button class="btn btn-primary btn-sm" onclick="sw_confirm2('確定更新廠商？','update_factory{{ $factory->id }}')">更新資料</button>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <h1 class="text-danger">你不是管理者</h1>
        @endif
    </div>
</div>
<script>
    var validator = $("#add_place").validate();
    var validator = $("#add_factory").validate();
</script>
@endsection
