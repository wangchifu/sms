@extends('layouts.master')

@section('page_title','班級詳細資料')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.stu_index') }}">學生帳號管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">班級詳細資料</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <h2>{{ $semester }}學期 請選擇班級：</h2>
        <div class="row">    
            <div class="col-xl-12 col-md-12">
                <table>
                    <tr>                    
                        <td>
                            <form>
                                <select class="form-control" id="select_class" onchange="jump()">
                                    @foreach($student_classes as $student_class)
                                    <?php  $selected=($this_class->id==$student_class->id)?"selected":"";  ?>
                                        <option value="{{ $student_class->student_year }}/{{ $student_class->student_class }}" {{ $selected }}>
                                            {{ $student_class->student_year }}年{{ $student_class->student_class }}班
                                            - {{ $student_class->user_names }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>  
                        </td>
                    </tr>
                </table>                   
                <a href="{{ route('users.stu_index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
                <a href="{{ route('users.stu_create',$this_class->id) }}" class="btn btn-success btn-sm">新增此班學生</a>      
                <a href="{{ route('users.show_disable',$semester) }}" class="btn btn-dark btn-sm">檢視停用學生</a>
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
                        <th>
                            學號
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
                                <a href="#" class="btn btn-secondary btn-sm" onclick="sw_confirm('確定還原密碼為生日嗎？','{{ route('users.stu_back_pwd',$student->id) }}')">還密</a>
                                <a href="{{ route('users.stu_edit',$student->id) }}" class="btn btn-primary btn-sm">編輯</a>
                                <a href="#" class="btn btn-warning btn-sm" onclick="sw_confirm('確定停用？','{{ route('users.stu_disable',$student->id) }}')">停用</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>                  
        </div>
        <br>
        
    </div>
    <script>
        function jump(){
          if($('#select_class').val() !=''){
            location="/users/"+{{ $semester }}+"/show_class/" + $('#select_class').val();
          }
        }
    </script>
@endsection
