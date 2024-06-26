@extends('layouts.master')

@section('page_title','學生帳號管理')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">學生帳號管理</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.errors')
            <div class="col-md-4 col-12">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#excel_import">
                    使用 Excel 匯入學生
                </button>
                <br>
                @if(check_admin('club_admin'))
                    <a class="btn btn-secondary mt-2" href="{{ route('clubs.index') }}"><i class="fas fa-backward"></i> 返回社團模組</a>                
                @endif
                <a href="{{ route('users.teach_excel') }}" class="btn btn-primary mt-2">Excel 設定教學</a>
            </div>
        </div>
        <div class="row">
            @include('layouts.errors')            
            <div class="col-12">                                                           
                ps1.若只使用 API 拉入帳號，因 cloudschool API 不提供學生的生日，故密碼無法建立，社團報名學生無法登入，請用「匯入 Excel」的方式再建立一次。
            
            </div>                                    
        </div>
        <hr>
        <div class="row">
            @if(empty($class_data))
                <div class="alert alert-danger" role="alert">
                    學生班級資料沒有進來，請用 Excel 匯入學生。
                </div>
            @else
                <h4>學生班級資料</h4>
                <table class="table">
                    <thead class="table-warning">
                    <tr>
                        <th>
                            學期
                        </th>
                        <th>
                            班級數
                        </th>
                        <th>
                            在籍學生數
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($student_data as $k=>$v)
                        <tr>
                            <td>
                                {{ $k }}
                            </td>
                            <td>
                                {{ $class_data[$k] }} <a href="{{ route('users.show_class',$k) }}" class="btn btn-info btn-sm">詳細資料...</a>
                            </td>
                            <td>
                                {{ $v }}
                            </td>                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="excel_import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">匯入學生 Excel 檔</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.excel_import') }}" method="post" id="excel_import_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message-client_secret" class="col-form-label">學生資料 Excel 檔:</label>
                            <input type="file" name="file" class="form-control" required accept="xlsx">
                        </div>
                        <input type="hidden" name="school_code" value="{{ auth()->user()->current_school_code }}">
                        <input type="hidden" name="semester" value="{{ $this_semester }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('excel_import_form').submit()">送出</button>
                </div>
            </div>
        </div>
    </div>
@endsection
