@extends('layouts.master')

@section('page_title','借用清單-管理者')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">借用系統</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['index'] ="";
$active['my_list'] ="";
$active['admin'] ="";
$active['list'] ="active";

?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('lends.nav')
        <br>
        <h2>借用清單</h2>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <form id="line_form" action="{{ route('store_line_notify') }}" method="post" onsubmit="return false">
                    @csrf 
                    <table>
                        <tr>
                            <td>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">LINE權杖</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="line_key" value="{{ auth()->user()->line_key }}">
                                    <div id="emailHelp" class="form-text">有借用單時，會發LINE通知給你.</div>
                                  </div>
                            </td>
                            <td>
                                <button class="btn btn-success" onclick="return sw_confirm2('確定嗎？','line_form')">儲存</button>
                            </td>
                        </tr>
                    </table>
                    </form>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">今日要借出</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">今日要歸還</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">全部借單</button>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <br>
                            <h5><span class="badge bg-primary"><i class="fas fa-angle-left"></i>往前</span> <span id="this_day2">{{ date('Y-m-d') }}</span> <span class="badge bg-primary">往後<i class="fas fa-angle-right"></i></span></h5>
                            <table class="table table-border table-striped">
                                <tr>
                                    <th>
                                        填寫時間
                                    </th>
                                    <th>
                                        借用人
                                    </th>
                                    <th>
                                        借用物品
                                    </th>
                                    <th>
                                        借用時間
                                    </th>
                                    <th>
                                        歸還時間
                                    </th>
                                    <th>
                                        備註
                                    </th>
                                </tr>
                                @foreach($lend_orders2 as $lend_order)
                                <tr>
                                    <td>
                                        {{ $lend_order->created_at }}
                                    </td>
                                    <td>
                                        {{ $lend_order->user->name }}
                                    </td>
                                    <td>
                                        {{ $lend_order->lend_item->name }}<br>{{ $lend_order->num }}
                                    </td>
                                    <td>
                                        {{ $lend_order->lend_date }}<br>{{ $sections_array[$lend_order->lend_section] }}
                                    </td>
                                    <td>
                                        {{ $lend_order->back_date }}<br>{{ $sections_array[$lend_order->back_section] }}
                                    </td>
                                    <td>
                                        {{ $lend_order->ps }}
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <br>
                            <h5><span class="badge bg-primary"><i class="fas fa-angle-left"></i>往前</span> <span id="this_day2">{{ date('Y-m-d') }}</span> <span class="badge bg-primary">往後<i class="fas fa-angle-right"></i></span></h5>
                            <table class="table table-border table-striped">
                                <tr>
                                    <th>
                                        填寫時間
                                    </th>
                                    <th>
                                        借用人
                                    </th>
                                    <th>
                                        借用物品
                                    </th>
                                    <th>
                                        借用時間
                                    </th>
                                    <th>
                                        歸還時間
                                    </th>
                                    <th>
                                        備註
                                    </th>
                                </tr>
                                @foreach($lend_orders3 as $lend_order)
                                <tr>
                                    <td>
                                        {{ $lend_order->created_at }}
                                    </td>
                                    <td>
                                        {{ $lend_order->user->name }}
                                    </td>
                                    <td>
                                        {{ $lend_order->lend_item->name }}<br>{{ $lend_order->num }}
                                    </td>
                                    <td>
                                        {{ $lend_order->lend_date }}<br>{{ $sections_array[$lend_order->lend_section] }}
                                    </td>
                                    <td>
                                        {{ $lend_order->back_date }}<br>{{ $sections_array[$lend_order->back_section] }}
                                    </td>
                                    <td>
                                        {{ $lend_order->ps }}
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <br>
                            <table class="table table-border table-striped">
                                <tr>
                                    <th>
                                        填寫時間
                                    </th>
                                    <th>
                                        借用人
                                    </th>
                                    <th>
                                        借用物品
                                    </th>
                                    <th>
                                        借用時間
                                    </th>
                                    <th>
                                        歸還時間
                                    </th>
                                    <th>
                                        備註
                                    </th>
                                </tr>
                                @foreach($lend_orders as $lend_order)
                                <tr>
                                    <td>
                                        {{ $lend_order->created_at }}
                                    </td>
                                    <td>
                                        {{ $lend_order->user->name }}
                                    </td>
                                    <td>
                                        {{ $lend_order->lend_item->name }}<br>{{ $lend_order->num }}
                                    </td>
                                    <td>
                                        {{ $lend_order->lend_date }}<br>{{ $sections_array[$lend_order->lend_section] }}
                                    </td>
                                    <td>
                                        {{ $lend_order->back_date }}<br>{{ $sections_array[$lend_order->back_section] }}
                                    </td>
                                    <td>
                                        {{ $lend_order->ps }}
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            {{  $lend_orders->links() }}
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
@endsection
