@extends('layouts.master_clean')

@section('page_title','社團報名系統')

@section('content')
@include('clubs.parents_nav')
<div class="row justify-content-center">
    @if(empty(session('parents')))
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <br>
                    <br>                
                    <h1>社團報名-學生登入頁面</h1>                    
                    <form method="POST" action="{{ route('clubs.do_login') }}">
                        <input type="hidden" name="semester" value="{{ $semester }}">
                        @csrf
                        <div class="form-group row">
                            <label for="class_num" class="col-sm-4 col-form-label text-md-right">帳號 (班級座號5碼，如一年1班1號為10101)</label>

                            <div class="col-md-6">
                                <input id="class_num" type="text" class="form-control" maxlength="5" name="class_num" value="{{ old('class_num') }}" required autofocus>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <label for="pwd" class="col-md-4 col-form-label text-md-right">密碼 (預設生日8碼)</label>

                            <div class="col-md-6">
                                <input id="pwd" type="password" class="form-control" name="pwd" required>
                            </div>
                        </div>
                        <input type="hidden" name="class_id" value="{{ $class_id }}">
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-sign-in-alt"></i> 登入
                                </button>
            </div>
            </div>
                        @include('layouts.errors')
                    </form>
                </div>
            </div>
        </div>
    @else
        <script>
            document.location.href="{{ route('clubs.parents_do',$class_id) }}";
        </script>
    @endif
</div>
@endsection
