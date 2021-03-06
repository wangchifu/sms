@extends('layouts.master')

@section('page_title','帳號管理')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">帳號管理</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.errors')
            <div class="col-md-4 col-12">
                <!--
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#api_create">
                    方法一：使用 cloudschool API 匯入老師及學生
                </button>
                 -->
                 <button type="button" class="btn btn-outline-success">
                    方法一：使用 API 匯入老師及學生(working)
                </button>
                <br>
                <a href="{{ route('users.teach_api') }}" class="btn btn-success mt-2">API 設定教學</a>
            </div>
            <div class="col-md-4 col-12">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#excel_import">
                    方法二：使用 Excel 匯入學生
                </button>
                <br>
                <a href="{{ route('users.teach_excel') }}" class="btn btn-primary mt-2">Excel 設定教學</a>
            </div>
            <div class="col-md-4 col-12">
                ps.若沒有使用 API 匯入，教職員<span class="text-danger">須先登入</span>才會有帳號出現在系統內。
            </div>
        </div>
        <br>
        <hr>
        <div class="row">
            @if(!empty($school_api))
                <table class="table">
                    <thead class="table-primary">
                    <tr>
                        <th style="width:40%">
                            API 用戶端 ID
                        </th>
                        <th style="width:40%">
                            API 用戶端密碼
                        </th>
                        <th style="width:20%">
                            動作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            {{ $school_api->client_id }}
                        </td>
                        <td>
                            {{ $school_api->client_secret }}
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="pull_data()">拉回資料</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#api_destroy">刪除</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <hr>
                <form action="{{ route('users.api_destroy',$school_api->id) }}" method="post" id="api_destroy_form">
                    @csrf
                    @method('delete')
                </form>
                <form action="{{ route('users.api_pull') }}" method="post" id="api_pull_form">
                    @csrf
                </form>
            @endif
            @if(empty($class_data))
                <div class="alert alert-danger" role="alert">
                    學生班級資料沒有進來，建議重拉 API，若再不行，可能是 cloudschool API 有問題，考慮用 Excel 匯入學生。
                </div>
            @else
                <h4>學生班級資料</h4>
                <table class="table">
                    <thead class="table-warning">
                    <tr>
                        <th style="width:40%">
                            學期
                        </th>
                        <th style="width:40%">
                            班級數
                        </th>
                        <th style="width:20%">
                            學生數
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
            <h4>教職員工資料</h4>
                <table class="table table-striped">
                    <thead class="table-primary">
                    <tr>
                        <th style="width:20%">
                            序號
                        </th>
                        <th style="width:30%">
                            職稱 (學期)
                        </th>
                        <th style="width:20%">
                            姓名
                        </th>
                        <th style="width:10%">
                            狀況
                        </th>
                        <th style="width:20%">
                            動作 
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->job_title->title }} ({{ $user->job_title->semester }})
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                @if($user->disable==1)
                                    <span class="text-danger">離職</span>
                                @else
                                    <span class="text-primary">在職</span>
                                @endif
                            </td>
                            <td>
                                @if($user->disable == null and $user->id != auth()->user()->id)
                                <a href="#" class="btn btn-sm btn-danger" onclick="sw_confirm('確定要將他離職？','{{ route('users.disable',$user->id) }}');">離</a>
                                @endif
                                @if($user->disable == 1)
                                <a href="#" class="btn btn-sm btn-success" onclick="sw_confirm('確定要將他復職？','{{ route('users.disable',$user->id) }}');">復</a>
                                @endif
                                @if($user->id != auth()->user()->id)
                                <a href="{{ route('sims.impersonate',$user->id) }}" class="btn btn-sm btn-secondary">模</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="api_create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CloudSchool API 匯入</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.api_store') }}" method="post" id="api_store">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-client_id" class="col-form-label">API 用戶端 ID:</label>
                            <input type="text" class="form-control" id="client_id-name" name="client_id" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="message-client_secret" class="col-form-label">API 用戶端密碼:</label>
                            <input type="text" class="form-control" id="client_secret-name" name="client_secret" required>
                        </div>
                        <input type="hidden" name="school_code" value="{{ auth()->user()->current_school_code }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('api_store').submit()">送出</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="excel_import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CloudSchool API 匯入</h5>
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

    <div class="modal fade" id="api_destroy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">刪除確認</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    你確定要刪除此 API？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger" onclick="document.getElementById('api_destroy_form').submit()">確定刪除</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="api_pull" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">確認拉回資料</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    你確定要拉回此 API 帶回來的資料？可能要一陣子喔，不要重複按喔！
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger" onclick="document.getElementById('api_pull_form').submit()">確定拉回</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function pull_data(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }else{
                    Swal.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection
