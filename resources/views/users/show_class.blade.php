@extends('layouts.master')

@section('page_title','班級詳細資料')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">帳號管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">班級詳細資料</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">  
            請選擇：            
            <table>
                <tr>                    
                    <td>
                        <form>
                            <select class="form-control">
                                @foreach($student_classes as $student_class)
                                    <option value="">
                                        {{ $student_class->student_year }}年{{ $student_class->student_class }}班
                                        - {{ $student_class->user_names }}
                                    </option>
                                @endforeach
                            </select>
                        </form>  
                    </td>
                </tr>
            </table>                                  
            <table class="table table-striped">
                <thead class="table-primary">
                <tr>
                    <th>
                        座號
                    </th>
                    <th>
                        性別
                    </th>
                    <th>
                        姓名
                    </th>
                </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>
                            {{ $student->num }}
                        </td>
                        <td>
                            @if($student->sex=="男")
                            <span class="text-primary">{{ $student->sex }}</span>
                            @endif
                            @if($student->sex=="女")
                            <span class="text-danger">{{ $student->sex }}</span>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>           
        </div>
        <br>
        
    </div>
@endsection
