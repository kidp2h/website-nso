@extends('layouts.master')

@section('header')
<title>Đăng nhập</title>
@endsection

@section('css')
@endsection

@section('content')

<div class="container">
    <div class="form-login">
        <div class="title">
            <h3>ĐĂNG NHẬP</h3>
        </div>
        <div class="content">
         <form id="formLogin">
             <div class="mb-3">
               <label for="username" class="form-label">Tài khoản:</label>
               <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tài khoản...">
               <div id="usernamelLogin" class="invalid-feedback"></div>
             </div>
             <div class="mb-3">
               <label for="password" class="form-label">Mật khẩu:</label>
               <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu...">
               <div id="passwordLogin" class="invalid-feedback"></div>
             </div>
             <a id="btnLogin" data-url="{{route('auth.login')}}" data-home="{{route('index.profile')}}" class="btn btn-nso btn-login"><i class="fa-solid fa-right-to-bracket"></i> Đăng nhập</a>
         </form>
         <hr>
         <div class="info">
             <a href="#" class="update-info">Quên mật khẩu?</a>
             <p>Bạn chưa có tài khoản. Hãy <a href="{{route('index.register')}}">Đăng ký</a></p>
         </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection