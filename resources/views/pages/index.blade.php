@extends('layouts.master')

@section('header')
<title>NSO Hồi Ức Tgame</title>
@endsection

@section('css')
@endsection

@section('content')
<div class="container">
    <div class="slider">
     <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
         <div class="carousel-indicators">
           <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
           <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
           <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
         </div>
         <div class="carousel-inner">
           <div class="carousel-item active">
             <img src="{{asset('assets/images/banner1.png')}}" class="d-block w-100" alt="banner1">
           </div>
           <div class="carousel-item">
             <img src="{{asset('assets/images/banner3.png')}}" class="d-block w-100" alt="banner3">
           </div>
           <div class="carousel-item">
             <img src="{{asset('assets/images/banner2.png')}}" class="d-block w-100" alt="banner2">
           </div>
         </div>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
           <span class="carousel-control-prev-icon" aria-hidden="true"></span>
           <span class="visually-hidden">Previous</span>
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
           <span class="carousel-control-next-icon" aria-hidden="true"></span>
           <span class="visually-hidden">Next</span>
         </button>
       </div>
    </div>
    <div class="welcome">
         <div class="title">
             <h3>CHÀO MỪNG CÁC BẠN ĐẾN VỚI NSO HỒI ỨC TGAME</h3>
         </div>
         <div class="content">
             <p class="mark">- SERVER NÀY KHÔNG DO ĐỘI NGŨ TGAME PHÁT TRIỂN VÀ VẬN HÀNH!</p>
             <p>- Server này do những người chơi tâm huyết với bản Gốc cũng như server Tgame, mở ra với mục đích mong muốn giúp AE tìm lại cảm giác chơi lại tựa game này bên server Tgame khi chưa đòng cửa.</p>
             <p>- Các chức năng của server đã được xây dựng <span class="mark">GIỐNG 99% TGAME</span></p>
             <p>- Các chức năng như <span class="mark">Gia tộc chiến, Nhiệm vụ, Nhiệm vụ danh vọng, Mắt,...</span> sẽ sớm được cập nhật nếu đông đảo người chơi có nhu cầu!</p>
             <p>- Server nói <span class="mark">KHÔNG</span> với <span class="mark">CHỈ SỐ ẢO</span>, các chỉ số như Damage, HP, MP, hiệu ứng item, hiệu ứng skill,... đã được cập nhật giống bản gốc nhất có thể!</p>
             <p>- Các vấn đề liên quan tới <span class="mark">Game, Báo lỗi, Góp ý, Thông báo</span> từ server bạn có thể xem tại <a href="{{route('index.news')}}">Tin tức</a> | <a href="https://www.facebook.com/groups/386056276488774/">Group</a> | <a href="https://zalo.me/g/kmaieh025">Box Zalo</a></p>
             <br>
             <p><span class="italicized">** Server này do những người am hiểu nhất về từng chỉ số của game Ninja School phát triển và vận hành...</span></p>
         </div>
         <hr>
         <div class="title">
             <h3>LỐI TẮT</h3>
         </div>
         <div class="content">
            <div class="shortcut">
                <a href="{{route('index.news')}}" class="btn btn-nso"><i class="fas fa-bell"></i> TIN TỨC</a>
                @if(Auth::check())
                  <a href="{{route('index.profile')}}" class="btn btn-nso"><i class="fa-solid fa-circle-info"></i> Thông tin tài khoản</a>
                  <a href="{{route('index.chucnang')}}" class="btn btn-nso"><i class="fas fa-money-check-alt"></i> Nạp tiền</a>
                  <a href="{{route('index.webshop')}}" class="btn btn-nso"><i class="fas fa-shopping-cart"></i> Webshop</a>
                @else
                  <a href="{{route('index.login')}}" class="btn btn-nso"><i class="fa-solid fa-right-to-bracket"></i> ĐĂNG NHẬP</a>
                  <a href="{{route('index.register')}}" class="btn btn-nso"><i class="fa-solid fa-user-plus"></i> ĐĂNG KÝ</a>
                @endif
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