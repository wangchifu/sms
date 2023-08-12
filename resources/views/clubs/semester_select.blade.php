@extends('layouts.master_clean')

@section('page_title','社團報名系統')

@section('content')
@include('clubs.parents_nav')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <br>
                <br>                
                <h1>社團報名</h1>
                <div class="card">
                    <div class="card-body">
                    @foreach($club_semesters as $club_semester)
                        <?php
                            $check_club1 = \App\Models\Club::where('semester',$club_semester->semester)->where('class_id','1')->get();
                            $check_club2 = \App\Models\Club::where('semester',$club_semester->semester)->where('class_id','2')->get();
                        ?>
                        @if(date('YmdHi') >= str_replace('-','',$club_semester->start_date) and date('YmdHi') <= str_replace('-','',$club_semester->stop_date))
                            <a href="{{ route('clubs.parents_login',['semester'=>$club_semester->semester,'class_id'=>'1']) }}" class="btn btn-primary">{{ $club_semester->semester }} 學期「學生特色社團」報名</a><br>
                            <small>報名時間：({{ $club_semester->start_date }} ~ {{ $club_semester->stop_date }})</small>
                        @else
                            @if(count($check_club1) >0)
                            <span class="btn btn-secondary disabled">{{ $club_semester->semester }} 學期「學生特色社團」報名</span><br>
                            <small>報名時間：({{ $club_semester->start_date }} ~ {{ $club_semester->stop_date }})</small>
                            @endif
                        @endif
                        @if(date('YmdHi') >= str_replace('-','',$club_semester->start_date2) and date('YmdHi') <= str_replace('-','',$club_semester->stop_date2) and count($check_club1) >0)
                            <hr>
                            <a href="{{ route('clubs.parents_login',['semester'=>$club_semester->semester,'class_id'=>'2']) }}" class="btn btn-primary">{{ $club_semester->semester }} 學期「學生課後活動」報名</a><br>
                            <small>報名時間：({{ $club_semester->start_date2 }} ~ {{ $club_semester->stop_date2 }})</small>
                        @else
                            @if(count($check_club2) >0)
                            <hr>
                            <span class="btn btn-secondary disabled">{{ $club_semester->semester }} 學期「學生課後活動」報名</span><br>
                            <small>報名時間：({{ $club_semester->start_date2 }} ~ {{ $club_semester->stop_date2 }})</small>
                            @endif
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
