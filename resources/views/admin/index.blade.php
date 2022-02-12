@extends('layouts.admin_master')

@section('content')
<div class="content-wrapper">
  <div class="page-loading hidden">
      <img class="loading" src="{{asset('assets/admin/images/auth/loading.png')}}" alt="">
      <p style="font-size: 1.5rem;">Đang thực hiện...</p>
  </div>
  <div class="row">
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Danh sách Tài khoản</h4>
          <a href="{{route('admin.user')}}" class="btn btn-danger btn-lg btn-block">Truy cập
            <i class="mdi mdi-arrow-right float-right"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Thống kê lịch sử giao dịch</h4>
          <a href="{{route('admin.history')}}" class="btn btn-success btn-lg btn-block">Truy cập
            <i class="mdi mdi-arrow-right float-right"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Quản lý Gift Code</h4>
          <a href="{{route('admin.giftcode')}}" class="btn btn-warning btn-lg btn-block">Truy cập
            <i class="mdi mdi-arrow-right float-right"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Quản lý File upload</h4>
          <a href="{{route('admin.upload')}}" class="btn btn-success btn-lg btn-block">Truy cập
            <i class="mdi mdi-arrow-right float-right"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Quản lý Webshop</h4>
          <a href="{{route('admin.webshop')}}" class="btn btn-primary btn-lg btn-block">Truy cập
            <i class="mdi mdi-arrow-right float-right"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Quản lý tin tức</h4>
          <a href="{{route('admin.news')}}" class="btn btn-dark btn-lg btn-block">Truy cập
            <i class="mdi mdi-arrow-right float-right"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Hướng dẫn nạp tiền</h4>
          <a href="{{route('admin.huongDan')}}" class="btn btn-warning btn-lg btn-block">Truy cập
            <i class="mdi mdi-arrow-right float-right"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Website</h4>
          <a href="{{route('index')}}" class="btn btn-info btn-lg btn-block">Truy cập
            <i class="mdi mdi-arrow-right float-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection