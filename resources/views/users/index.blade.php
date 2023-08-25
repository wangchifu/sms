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
            <div class="col-12">                
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#api_create">
                    使用 cloudschool API 匯入老師及學生
                </button>                
                <br>
                <a href="{{ route('users.teach_api') }}" class="btn btn-success mt-2">API 設定教學</a>

                <br><br>            
                ps1.若非用 API 拉入帳號，教職員<span class="text-danger">則須先登入</span>才會有帳號出現在系統內。<br>
                ps2.若使用 API 拉入帳號，因 cloudschool API 不提供學生的生日，故密碼無法建立，社團報名學生無法登入，請用「匯入 Excel」的方式再建立一次。
            
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
                            <button class="btn btn-info btn-sm" onclick="pull_data()">拉回教職和學生的資料</button>
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
                title: '你確定要拉回嗎?',
                text: "這個要花時間下載並寫入，請耐心等待，不要按很多次!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '好，我知道了！做吧!',
                cancelButtonText: '我按錯了！取消！'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#api_pull_form').submit();
                    Swal.fire(
                        '拉回資料中...',
                        '慢慢等吧...',
                        '好的'
                    )
                }else{
                    Swal.fire(
                        '取消',
                        '放心，什麼事也沒有發生的！',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection
