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
            <h3>CHỨC NĂNG</h3>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="card">
                        <img height="220" src="{{asset('assets/images/momo.jpg')}}" class="card-img-top" alt="Momo">
                        <div class="card-body">
                          <h5 class="card-title">Nạp tiền MOMO</h5>
                          <p class="card-text">Nạp tiền qua MOMO</p>
                          <p class="card-text">Thời gian thanh toán 1-3 phút</p>
                          <hr>
                          <a href="{{route('index.huongDan')}}" class="btn btn-success" style="float: left;"><i class="fas fa-book-open"></i> Hướng dẫn nạp tiền</a>
                          <a href="{{route('index.checkout')}}" class="btn btn-nso" style="float: right;"><i class="fas fa-money-bill-wave"></i> Nạp tiền</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="card">
                        <img height="220" src="{{asset('assets/images/the-dien-thoai.jpg')}}" class="card-img-top" alt="Thẻ điện thoại">
                        <div class="card-body">
                          <h5 class="card-title">Nạp thẻ cào</h5>
                          <p class="card-text">Nạp tiền qua thẻ điện thoại</p>
                          <p class="card-text">Thời gian thanh toán 2-5 phút</p>
                          <hr>
                          <a href="{{route('index.huongDan')}}" class="btn btn-success" style="float: left;"><i class="fas fa-book-open"></i> Hướng dẫn nạp tiền</a>
                          <a href="{{route('index.theDienThoai')}}" class="btn btn-nso" style="float: right;"><i class="fas fa-money-bill-wave"></i> Nạp tiền</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="card">
                        <img height="220" src="{{asset('assets/images/webshop.png')}}" class="card-img-top" alt="Webshop">
                        <div class="card-body">
                        <h5 class="card-title">Webshop</h5>
                        <p class="card-text">Mua vật phẩm trong game.</p>
                        <p class="card-text">Giá siêu rẻ!</p>
                        <hr>
                        <a href="{{route('index.webshop')}}" class="btn btn-nso" style="float: right;"><i class="fas fa-arrow-circle-right"></i> Truy cập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.modal_alert')
@endsection

@section('js')
<script>
    $(document).ready(function() {

        $('#modal-alert').modal('show');

 
    })
</script>
@endsection

