@extends('layouts.admin_master')

@section('content')

<div class="content-wrapper">
    <div class="page-loading hidden">
        <img class="loading" src="{{asset('assets/admin/images/auth/loading.png')}}" alt="">
        <p style="font-size: 1.5rem;">Đang thực hiện...</p>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{route('admin.addWebshop')}}" class="btn btn-primary btn-icon-text">
             + Thêm vật phẩm vào Webshop                                                 
            </a>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Danh sách file trên hệ thống</h4>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên vật phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá coin</th>
                        <th>Mô tả</th>
                        <th>Option trong game</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($webshop))
                    <?php $i = 1; ?>
                    @foreach ($webshop as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                {{$item->ten_vat_pham}}
                            </td>
                            <td>
                                <img src="{{asset($item->hinh_anh)}}" alt="{{$item->ten_vat_pham}}">
                            </td>
                            <td style="color: red;">
                                {{number_format($item->gia_coin)}}
                            </td>
                            <td style="max-width: 100px; word-wrap: break-word; overflow: hidden;">
                                {!!$item->chi_tiet_webshop!!}
                            </td>
                            <td style="max-width: 100px; word-wrap: break-word; overflow: hidden;">
                                {{$item->chi_tiet_game}}
                            </td>
                            <td>
                                <a href="{{route('admin.editWebshop', ['id'=>$item->id])}}"  class="btn btn-warning">Sửa</a>
                                <a data-url="{{route('admin.deleteWebshop', ['id'=>$item->id])}}" class="btn btn-danger btnDelete">Xoá</a>
                            </td>
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
@endsection


@section('js')
<script>
 
        $('.btnDelete').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Xác nhận',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Không',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.page-loading').removeClass('hidden');
                    var url = $(this).attr('data-url');
                    var type = 'POST';
                    $.ajax({
                        type: type,
                        url: url,
                        success: function (response) {
                            const {success} = response
                            if (success) {
                                $('.page-loading').addClass('hidden');
                                Swal.fire({
                                    title: "Xoá thành công",
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
                            $('.page-loading').addClass('hidden');
                            var errObj=jQuery.parseJSON(response.responseText)
                            Swal.fire({
                                title: "Lỗi!",
                                text: "Hãy liên hệ BQT để biết thêm chi tiết",
                                icon: "error",
                                showConfirmButton: true,
                            })
                        }
                    })
                }
            })
        });
  
</script>
@endsection