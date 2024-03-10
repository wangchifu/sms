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
$active['my_list'] ="active";
$active['admin'] ="";
$active['list'] ="";

?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('lends.nav')
        <br>
        <h2>我的借用</h2>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-1">
                    
                </div>
                <div class="col-12 col-md-10">
                    <h4>我曾借用的清單</h4>
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
                <div class="col-12 col-md-1">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
@endsection
