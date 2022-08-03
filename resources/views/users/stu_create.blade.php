@extends('layouts.master')

@section('page_title','班級詳細資料')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.stu_index') }}">學生帳號管理</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.show_class',['semester'=>$student_class->semester,'student_year'=>$student_class->student_year,'student_class'=>$student_class->student_class]) }}">班級詳細資料</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增此班學生</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <h2>{{ $student_class->semester }}學期 新增{{ $student_class->student_year }}年{{ $student_class->student_class }}班學生</h2>
        <div class="row">    
            <div class="col-xl-12 col-md-12">
                {{ Form::open(['route' => ['users.stu_store'], 'method' => 'POST','id'=>'store_form','onsubmit'=>'return false']) }}
                        <div class="form-group">
                            <label for="student_sn"><strong>學號*</strong><small class="text-primary">(6碼 如 108001)</small></label>
                            {{ Form::text('student_sn',null,['id'=>'student_sn','class' => 'form-control','maxlength'=>'6','required'=>'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="name"><strong>姓名*</strong></label>
                            {{ Form::text('name',null,['id'=>'name','class' => 'form-control','required'=>'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="sex"><strong>性別*</strong></label>
                            {{ Form::select('sex',['男'=>'男','女'=>'女'],null,['id'=>'sex','class' => 'form-control','required'=>'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="num"><strong>座號*</strong></label>
                            {{ Form::text('num',null,['id'=>'num','class' => 'form-control','maxlength'=>'5','required'=>'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="birthday"><strong>生日*</strong><small class="text-primary">(如 2013/01/01)</small></label>
                            {{ Form::date('birthday',null,['id'=>'birthday','class' => 'form-control','maxlength'=>'8','required'=>'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="parents_telephone">家長電話</label>
                            {{ Form::text('parents_telephone',null,['id'=>'parents_telephone','class' => 'form-control']) }}
                        </div>
                        <a class="btn btn-secondary btn-sm" href="{{ route('users.show_class',$student_class->semester) }}"><i class="fas fa-backward"></i> 返回</a>
                        <button type="submit" class="btn btn-primary btn-sm" onclick="sw_confirm2('確定儲存嗎？','store_form')">
                            <i class="fas fa-save"></i> 儲存
                        </button>
                        @include('layouts.errors')
                        <input type="hidden" name="semester" value="{{ $student_class->semester }}">
                        <input type="hidden" name="student_year" value="{{ $student_class->student_year }}">
                        <input type="hidden" name="student_class" value="{{ $student_class->student_class }}">
                {{ Form::close() }}
            </div>                  
        </div>
        <br>
        
    </div>
@endsection
