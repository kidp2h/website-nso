@extends('layouts.master')

@section('header')
<title>Lịch sử giao dịch</title>
@endsection

@section('css')
<style>
    table, th, td {
        border: 1px solid #ccc;
        text-align: center;
    }
</style>
@endsection

@section('content')

<div class="container" style="max-width: 80%;">
    <div class="chuc-nang">
        <div class="title">
            <h3>LỊCH SỬ GIAO DỊCH</h3>
        </div>
        <div class="content">

            <p>
                <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                    Lịch sử nạp tiền MOMO
                </button>
                <button class="btn btn-default" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample5">
                    Lịch sử nạp thẻ điện thoại
                </button>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                    Lịch sử đổi coin
                </button>
                <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
                    Nạp coin qua Admin
                </button>
                <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample4">
                    Lịch sử mua vật phẩm Webshop
                </button>
            </p>
            <hr>
            <div class="collapse" id="collapseExample1">
                <div class="card text-light bg-light mb-3">
                    <div class="card-header bg-success">
                    </div>
                    <div class="card-body">
                        <div class="table_wrapper">
                            <table class="table table-striped table-cus" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã giao dịch</th>
                                        <th>Số tiền nạp</th>
                                        <th>Số Hồi ức coin nhận về</th>
                                        <th>Số coin trước khi nạp</th>
                                        <th>Số coin sau khi nạp</th>
                                        <th>Ngày/giờ thanh toán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($momo))
                                        @if(count($momo) > 0)
                                            <?php $i = 1; ?>
                                            @foreach ($momo as $item)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td style="color: red; font-weight: bold;">MM{{$item->id}}</td>
                                                    <td style=" font-weight: bold;">{{number_format($item->money)}} </td>
                                                    <td style=" font-weight: bold;">{{number_format($item->coin)}}</td>
                                                    <td style="font-weight: bold;">{{number_format($item->old_coin)}}</td>
                                                    <td style="font-weight: bold;">{{number_format($item->new_coin)}}</td>
                                                    <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th colspan="7">Không có dữ liệu</th>
                                            </tr>
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapseExample2">
                <div class="card text-light bg-light mb-3">
                    <div class="card-header bg-primary"> 
                    </div>
                    <div class="card-body">
                        <div class="table_wrapper">
                            <table class="table table-striped table-cus" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã giao dịch</th>
                                        <th>Số coin đổi</th>
                                        <th>Số coin cũ</th>
                                        <th>Số coin mới</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($doi_coin))
                                        @if(count($doi_coin) > 0)
                                            <?php $i = 1; ?>
                                            
                                            @foreach ($doi_coin as $item)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td style="color: red; font-weight: bold;">MDC{{$item->id}}</td>
                                                    <td>{{number_format($item->coin)}}</td>
                                                    <td>{{number_format($item->old_coin)}}</td>
                                                    <td>{{number_format($item->new_coin)}}</td>
                                                    <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th colspan="6">Không có dữ liệu</th>
                                            </tr>
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
            </div>
            <div class="collapse" id="collapseExample3">
                    <div class="card text-light bg-light mb-3">
                        <div class="card-header bg-danger">
                            
                        </div>
                        <div class="card-body">
                            <div class="table_wrapper">
                                <table class="table table-striped table-cus" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã giao dịch</th>
                                            <th>Số coin nạp</th>
                                            <th>Số coin cũ</th>
                                            <th>Số coin mới</th>
                                            <th>Ghi chú</th>
                                            <th>Thời gian nhận</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($coinAdmin))
                                            @if(count($coinAdmin) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($coinAdmin as $item)
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td style="color: red; font-weight: bold;">NCA{{$item->id}}</td>
                                                        <td>{{number_format($item->coin)}}</td>
                                                        <td>{{number_format($item->old_coin)}}</td>
                                                        <td>{{number_format($item->new_coin)}}</td>
                                                        <td>{{$item->desc}}</td>
                                                        <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th colspan="7">Không có dữ liệu</th>
                                                </tr>
                                            @endif
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
            </div>
            <div class="collapse" id="collapseExample4">
                <div class="card text-light bg-light mb-3">
                    <div class="card-header bg-dark">
                        
                    </div>
                    <div class="card-body">
                        <div class="table_wrapper">
                            <table class="table table-striped table-cus" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã giao dịch</th>
                                        <th>Tên vật phẩm</th>
                                        <th>Số coin</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($webshop))
                                        @if(count($webshop) > 0)
                                            <?php $i = 1; ?>
                                            @foreach ($webshop as $item)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td style="color: red; font-weight: bold;">WS{{$item->id}}</td>
                                                    <td>{{$item->ten_vat_pham}}</td>
                                                    <td style="color: red;">- {{number_format($item->coin)}} coin</td>
                                                    <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th colspan="4">Không có dữ liệu</th>
                                            </tr>
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
            </div>
            <div class="collapse" id="collapseExample5">
                <div class="card text-light bg-light mb-3">
                    <div class="card-header bg-default">
                        
                    </div>
                    <div class="card-body">
                        <div class="table_wrapper">
                            <table class="table table-striped table-cus" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã giao dịch</th>
                                        <th>Số coin nhận được</th>
                                        <th>Nhà mạng</th>
                                        <th>Mệnh giá</th>
                                        <th>Mã thẻ</th>
                                        <th>Số seri</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($napTien))
                                        @if(count($napTien) > 0)
                                            <?php $i = 1; ?>
                                            @foreach ($napTien as $item)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td style="color: red; font-weight: bold;">TDT{{$item->id}}</td>
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
                                        @else
                                            <tr>
                                                <th colspan="8">Không có dữ liệu</th>
                                            </tr>
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-thanh-toan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
</div>
@endsection

@section('js')

<script>
    $('#rePay').click(function(e) {
        e.preventDefault();
        var type = "GET"
        var url = $(this).attr('data-url')
        $.ajax({
            type: type,
            url: url,
            success: function (response) {
                const {success, modal} = response
                if (success && modal) {
                    $('#modal-thanh-toan').html(modal);
                    $('#modal-thanh-toan').modal('show');
                }
            },
            error: function (response) {
                var errObj=jQuery.parseJSON(response.responseText)
                if(errObj.checkId){
                    Swal.fire({
                        title: "Lỗi!",
                        text: "Giao dịch này không tồn tại",
                        icon: "error",
                        showConfirmButton: true,
                    })
                } 
                if(errObj.checkDay){
                    Swal.fire({
                        title: "Lỗi!",
                        text: "Giao dịch này đã quá hạn để thanh toán lại!",
                        icon: "error",
                        showConfirmButton: true,
                    })
                }
                else {
                    Swal.fire({
                        title: "Lỗi!",
                        text: "Hãy liên hệ BQT để biết thêm chi tiết",
                        icon: "error",
                        showConfirmButton: true,
                    })
                }
            }
        })
    })
</script>
@endsection

