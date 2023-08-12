@extends('layouts.master_clean')

@section('page_title','社團報名系統')

@section('content')
@include('clubs.parents_nav')
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card">
            <div class="card-body">
                <br>
                <br>                
                <ul class="nav">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#" onclick="alert('hi')">你是 {{ $user->student_year }}年{{ $user->student_class }}班{{ $user->num }}號 {{ $user->name }}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link btn btn-warning btn-sm" href="{{ route('clubs.change_pwd',$class_id) }}">更換密碼</a>
                    </li>
                    <li><a class="nav-item">　</a></li>
                    <li class="nav-item">
                      <a class="nav-link btn btn-danger btn-sm" href="{{ route('clubs.parents_logout') }}" onclick="return confirm('確定登出？')">登出</a>
                    </li>
                </ul>
                <h1>報名資訊</h1>                    
                <a class="btn btn-secondary btn-sm" href="{{ route('clubs.parents_do',$class_id) }}"><i class="fas fa-backward"></i> 返回</a>
            <div class="card">
                <div class="card-header">
                <h4>
                    {{ $user->semester }} {{ $club->name }} 報名資訊
                </h4>
                    <?php
                    $taking = $club->taking;
                    $prepare = $club->prepare;
                    ?>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>
                                順位
                            </th>
                            <th>
                                班級座號
                            </th>
                            <th>
                                姓名
                            </th>
                            <th>
                                報名時間
                            </th>
                        </tr>
                        <?php
                            $i=1;
                            $j=1;
                        ?>
                        @foreach($club_registers as $club_register)
                            @if($i <= $taking)
                                <tr>
                            @endif
                            @if($i > $taking and $j <= $prepare)
                                <tr class="bg-info">
                            @endif
                                <td>
                                    @if($i <= $taking)
                                        正取{{ $i }}
                                    @endif
                                    @if($i > $taking and $j <= $prepare)
                                        候補{{ $j }}
                                        <?php $j++; ?>
                                    @endif
                                </td>
                                <td>
                                    {{ $club_register->user->class_num }}
                                </td>
                                <td>
                                    {{ $club_register->user->name }}
                                </td>
                                <td>
                                    {{ $club_register->created_at }}
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </table>
                </div>
            </div>
            </div>
            
            </div>
        </div>
    </div>
@endsection
