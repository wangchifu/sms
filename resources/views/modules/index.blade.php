@extends('layouts.master')

@section('page_title','模組管理')

@section('page_nav')
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item active" aria-current="page">模組管理</li>
        </ol>
    </nav>
@endsection

@section('content')    
    <div class="container">
        <div class="row">
            <h4>學校設定</h4>                  
            <table class="table table-striped">                
                <thead class="table-primary">
                    <tr>
                        <th>
                            出納印章
                        <?php
                        $school_code = school_code();
                        $seal2 = storage_path('app/privacy/'.$school_code.'/setups/seal2.png');
                        $seal3 = storage_path('app/privacy/'.$school_code.'/setups/seal3.png');
                        $seal4 = storage_path('app/privacy/'.$school_code.'/setups/seal4.png');
                        $path2 = 'setups&seal2.png';
                        $path3 = 'setups&seal3.png';
                        $path4 = 'setups&seal4.png';
                        ?>
                        @if(file_exists($seal2))
                            <img src="{{ route('getImg',$path2) }}" width="80"><a href="{{ route('module.del_name',$path2) }}" onclick="return confirm('刪除？')"><li class="fas fa-times-circle text-danger"></li></a>
                        @endif
                        </th>
                        <th>
                            主計印章
                        @if(file_exists($seal3))
                        <img src="{{ route('getImg',$path3) }}" width="80"><a href="{{ route('module.del_name',$path3) }}" onclick="return confirm('刪除？')"><li class="fas fa-times-circle text-danger"></li></a>
                        @endif
                        </th>
                        <th>
                            校長印章
                        @if(file_exists($seal4))
                        <img src="{{ route('getImg',$path4) }}" width="80"><a href="{{ route('module.del_name',$path4) }}" onclick="return confirm('刪除？')"><li class="fas fa-times-circle text-danger"></li></a>
                        @endif
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>                               
                <tbody>
                    <tr>
                        <form action="{{ route('module.store_name') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <td>
                            {{ Form::file('file2', ['class' => 'form-control']) }}
                        </td>
                        <td>
                            {{ Form::file('file3', ['class' => 'form-control']) }}
                        </td>
                        <td>
                            {{ Form::file('file4', ['class' => 'form-control']) }}
                        </td>
                        <td>
                            <button class="btn btn-sm btn-success">送出印章</button>
                        </td>
                        </form>      
                    </tr>
                </tbody>                        
            </table>                     

            <h4>模組資料</h4>
                <table class="table table-striped">
                    <thead class="table-primary">
                    <tr>
                        <th>
                            序號
                        </th>
                        <th>
                            模組名稱
                        </th>
                        <th>
                            設定
                        </th>
                        <th>
                            管理者們
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                全校系統管理 (school_admin)
                            </td>
                            <td>
                                <form action="{{ route('module.store') }}" method="post">
                                    @csrf
                                    <select name="user_id" class="form-control">
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="power_type" value="1">
                                    <input type="hidden" name="school_code" value="{{ auth()->user()->current_school_code }}">
                                    <input type="hidden" name="module" value="school_admin">
                                    <button class="btn btn-sm btn-success">新增</button>
                                </form>
                            </td>
                            <td>
                                @if(isset($power_data['school_admin']))
                                    @foreach($power_data['school_admin'] as $k=>$v)
                                        {{ $user_id2name[$k] }} <a href="#" onclick="sw_confirm('確定刪除？','{{ route('module.delete',$v) }}')"><i class="fas fa-times-circle text-danger"></i></a> ,
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                2
                            </td>
                            <td>
                                學生資料管理 (student_admin)
                            </td>
                            <td>
                                <form action="{{ route('module.store') }}" method="post">
                                    @csrf
                                    <select name="user_id" class="form-control">
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="power_type" value="1">
                                    <input type="hidden" name="school_code" value="{{ auth()->user()->current_school_code }}">
                                    <input type="hidden" name="module" value="student_admin">
                                    <button class="btn btn-sm btn-success">新增</button>
                                </form>
                            </td>
                            <td>
                                @if(isset($power_data['student_admin']))
                                    @foreach($power_data['student_admin'] as $k=>$v)
                                        {{ $user_id2name[$k] }} <a href="#" onclick="sw_confirm('確定刪除？','{{ route('module.delete',$v) }}')"><i class="fas fa-times-circle text-danger"></i></a> ,
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                3
                            </td>
                            <td>
                                午餐系統管理 (lunch_admin)
                            </td>
                            <td>
                                <form action="{{ route('module.store') }}" method="post">
                                    @csrf
                                    <select name="user_id" class="form-control">
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="power_type" value="1">
                                    <input type="hidden" name="school_code" value="{{ auth()->user()->current_school_code }}">
                                    <input type="hidden" name="module" value="lunch_admin">
                                    <button class="btn btn-sm btn-success">新增</button>
                                </form>
                            </td>
                            <td>
                                @if(isset($power_data['lunch_admin']))
                                    @foreach($power_data['lunch_admin'] as $k=>$v)
                                        {{ $user_id2name[$k] }} <a href="#" onclick="sw_confirm('確定刪除？','{{ route('module.delete',$v) }}')"><i class="fas fa-times-circle text-danger"></i></a> ,
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                4
                            </td>
                            <td>
                                社團報名系統管理 (club_admin)
                            </td>
                            <td>
                                <form action="{{ route('module.store') }}" method="post">
                                    @csrf
                                    <select name="user_id" class="form-control">
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="power_type" value="1">
                                    <input type="hidden" name="school_code" value="{{ auth()->user()->current_school_code }}">
                                    <input type="hidden" name="module" value="club_admin">
                                    <button class="btn btn-sm btn-success">新增</button>
                                </form>
                            </td>
                            <td>
                                @if(isset($power_data['club_admin']))
                                    @foreach($power_data['club_admin'] as $k=>$v)
                                        {{ $user_id2name[$k] }} <a href="#" onclick="sw_confirm('確定刪除？','{{ route('module.delete',$v) }}')"><i class="fas fa-times-circle text-danger"></i></a> ,
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>    
@endsection
