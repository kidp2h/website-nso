@extends('layouts.admin_master')

@section('content')

<div class="content-wrapper">
    <div class="page-loading hidden">
        <img class="loading" src="{{asset('assets/admin/images/auth/loading.png')}}" alt="">
        <p style="font-size: 1.5rem;">Đang thực hiện...</p>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{route('admin.upload')}}" class="btn btn-primary btn-icon-text">
                < Quay lại                                                
            </a>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Sửa file</h4>
            <form class="forms-sample" id="formEdit" enctype="multipart/form-data">
                <div class="form-add-file">
                    <div class="form-group">
                    <label for="name">Tên file</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên file..." value="{{$file->name}}">
                    </div>
                    <div class="form-group">
                        <label>Chọn loại file</label>
                        <select class="form-control" name="type">
                        <option value="" disabled selected>--- Chọn loại file ---</option>
                        <option value="0" @if($file->type == 0) selected @endif>File TXT</option>
                        <option value="1" @if($file->type == 1) selected @endif>File JAR</option>
                        <option value="2" @if($file->type == 2) selected @endif>File APK</option>
                        <option value="3" @if($file->type == 3) selected @endif>File ZIP</option>
                        </select>
                    </div>
                </div>
                <a id="editFile" data-url="{{route('admin.postEdit', ['id' => $file->id])}}" class="btn btn-success me-2">Sửa file</a>

              </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection


@section('js')
<script>
    
        $('#editFile').click(function(e) {
            e.preventDefault();
            $('.page-loading').removeClass('hidden');
            var url = $(this).attr('data-url');
            var type = 'POST';
            var data = $("#formEdit").serialize();
            $.ajax({
                type: type,
                url: url,
                data: data,
                success: function (response) {
                    const {success} = response
                    if (success) {
                        $('.page-loading').addClass('hidden');
                        Swal.fire({
                            title: "Sửa thành công",
                            icon: "success",
                            showConfirmButton: true,
                        })
                    }
                },
                error: function (response) {
                    $('.page-loading').addClass('hidden');
                    var errObj=jQuery.parseJSON(response.responseText)
                    if(errObj.errors) {
                        Swal.fire({
                            title: "Lỗi!",
                            text: "Hãy nhập đẩy đủ thông tin file",
                            icon: "error",
                            showConfirmButton: true,
                        })
                    } else {
                        Swal.fire({
                        title: "Lỗi!",
                        text: "Hãy liên hệ BQT để biết thêm chi tiết",
                        icon: "error",
                        showConfirmButton: true,
                    })
                    }
                    
                }
            })
        });

        
   
</script>
@endsection