@extends('layouts.master')

@section('page_title','社團報名系統')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">社團報名系統-社團列表</li>
        </ol>
    </nav>
@endsection

@section('content')
<?php

$active['semester'] ="";
$active['setup'] ="active";
$active['list'] ="";
?>
<div class="row justify-content-center">
    <div class="col-md-11">
        @include('clubs.nav')
        <br>
        <h2>社團列表</h2>
        <form name=myform>
            <div class="form-group">
                {{ Form::select('semester', $club_semesters_array,$semester, ['id'=>'semester','class' => 'form-control','placeholder'=>'--請選擇學期--','onchange'=>'jump()']) }}
            </div>
        </form>
        @if($semester)
        <table>
            <tr>
                <td>
                    <a href="{{ route('clubs.club_create',$semester) }}" class="btn btn-success btn-sm">新增社團</a>
                </td>
                <td>
                    <form method="post" action="{{ route('clubs.club_copy') }}">
                        @csrf
                        或 從<input text="text" name="semester1" maxlength="4" size="4" required>學期 複製全部社團到<input text="text" name="semester2" maxlength="4" size="4" required>學期 <input type="submit" value="複製" onclick="return confirm('確定複製嗎？')">
                    </form>
                </td>
            </tr>
        </table>
        @else
            <span class="text-danger">請先新增學期</span>
        @endif
        <h3 class="text-primary">
            [ 1.學生特色社團 ]
        </h3>
        <table class="table table-striped">
            <tr>
                <th>
                    編號
                </th>
                <th>
                    名稱
                </th>
                <th>
                    聯絡人
                </th>
                <th>
                    連絡電話
                </th>
                <th>
                    收費
                </th>
                <th>
                    備註
                </th>
                <th>
                    師資
                </th>
                <th>
                    開課日期
                </th>
                <th>
                    上課時間
                </th>
                <th>
                    集合地點
                </th>
                <th>
                    最少
                </th>
                <th>
                    正取
                </th>
                <th>
                    候補
                </th>
                <th>
                    年級限制
                </th>                
            </tr>
            @foreach($clubs1 as $club)
            <tr>
                <td>
                    <a href="{{ route('clubs.club_edit',$club->id) }}" alt="編輯"><i class="fas fa-edit text-primary"></i></a>
                    <a href="{{ route('clubs.club_delete',$club->id) }}" alt="刪除" onclick="return confirm('確定刪除？')"><i class="fas fa-times-circle text-danger"></i></a>
                    {{ $club->no }}
                </td>
                <td>
                    {{ $club->name }}
                </td>
                <td>
                    {{ $club->contact_person }}
                </td>
                <td>
                    {{ $club->telephone_num }}
                </td>
                <td>
                    {{ $club->money }}
                </td>
                <td>
                    {{ $club->ps }}
                </td>
                <td>
                    {{ $club->teacher_info }}
                </td>
                <td>
                    {{ $club->start_date }}
                </td>
                <td>
                    {{ $club->start_time }}
                    @if($club->no_check)
                    <br>
                    <span class="text-danger">不檢查</span>
                    @endif
                </td>
                <td>
                    {{ $club->place }}
                </td>
                <td>
                    {{ $club->people }}
                </td>
                <td>
                    {{ $club->taking }}
                </td>
                <td>
                    {{ $club->prepare }}
                </td>
                <td>
                    {{ $club->year_limit }}
                </td>                
            </tr>
            @endforeach
        </table>
        <hr>
            <h3 class="text-primary">
                [ 2.學生課後活動 ]
            </h3>
            <table class="table table-striped">
                <tr>
                    <th>
                        編號
                    </th>
                    <th>
                        名稱
                    </th>
                    <th>
                        聯絡人
                    </th>
                    <th>
                        連絡電話
                    </th>
                    <th>
                        收費
                    </th>
                    <th>
                        師資
                    </th>
                    <th>
                        開課日期
                    </th>
                    <th>
                        上課時間
                    </th>
                    <th>
                        集合地點
                    </th>
                    <th>
                        最少
                    </th>
                    <th>
                        正取
                    </th>
                    <th>
                        候補
                    </th>
                    <th>
                        年級限制
                    </th>
                    <th>
                        備註
                    </th>
                </tr>
                @foreach($clubs2 as $club)
                    <tr>
                        <td>
                            <a href="{{ route('clubs.club_edit',$club->id) }}" alt="編輯"><i class="fas fa-edit text-primary"></i></a>
                            <a href="{{ route('clubs.club_delete',$club->id) }}" alt="刪除" onclick="return confirm('確定刪除？')"><i class="fas fa-times-circle text-danger"></i></a>
                            {{ $club->no }}
                        </td>
                        <td>
                            {{ $club->name }}
                        </td>
                        <td>
                            {{ $club->contact_person }}
                        </td>
                        <td>
                            {{ $club->telephone_num }}
                        </td>
                        <td>
                            {{ $club->money }}
                        </td>
                        <td>
                            {{ $club->teacher_info }}
                        </td>
                        <td>
                            {{ $club->start_date }}
                        </td>
                        <td>
                            {{ $club->start_time }}
                            @if($club->no_check)
                            <br>
                            <span class="text-danger">不檢查</span>
                            @endif
                        </td>
                        <td>
                            {{ $club->place }}
                        </td>
                        <td>
                            {{ $club->people }}
                        </td>
                        <td>
                            {{ $club->taking }}
                        </td>
                        <td>
                            {{ $club->prepare }}
                        </td>
                        <td>
                            {{ $club->year_limit }}
                        </td>
                        <td>
                            {{ $club->ps }}
                        </td>
                    </tr>
                @endforeach
            </table>
    </div>
</div>
<script language='JavaScript'>

    function jump(){
        if(document.myform.semester.options[document.myform.semester.selectedIndex].value!=''){
            location="/clubs/setup/" + document.myform.semester.options[document.myform.semester.selectedIndex].value;
        }
    }

</script>
@endsection
