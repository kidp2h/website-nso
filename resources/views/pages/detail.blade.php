@extends('layouts.master')

@section('header')
<title>{{$news->title}}</title>
@endsection

@section('css')

@endsection

@section('content')

<div class="container">
    <div class="chuc-nang">
        <div class="title">
            <h3>TIN TỨC</h3>
        </div>
        
        <div class="content post">
            <div class="detail-title">
                <h3>{{$news->title}}</h3>
                <p>Ngày đăng: {{date('d-m-Y', strtotime($news->created_at))}}</p>
                <hr>
            </div>
            <div class="detail-content">
                {!! $news->content !!}
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@endsection

