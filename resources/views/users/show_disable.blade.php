@extends('layouts.master')

@section('page_title','停用學生資料')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.stu_index') }}">學生帳號管理</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.show_class',['semester'=>$semester]) }}">班級詳細資料</a></li>
            <li class="breadcrumb-item active" aria-current="page">停用學生資料</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <h2>{{ $semester }}學期停用學生資料</h2>
        <div class="row">    
            <div class="col-xl-12 col-md-12">
                <a href="{{ route('users.show_class',$semester) }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
                <table class="table table-striped">
                    <thead class="table-primary">
                    <tr>
                        <th>
                            年
                        </th>
                        <th>
                            班
                        </th>
                        <th>
                            座號
                        </th>
                        <th>
                            性別
                        </th>
                        <th>
                            姓名
                        </th>
                        <th>
                            學號(帳號)
                        </th>
                        <th>
                            生日
                        </th>
                        <th>
                            密碼
                        </th>
                        <th>
                            家長電話
                        </th>
                        <th>
                            動作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>
                                {{ $student->student_year }}
                            </td>
                            <td>
                                {{ $student->student_class }}
                            </td>
                            <td>
                                {{ $student->num }}
                            </td>
                            <td>
                                @if($student->sex=="男")
                                <img src="{{ asset('images/boy.gif') }}">
                                @endif
                                @if($student->sex=="女")
                                <img src="{{ asset('images/girl.gif') }}">
                                @endif
                            </td>
                            <td>
                                @if($student->sex=="男")
                                <span class="text-primary">{{ $student->name }}</span>
                                @endif
                                @if($student->sex=="女")
                                <span class="text-danger">{{ $student->name }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $student->student_sn }}
                            </td>
                            <td>
                                {{ $student->birthday }}
                            </td>
                            <td>
                                {{ $student->pwd }}
                            </td>
                            <td>
                                {{ $student->parents_telephone }}
                            </td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm" onclick="sw_confirm('確定再啟用？','{{ route('users.stu_disable',$student->id) }}')">再啟用</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>                  
        </div>
        <br>
        
    </div>
@endsection
