@extends('layouts.master')

@section('page_title','Excel 匯入教學')

@section('page_subtitle')
    <a href="#" class="btn btn-secondary btn-sm" onclick="history.back();"><i class="fas fa-backward"></i> 返回</a>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <h3>設定參考</h3>
                方式1.<a href="{{ asset('student_list.xlsx') }}" class="btn btn-success btn-sm" target="_blank"><i class="fas fa-download"></i> 下載範本檔手填</a>
                <br>
                方式2.<a href="https://cloudschool.chc.edu.tw" target="_blank">cloudschool</a> > 註冊組  > 學生資料管理  >  報表列印  >  名冊輸出
                <br>
                依序選出欄位：<br>
                姓名<br>
                性別<br>
                生日(西元)<br>
                學號<br>
                年級(數字)<br>
                班序(數字)<br>
                座號<br>
                導師姓名<br>
                <a href="{{ asset('images/cloudschool/excel.png') }}" target="_blank"><img src="{{ asset('images/cloudschool/excel.png') }}" width="100%"></a>
            </div>
        </div>
    </div>
@endsection
