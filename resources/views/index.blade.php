@extends('layouts.master')

@section('page_title','歡迎光臨')

@section('card_title','說明')

@section('content')
    <div class="container">
        <div class="row">
            <figure class="figure col-xs-4 col-md-3 col-lg-2">
                <a href="{{ route('lunches.index') }}">
                <img src="{{ asset('images/logo/lunch.png') }}" class="figure-img img-fluid rounded" alt="...">
                </a>
                <figcaption class="figure-caption">午餐系統</figcaption>
            </figure>
            <figure class="figure col-xs-4 col-md-3 col-lg-2">
                <img src="{{ asset('images/logo/club.png') }}" class="gray figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption">社團報名系統</figcaption>
            </figure>
            <!--
            <figure class="figure col-xs-4 col-md-3 col-lg-2">
                <img src="{{ asset('images/logo/new_student.png') }}" class="gray figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption">新生編班系統</figcaption>
            </figure>
            <figure class="figure col-xs-4 col-md-3 col-lg-2">
                <img src="{{ asset('images/logo/sport_meeting.png') }}" class="gray figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption">運動會報名系統</figcaption>
            </figure>
            
            <figure class="figure col-xs-4 col-md-3 col-lg-2">
                <img src="{{ asset('images/logo/fix.png') }}" class="gray figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption">報修系統</figcaption>
            </figure>
            <figure class="figure col-xs-4 col-md-3 col-lg-2">
                <img src="{{ asset('images/logo/meeting.png') }}" class="gray figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption">會議文稿</figcaption>
            </figure>
            <figure class="figure col-xs-4 col-md-3 col-lg-2">
                <img src="{{ asset('images/logo/weekly_calendar.png') }}" class="gray figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption">校務行事週曆</figcaption>
            </figure>
            <figure class="figure col-xs-4 col-md-3 col-lg-2">
                <img src="{{ asset('images/logo/monthly_calendar.png') }}" class="gray grayfigure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption">校務月曆</figcaption>
            </figure>
            <figure class="figure col-xs-4 col-md-3 col-lg-2">
                <img src="{{ asset('images/logo/classroom.png') }}" class="gray figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption">教室預約</figcaption>
            </figure>
            <figure class="figure col-xs-4 col-md-3 col-lg-2">
                <img src="{{ asset('images/logo/task.png') }}" class="gray figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption">待辦事項</figcaption>
            </figure>
            <figure class="figure col-xs-4 col-md-3 col-lg-2">
                <img src="{{ asset('images/logo/blog.png') }}" class="gray figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption">校園部落格</figcaption>
            </figure>
        -->
        </div>
    </div>
@endsection
