@extends('layouts.master')

@section('header')
<title>Đăng ký</title>
@endsection

@section('css')
@endsection

@section('content')

<div class="container">
    <div class="form-login">
        <div class="title">
            <h3>ĐĂNG KÝ</h3>
        </div>
        <div class="content">
         <form id="formRegister">
             <div class="mb-3">
               <label for="username" class="form-label">Tài khoản:</label>
               <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tài khoản...">
               <div id="usernamelRegister" class="invalid-feedback"></div>
             </div>
             <div class="mb-3">
                 <label for="email" class="form-label">Email:</label>
                 <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email...">
                 <div id="emailRegister" class="invalid-feedback"></div>
             </div>
			 <div class="mb-3">
                 <label for="invite" class="form-label">Tài khoản giới thiệu (Nếu có) :</label>
                 <input type="text" class="form-control" id="invite" name="invite" placeholder="">
             </div>
             <div class="mb-3">
               <label for="password" class="form-label">Mật khẩu:</label>
               <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu...">
               <div id="passwordRegister" class="invalid-feedback"></div>
             </div>
             <div class="mb-3">
                 <label for="confirmPassword" class="form-label">Xác nhận mật khẩu:</label>
                 <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Xác nhận mật khẩu...">
                 <div id="confirmPasswordRegister" class="invalid-feedback"></div>
             </div>
             <p class="note"><i>(*) Lưu ý:</i> Nên sử dụng email thật, để sau này bạn có thể lấy lại mật khẩu tài khoản!</p>
             <a id="btnRegister" data-home="{{route('index.login')}}" data-url="{{route('index.register')}}" class="btn btn-nso btn-login"><i class="fa-solid fa-right-to-bracket"></i> Đăng ký</a>
         </form>
         <hr>
         <div class="info">
             <p>Bạn đã có tài khoản. Hãy <a href="{{route('index.login')}}">Đăng nhập</a></p>
         </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection