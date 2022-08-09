@extends('layouts.master_clean')

@section('page_title','歡迎光臨')

@section('card_title','關於本系統')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <figure class="figure col-xs-4 col-md-3 col-lg-2">
                <img src="{{ asset('images/logo/logo.svg') }}" class="figure-img img-fluid rounded" alt="...">
                <figcaption class="figure-caption">
                    <h4>彰化縣學校管理系統</h4>
                    <h5>School Management System</h5>
                    本系統為熱心作品，純為彰化縣國中小校務網頁化而努力。有需要使用的學校請聯絡資訊組長Line群 ET Wang。<br>
                    詳細功能請看youtube教學影片。<br>
                    <a href="{{ env('TEACH_YT') }}" target="_blank" class="btn btn-primary btn-sm">請點此</a>                
                </figcaption>
            </figure>            
        </div>
    </div>
@endsection
