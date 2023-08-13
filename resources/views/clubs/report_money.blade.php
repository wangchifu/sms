@extends('layouts.master')

@section('page_title','社團報名系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('clubs.report') }}">報表輸出</a></li>
            <li class="breadcrumb-item active" aria-current="page">收費報表</li>
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
        <h2>收費報表</h2>
        <div class="card">
            <div class="card-body">                
                @if($semester != null)
                    <h4>社團收費報表</h4>
                    <form name=myform>
                        <div class="form-group">
                            {{ Form::select('semester', $club_semesters_array,$semester, ['id'=>'semester','class' => 'form-control','placeholder'=>'--請選擇學期--','onchange'=>'jump()']) }}
                        </div>
                    </form>
                    <a href="{{ route('clubs.report') }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>

                    <h4 class="text-primary">
                        [ 1.學生特色社團 ]
                    </h4>
                        <a href="{{ route('clubs.report_money_download',['semester'=>$semester,'class_id'=>'1']) }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> 下載 Excel 檔</a>
                        <a href="{{ route('clubs.report_money2_print',['semester'=>$semester,'class_id'=>'1']) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-download"></i> 列印 學生特色社團收據三聯單</a>
                        <a href="{{ route('clubs.report_money_download2',['semester'=>$semester,'class_id'=>'1']) }}" class="btn btn-success btn-sm"><i class="fas fa-download"></i> 下載「彰化智慧校園」收費模組匯入單檔</a>
                    <table class="table table-striped">
                        <tr>
                            <th>
                                學號
                            </th>
                            <th>
                                座號
                            </th>
                            <th>
                                姓名
                            </th>
                            <th>
                                身分證字號
                            </th>
                            <th>
                                生日
                            </th>
                            <th>
                                年級
                            </th>
                            <th>
                                班別
                            </th>
                            <th>
                                減免
                            </th>
                            @foreach($open_clubs_name1 as $k =>$v)
                                <th>
                                    {{ $v }}
                                </th>
                            @endforeach
                        </tr>
                        <?php $all1 = 0; ?>
                        @foreach($students1 as $k=>$v)
                            <tr>
                                <td>
                                    {{ $v['no'] }}
                                </td>
                                <td>
                                    {{ (int)$v['num'] }}
                                </td>
                                <td>
                                    {{ $v['name'] }}
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    {{ $v['year'] }}
                                </td>
                                <td>
                                    {{ (int)$v['class'] }}
                                </td>
                                <td>

                                </td>
                                @foreach($open_clubs_name1 as $k2=>$v2)
                                    <td>
                                        @if(isset($register_data1[$k][$k2]))
                                            {{ $register_data1[$k][$k2] }}
                                            <?php 
                                                $all1 = $all1+$register_data1[$k][$k2];
                                            ?>
                                        @else
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                    總金額1：{{ $all1 }}
                    <br><br>
                    <hr>
                    <h4 class="text-primary">
                        [ 2.學生課後活動 ]
                    </h4>
                        <a href="{{ route('clubs.report_money_download',['semester'=>$semester,'class_id'=>'2']) }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> 下載 Excel 檔</a>
                        <a href="{{ route('clubs.report_money2_print',['semester'=>$semester,'class_id'=>'2']) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-download"></i> 列印 學生課後活動收據三聯單</a>
                        <a href="{{ route('clubs.report_money_download2',['semester'=>$semester,'class_id'=>'2']) }}" class="btn btn-success btn-sm"><i class="fas fa-download"></i> 下載「彰化智慧校園」收費模組匯入單檔</a>
                    <table class="table table-striped">
                        <tr>
                            <th>
                                學號
                            </th>
                            <th>
                                座號
                            </th>
                            <th>
                                姓名
                            </th>
                            <th>
                                身分證字號
                            </th>
                            <th>
                                生日
                            </th>
                            <th>
                                年級
                            </th>
                            <th>
                                班別
                            </th>
                            <th>
                                減免
                            </th>
                            @foreach($open_clubs_name2 as $k =>$v)
                                <th>
                                    {{ $v }}
                                </th>
                            @endforeach
                        </tr>
                        <?php $all2 = 0; ?>
                        @foreach($students2 as $k=>$v)
                            <tr>
                                <td>
                                    {{ $v['no'] }}
                                </td>
                                <td>
                                    {{ (int)$v['num'] }}
                                </td>
                                <td>
                                    {{ $v['name'] }}
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    {{ $v['year'] }}
                                </td>
                                <td>
                                    {{ (int)$v['class'] }}
                                </td>
                                <td>

                                </td>
                                @foreach($open_clubs_name2 as $k2=>$v2)
                                    <td>
                                        @if(isset($register_data2[$k][$k2]))
                                            {{ $register_data2[$k][$k2] }}
                                        @else
                                        @endif
                                    </td>
                                    <?php 
                                        $all2 = $all2+$register_data2[$k][$k2];
                                    ?>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                    總金額2：{{ $all2 }}
                    <br><br>
                @elseif(!$admin)
                    <span class="text-danger">你不是管理者</span>
                @else
                    <span class="text-danger">請先新增學期</span>
                @endif
            </div>
        </div>        
    </div>
</div>
<script language='JavaScript'>

    function jump(){
        if(document.myform.semester.options[document.myform.semester.selectedIndex].value!=''){
            location="/clubs/report_money/" + document.myform.semester.options[document.myform.semester.selectedIndex].value;
        }
    }

</script>
@endsection
