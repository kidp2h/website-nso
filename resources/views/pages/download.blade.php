@extends('layouts.master')

@section('header')
<title>Tải game</title>
@endsection

@section('css')
@endsection

@section('content')

<div class="container">
    <div class="chuc-nang">
        <div class="title">
            <h3>TẢI GAME</h3>
        </div>
        <div class="content">
            <div class="news">
                @if(isset($file))
                @foreach ($file as $item)
                    <a href="{{$item->link}}" class="btn btn-success btn-login">{{$item->name}}</a>
                    <hr>
                @endforeach
            @endif
            </div>
           
        </div>
    </div>
</div>

@endsection

@section('js')
@endsection

