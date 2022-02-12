@extends('layouts.admin_master')

@section('css')
<style>
    .table td img {
     width: 100px; 
    height: 100px;
    border-radius: 0; 

}
</style>
@endsection

@section('content')

<div class="content-wrapper">
    <div class="page-loading hidden">
        <img class="loading" src="{{asset('assets/admin/images/auth/loading.png')}}" alt="">
        <p style="font-size: 1.5rem;">Đang thực hiện...</p>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{route('admin.addNews')}}" class="btn btn-primary btn-icon-text">
                + Thêm mới tin tức                                                 
            </a>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Danh sách tin tức</h4>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung tóm tắt</th>
                        <th>Ảnh đại diện</th>
                        <th>Số lượt xem</th>
                        <th>Người đăng</th>
                        <th>Ngày/giờ đăng</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($news))
                    <?php $i = 1; ?>
                    @foreach ($news as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td style="width: 300px;"><p style="width: 250px;
                                overflow: hidden;
                                white-space: nowrap; 
                                text-overflow: ellipsis;">{{$item->title}}</p></td>
                            <td style="width: 200px;"><p style="width: 150px;
                                overflow: hidden;
                                white-space: nowrap; 
                                text-overflow: ellipsis;">{{$item->short_content}}</p></td>
                            <td style="width: 150px;"><img src="{{asset($item->image)}}" alt="{{$item->title}}" width="150"></td>
                            <td><span style="color: blue;">{{$item->view}}</span></td>
                            <td>{{$item->user->username}}</span></td>
                            <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                            <td>
                                <a href="{{route('admin.editNews', ['id' => $item->id])}}"  class="btn btn-warning">Sửa</a>
                                <a data-url="{{route('admin.deleteNews', ['id' => $item->id])}}"  class="btn btn-danger btnDelete">Xoá</a>
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