@extends('layouts.master')

@section('page_title','午餐系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">午餐系統-餐期管理</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

    $active['teacher'] ="";
    $active['student'] ="";
    $active['list'] ="";
    $active['special'] ="";
    $active['order'] ="active";
    $active['setup'] ="";
    ?>
    <div class="row justify-content-center">
        <div class="col-md-11">
            @include('lunches.nav')
            <br>
            <h2>餐期管理</h2>
            @if($admin)
                <table class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>學期</th>
                        <th>餐期</th>
                        <th>收據</th>
                        <th>備註</th>
                        <th>動作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lunch_orders as $lunch_order)
                        <tr>
                            <td>
                                {{ $lunch_order->semester }}
                            </td>
                            <td>
                                {{ $lunch_order->name }}
                            </td>
                            <td>
                                <small>
                                    收據抬頭：{{ $lunch_order->rece_name }}<br>
                                    收據日期：{{ $lunch_order->rece_date }}<br>
                                    收據字號：{{ $lunch_order->rece_no }}<br>
                                    收據啟始號：{{ $lunch_order->rece_num }}
                                </small>
                            </td>
                            <td class="text-danger">
                                {{ $lunch_order->order_ps }}
                            </td>
                            <td>
                                <a href="{{ route('lunch_orders.edit_order',$lunch_order->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> 修改</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $lunch_orders->links() }}
            @else
                <h1 class="text-danger">你不是管理者</h1>
            @endif
        </div>
    </div>
@endsection
