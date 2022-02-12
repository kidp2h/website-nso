@extends('layouts.master')

@section('header')
<title>404</title>
@endsection

@section('css')
@endsection

@section('content')
<div class="container">
    <div class="welcome">
         <div class="title">
             <h3 style="font-size: 6rem;">404</h3>
         </div>
         <div class="content">
             <p class="mark" style="font-size: 3rem; text-align: center;">TRANG WEB NÀY KHÔNG TỒN TẠI</p>
         </div>
         <hr>
         <div class="title">
             <h3>LỐI TẮT</h3>
         </div>
         <div class="content">
            <div class="shortcut">
                <a href="{{route('index.login')}}" class="btn btn-nso"><i class="fa-solid fa-right-to-bracket"></i> ĐĂNG NHẬP</a>
                <a href="{{route('index.register')}}" class="btn btn-nso"><i class="fa-solid fa-user-plus"></i> ĐĂNG KÝ</a>
                <a href="{{route('index.download')}}" class="btn btn-nso"><i class="fa-solid fa-download"></i> TẢI GAME</a>
                <a href="https://www.facebook.com/groups/386056276488774/" class="btn btn-primary"><i class="fa-solid fa-users"></i> GROUP FACEBOOK</a>
				<a href="https://zalo.me/g/kmaieh025" class="btn btn-primary"><i class="fa-solid fa-users"></i> BOX ZALO</a>
            </div>
         </div>
    </div>
</div>
@endsection

@section('js')
@endsection