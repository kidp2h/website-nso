@extends('layouts.admin_master')

@section('content')

<div class="content-wrapper">
    <div class="page-loading hidden">
        <img class="loading" src="{{asset('assets/admin/images/auth/loading.png')}}" alt="">
        <p style="font-size: 1.5rem;">Đang thực hiện...</p>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{route('admin.addUpload')}}" class="btn btn-primary btn-icon-text">
             + Thêm file mới                                                  
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
                        <th>Kiểu file</th>
                        <th>Tên file</th>
                        <th>Đường dẫn</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($file))
                    <?php $i = 1; ?>
                    @foreach ($file as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                @if($item->type==0)
                                    <span>File TXT</span>
                                @elseif($item->type==1)
                                    <span style="color: red;">File JAR</span>
                                @elseif($item->type==2)
                                    <span style="color: green;">File APK</span>
                                @elseif($item->type==3)
                                    <span style="color: blue;">File ZIP</span>
                                @endif
                            </td>
                            <td>
                                {{$item->name}}
                            </td>
                            <td>
                                <a href="{{asset($item->link)}}">{{asset($item->link)}}</a>
                            </td>
                            <td>
                                <a href="{{route('admin.editUpload', ['id'=>$item->id])}}"  class="btn btn-warning">Sửa</a>
                                <a data-url="{{route('admin.deleteUpload', ['id'=>$item->id])}}" class="btn btn-danger btnDelete">Xoá</a>
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