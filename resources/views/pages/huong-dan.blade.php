@extends('layouts.master')

@section('header')
<title>Chức năng</title>
@endsection

@section('css')

@endsection

@section('content')

<div class="container">
    <div class="chuc-nang">
        <div class="title">
            <h3>HƯỚNG DẪN NẠP TIỀN</h3>
        </div>
        <div class="content post">
          {!! $data->content !!}
        </div>
    </div>
</div>

@endsection

@section('js')
@endsection

