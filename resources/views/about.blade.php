@extends('layouts.master')

@section('page_title','歡迎光臨')

@section('card_title','關於本系統')

@section('content')
    <div class="container">
        <div class="row">
            本系統為熱心作品，純為彰化縣國中小校務網頁化而努力。有需要使用的學校請聯絡資訊組長Line群 ET Wang。<br>
            詳細功能請看youtube教學影片。<a href="{{ env('TEACH_YT') }}" target="_blank" class="btn btn-primary btn-sm">請點此</a>
        </div>
    </div>
@endsection
