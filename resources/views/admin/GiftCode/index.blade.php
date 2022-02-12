@extends('layouts.admin_master')

@section('css')

@endsection

@section('content')

<div class="content-wrapper">
    <div class="page-loading">
        <img class="loading" src="{{asset('assets/admin/images/auth/loading.png')}}" alt="">
        <p style="font-size: 1.5rem;">Đang thực hiện...</p>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{route('admin.addCode')}}" class="btn btn-primary btn-icon-text">
                + Thêm mới Gift Code                                                
            </a>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Danh sách GiftCode</h4>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Gift Code</th>
                        <th>Danh sách Item</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th>Hạn sử dụng trang bị</th>
                        <th>Giới hạn người nhận</th>
                        <th>Thời gian sử dụng code</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($giftcode))
                    <?php $i = 1; ?>
                    @foreach ($giftcode as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->code}}</td>
                            <td ><p style="white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100px;">{{str_replace('","',', ', trim($item->item_id, '[""]'))}}</p></td>
                            <td ><p style="white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100px;">{{str_replace('","',', ', trim($item->item_quantity, '[""]'))}}</p></td>
                            <td ><p style="white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100px;">{{str_replace('","',', ', trim($item->item_isLock, '[""]'))}}</p></td>
                            <td ><p style="white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100px;">{{str_replace('","',', ', trim($item->item_expires, '[""]'))}}</p></td>
                            <td > <p style="white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 200px;">{{str_replace('","',', ', trim($item->player, '[""]'))}}</p> </td>
                            <td>{{$item->time ? date("d-m-Y H:m:s", strtotime($item->time)) : ''}}</td>
                            <td>
                                <a href="{{route('admin.editCode', ['id' => $item->id])}}"  class="btn btn-warning">Sửa</a>
                                <a data-url="{{route('admin.deleteCode', ['id' => $item->id])}}"  class="btn btn-danger btnDelete">Xoá</a>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
</div>

@endsection


@section('js')
<script>
    jQuery(window).on("load", function(){
        $('.page-loading').addClass('hidden');
    });
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