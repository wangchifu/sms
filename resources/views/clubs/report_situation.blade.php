@extends('layouts.master')

@section('page_title','社團報名系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">社團報名系統-報表輸出</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['semester'] ="";
$active['setup'] ="";
$active['list'] ="active";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('clubs.nav')
        <br>
        <h2>社團報名狀況</h2>
        @if($semester != null)
        <form name=myform>
            <div class="form-group">
                {{ Form::select('semester', $club_semesters_array,$semester, ['id'=>'semester','class' => 'form-control','placeholder'=>'--請選擇學期--','onchange'=>'jump()']) }}
            </div>
        </form>
            <a href="{{ route('clubs.report') }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
            <h3 class="text-primary">
                [ 1.學生特色社團 ]
            </h3>
            <a href="{{ route('clubs.report_situation_download',['semester'=>$semester,'class_id'=>1]) }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> 下載 Excel 檔</a>
        @foreach($clubs1 as $club)
            <div class="card">
                <div class="card-header">
                    <h4>
                        {{ $club->no }} {{ $club->name }}
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                        $club_registers = \App\Models\ClubRegister::where('semester',$semester)
                                            ->where('club_id',$club->id)
                                            ->get();
                        $taking = $club->taking;
                        $prepare = $club->prepare;
                        $i=1;
                        $j=1;

                    ?>
                    <table class="table table-hover">
                        <tr>
                            <th>
                                社團
                            </th>
                            <th>
                                班級座號
                            </th>
                            <th>
                                姓名
                            </th>
                            <th>
                                家長電話
                            </th>
                            <th>
                                錄取狀況
                            </th>
                            <th>
                                報名時間
                            </th>
                            <th>
                                開班狀態
                            </th>
                            <th>
                                動作
                            </th>
                        </tr>
                        @if(count($club_registers) >0)

                        @else

                        @endif
                        @foreach($club_registers as $club_register)
                            @if($i <= $taking)
                                <tr>
                            @endif
                            @if($i > $taking and $j <= $prepare)
                                <tr class="bg-info">
                            @endif
                                <td>
                                    {{ $club->name }}
                                </td>
                                <td>
                                    {{ $club_register->user->class_num }}
                                </td>
                                <td>
                                    {{ $club_register->user->name }}
                                </td>
                                <td>
                                    {{ $club_register->user->parents_telephone }}
                                </td>
                                <td>
                                    @if($i <= $taking)
                                        正取{{ $i }}
                                    @endif
                                    @if($i > $taking and $j <= $prepare)
                                        候補{{ $j }}
                                        <?php $j++; ?>
                                    @endif
                                </td>
                                <td>
                                    {{ $club_register->created_at }}
                                </td>
                                <td>
                                    @if(count($club_registers) < $club->people)
                                        <span class="text-danger">不開班</span>
                                    @else
                                        <span class="text-success">開班成功</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('clubs.report_register_delete',$club_register->id) }}" onclick="return confirm('確定刪除報名？')"><i class="fas fa-times-circle text-danger"></i></a>
                                </td>

                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </table>
                </div>
            </div>
            <hr>
        @endforeach
            <h3 class="text-primary">
                [ 2.學生課後活動 ]
            </h3>
            <a href="{{ route('clubs.report_situation_download',['semester'=>$semester,'class_id'=>2]) }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> 下載 Excel 檔</a>
            @foreach($clubs2 as $club)
                <div class="card">
                    <div class="card-header">
                        <h4>
                            {{ $club->no }} {{ $club->name }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $club_registers = \App\Models\ClubRegister::where('semester',$semester)
                            ->where('club_id',$club->id)
                            ->get();
                        $taking = $club->taking;
                        $prepare = $club->prepare;
                        $i=1;
                        $j=1;

                        ?>
                        <table class="table table-hover">
                            <tr>
                                <th>
                                    社團
                                </th>
                                <th>
                                    班級座號
                                </th>
                                <th>
                                    姓名
                                </th>
                                <th>
                                    家長電話
                                </th>
                                <th>
                                    錄取狀況
                                </th>
                                <th>
                                    報名時間
                                </th>
                                <th>
                                    開班狀態
                                </th>
                                <th>
                                    動作
                                </th>
                            </tr>
                            @if(count($club_registers) >0)

                            @else

                            @endif
                            @foreach($club_registers as $club_register)
                                @if($i <= $taking)
                                    <tr>
                                @endif
                                @if($i > $taking and $j <= $prepare)
                                    <tr class="bg-info">
                                        @endif
                                        <td>
                                            {{ $club->name }}
                                        </td>
                                        <td>
                                            {{ $club_register->user->class_num }}
                                        </td>
                                        <td>
                                            {{ $club_register->user->name }}
                                        </td>
                                        <td>
                                            {{ $club_register->user->parents_telephone }}
                                        </td>
                                        <td>
                                            @if($i <= $taking)
                                                正取{{ $i }}
                                            @endif
                                            @if($i > $taking and $j <= $prepare)
                                                候補{{ $j }}
                                                <?php $j++; ?>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $club_register->created_at }}
                                        </td>
                                        <td>
                                            @if(count($club_registers) < $club->people)
                                                <span class="text-danger">不開班</span>
                                            @else
                                                <span class="text-success">開班成功</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('clubs.report_register_delete',$club_register->id) }}" onclick="return confirm('確定刪除報名？')"><i class="fas fa-times-circle text-danger"></i></a>
                                        </td>

                                    </tr>
                                    <?php $i++; ?>
                                    @endforeach
                        </table>
                    </div>
                </div>
                <hr>
            @endforeach
        @endif
    </div>
</div>

@endsection