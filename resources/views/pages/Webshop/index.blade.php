@extends('layouts.master')

@section('header')
<title>Webshop</title>
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

<div class="container">
    <div class="chuc-nang">
        <div class="title">
            <h3>WEBSHOP</h3>
        </div>
        <p style="color: red; font-size: 1.2rem;">(*) Lưu ý: Để thực hiện mua vật phẩm tại Webshop, bạn cần phải <span style="font-weight: bold;">ĐĂNG XUẤT</span> trò chơi trước khi thực hiện mua.</p>
		<p style="color: red; font-size: 1.2rem;">(**) Tắt AUTO Reconnect khi ĐĂNG XUẤT, hoặc thoát hẳn giả lập, game để đảm bảo vật phẩm được thêm vào hành trang không bị lỗi mất đồ.</p>
		<p style="color: red; font-size: 1.2rem;">(***) Sau khi thông báo mua thành công, hãy đợi từ 5-10 giây để vật phẩm được thêm vào hành trang của bạn.</p>
        <div class="content">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card text-dark bg-light mb-3">
                        <div class="card-header bg-success"></div>
                        <div class="card-body">
                            <div class="table_wrapper">
                                <table class="table table-striped table-cus" style="width:100%">
                                    <thead>
                                        <tr>
                                            
                                            <th>Vật phẩm</th>
                                            <th>Hình ảnh</th>
                                            <th>Chi tiết</th>
                                            <th>Giá</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($webshop))
                                            @if(count($webshop) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($webshop as $item)
                                                    <tr>
                        
                                                        <td><span style="font-weight: bold;">{{$item->ten_vat_pham}}</span></td>
                                                        <td><img class="img-webshop" src="{{asset($item->hinh_anh)}}" alt="{{$item->ten_vat_pham}}" ></td>
                                                        <td>{!!$item->chi_tiet_webshop!!}</td>
                                                        <td style="font-weight: bold; color: red;">{{number_format($item->gia_coin)}} coin</td>
                                                        <td>
                                                            <a data-url="{{route('index.buyWebshop', ['id' => $item->id])}}" class="btn btn-success btn-sm btnBuy">Mua ngay</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6">Không có vật phẩm hiển thị</td>
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
</div>
@include('pages.modal_alert')
@endsection

@section('js')
<script>
   $(document).ready(function(e){
        $('#modal-alert').modal('show');
   })
    $('.btnBuy').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Xác nhận mua vật phẩm',
                icon: 'warning',
                text: 'Hãy chắc chắn bạn đã ĐĂNG XUẤT va THOÁT khỏi game trước khi thực hiện giao dịch.',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Không',
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = $(this).attr('data-url');
                    var type = 'POST';
                    $.ajax({
                        type: type,
                        url: url,
                        success: function (response) {
                            const {success, data} = response
                            if (success) {
                                Swal.fire({
                                    title: "Mua vật phẩm thành công",
                                    text: "Hãy đợi từ 5-10s để vật phẩm được thêm vào hành trang của bạn. Không nên đăng nhập vào ngay sau khi mua đồ",
                                    icon: "success",
                                    showConfirmButton: true,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload()
                                    }
                                })
                            }
                        },
                        error: function (response) {
                            var errObj=jQuery.parseJSON(response.responseText)
                            if(errObj.isOnline) {
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Tài khoản của bạn chưa ĐĂNG XUẤT khỏi game, vui lòng chắc chắn đã ĐĂNG XUẤT để thực hiện giao dịch",
                                    icon: "error",
                                    showConfirmButton: true,
                                })
                            }
                            else if(errObj.isCoin) {
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Bạn không có đủ COIN để mua vật phẩm. Hãy nạp thêm",
                                    icon: "error",
                                    showConfirmButton: true,
                                })
                            }
                            else if(errObj.ninja) {
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Bạn chưa tạo nhân vật, hoặc nhân vật không tồn tại",
                                    icon: "error",
                                    showConfirmButton: true,
                                })
                            } else if(errObj.isMaxBag) {
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Hành trang của bạn không đủ chỗ trống",
                                    icon: "error",
                                    showConfirmButton: true,
                                })
                            }else {
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Hãy liên hệ BQT để biết thêm chi tiết",
                                    icon: "error",
                                    showConfirmButton: true,
                                })
                            }
                        }
                    })
                }
            })
        });
</script>
@endsection

