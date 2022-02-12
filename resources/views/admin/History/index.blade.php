@extends('layouts.admin_master')

@section('content')

<div class="content-wrapper">
    <div class="page-loading hidden">
        <img class="loading" src="{{asset('assets/admin/images/auth/loading.png')}}" alt="">
        <p style="font-size: 1.5rem;">Đang thực hiện...</p>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Thống kê giao dịch</h4>
              <p>TỔNG SỐ GIAO DỊCH: <span style="font-size: 1.1rem;color: orange;">{{number_format($count1)}}</span></p>
              <p>TỔNG SỐ TIỀN NẠP QUA MOMO: <span style="font-size: 1.1rem;color: orange;">{{number_format($count2)}} VNĐ</span></p>
              <p>TỔNG SỐ TIỀN NẠP THẺ ĐIỆN THOẠI: <span style="font-size: 1.1rem;color: orange;">{{number_format($count4)}} VNĐ</span></p>
              <p>TỔNG SỐ COIN GIAO DỊCH: <span style="font-size: 1.1rem;color: orange;">{{number_format($count3)}}</span></p>
              <hr>
              <p>Giao dịch nạp Momo: <span style="font-size: 1.1rem;color: red;">{{count($momo)}}</span></p>
              <p>Giao dịch nạp Thẻ điện thoại: <span style="font-size: 1.1rem;color: red;">{{count($naptien)}}</span></p>
              <p>Giao dịch nạp coin qua Admin: <span style="font-size: 1.1rem;color: green;">{{count($admin)}}</span></p>
              <p>Giao dịch đổi coin: <span style="font-size: 1.1rem;color: blue;">{{count($doiCoin)}}</span></p>
              <p>Giao dịch mua vật phẩm Webshop: <span style="font-size: 1.1rem;color: rgb(145, 111, 0);">{{count($webshop)}}</span></p>
        
            </div>
          </div>
        </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lịch sử nạp MOMO</h4>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã giao dịch</th>
                    <th>Tài khoản</th>
                    <th>Số điện thoại</th>
                    <th>Số tiền nạp</th>
                    <th>Số Hồi ức coin nhận về</th>
                    <th>Số coin trước khi nạp</th>
                    <th>Số coin sau khi nạp</th>
                    <th>Ngày/giờ thanh toán</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($momo))
                    <?php $i = 1; ?>
                        @foreach ($momo as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td style="color: red; font-weight: bold;">MM{{$item->id}}</td>
                                <td style="font-weight: bold;">{{$item->user ? $item->user->username : ''}}</td>
                                <td style="font-weight: bold;">{{$item->sdt}}</td>
                                <td>{{number_format($item->money)}} </td>
                                <td>{{number_format($item->coin)}}</td>
                                <td>{{number_format($item->old_coin)}}</td>
                                <td>{{number_format($item->new_coin)}}</td>
                                <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                            </tr>
                        @endforeach
                @endif
            </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lịch sử nạp The Dien Thoai</h4>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã giao dịch</th>
                    <th>Tài khoản</th>
                    <th>Số coin nhận được</th>
                    <th>Nhà mạng</th>
                    <th>Mệnh giá</th>
                    <th>Mã thẻ</th>
                    <th>Số seri</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($naptien))
                    <?php $i = 1; ?>
                        @foreach ($naptien as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td style="color: red; font-weight: bold;">TDT{{$item->id}}</td>
                                <td style="font-weight: bold;">{{$item->user ? $item->user->username : ''}}</td>
                                <td style="font-weight: bold;">{{number_format($item->so_tien)}} coin</td>
                                                    <td >{{$item->nha_mang}}</td>
                                                    <td >{{number_format($item->menh_gia)}}</td>
                                                    <td >{{$item->ma_the}}</td>
                                                    <td >{{$item->ma_seri}}</td>
                                                    <td>
                                                        @if($item->trang_thai == 0)
                                                            <span style="color: blue;">Đang chờ xử lý</span>
                                                        @elseif($item->trang_thai == 1)
                                                            <span style="color: green;">Thành công</span>
                                                        @elseif($item->trang_thai == 2)
                                                            <span style="color: orange;">Thẻ sai mệnh giá</span>
                                                        @elseif($item->trang_thai == 3)
                                                            <span style="color: red;">Không thành công</span>
                                                        @endif
                                                    </td>
                            </tr>
                        @endforeach
                @endif
            </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lịch sử nạp coin qua ADMIN</h4>
            <table id="example1" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã giao dịch</th>
                        <th>Tài khoản</th>
                        <th>Số coin nạp</th>
                        <th>Số coin cũ</th>
                        <th>Số coin mới</th>
                        <th>Ghi chú</th>
                        <th>Thời gian nhận</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($admin))
                       
                            <?php $i = 1; ?>
                            @foreach ($admin as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td style="color: red; font-weight: bold;">NCA{{$item->id}}</td>
                                    <td style="font-weight: bold;">{{$item->user ? $item->user->username : ''}}</td>
                                    <td>{{number_format($item->coin)}}</td>
                                    <td>{{number_format($item->old_coin)}}</td>
                                    <td>{{number_format($item->new_coin)}}</td>
                                    <td>{{$item->desc}}</td>
                                    <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                                </tr>
                            @endforeach
  
                    @endif
                </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lịch sử đổi coin</h4>
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã giao dịch</th>
                        <th>Tài khoản</th>
                        <th>Số coin đổi</th>
                        <th>Số coin cũ</th>
                        <th>Số coin mới</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($doiCoin))
                       
                            <?php $i = 1; ?>
                            
                            @foreach ($doiCoin as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td style="color: red; font-weight: bold;">MDC{{$item->id}}</td>
                                    <td style="font-weight: bold;">{{$item->user ? $item->user->username : ''}}</td>
                                    <td>{{number_format($item->coin)}}</td>
                                    <td>{{number_format($item->old_coin)}}</td>
                                    <td>{{number_format($item->new_coin)}}</td>
                                    <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                                </tr>
                            @endforeach

                    @endif
                </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lịch sử mua vật phẩm webshop</h4>
            <table id="example3" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã giao dịch</th>
                        <th>Tài khoản</th>
                        <th>Tên vật phẩm</th>
                        <th>Số coin</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($webshop))
                            <?php $i = 1; ?>
                            @foreach ($webshop as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td style="color: red; font-weight: bold;">WS{{$item->id}}</td>
                                    <td style="font-weight: bold;">{{$item->user ? $item->user->username : ''}}</td>
                                    <td>{{$item->ten_vat_pham}}</td>
                                    <td style="color: red;">- {{number_format($item->coin)}} coin</td>
                                    <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                                </tr>
                            @endforeach
                    @endif
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Modal -->

@endsection


@section('js')

@endsection