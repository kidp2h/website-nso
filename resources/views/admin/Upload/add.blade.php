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
            <h4 class="card-title">upload file</h4>
            <form class="forms-sample" id="formAdd" enctype="multipart/form-data">
                <div class="form-add-file">

                    <div class="form-group">
                    <label for="name">Tên file</label>
                    <input type="text" class="form-control" id="name" name="name[]" placeholder="Nhập tên file...">
                    </div>
                    <div class="form-group">
                        <label>Chọn loại file</label>
                        <select class="form-control" name="type[]">
                        <option value="" disabled selected>--- Chọn loại file ---</option>
                        <option value="0">File TXT</option>
                        <option value="1">File JAR</option>
                        <option value="2">File APK</option>
                        <option value="3">File ZIP</option>
                        </select>
                    </div>
                    <label for="name">Chọn file</label>
                    <input type="file" class="form-control" id="file" name="file[]">
                    <hr>
                </div>
                <a id="addFile" data-url="{{route('admin.postUpload')}}" class="btn btn-success me-2">Upload</a>

            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection


@section('js')
<script>
   
        i = 1;
        $('#add').click(function(e) {
            i++;
            e.preventDefault();
            html = `<h3>File ${i}</h3>
                    <div class="form-group">
                    <label for="name">Tên file</label>
                    <input type="text" class="form-control" id="name" name="name[]" placeholder="Nhập tên file...">
                    </div>
                    <div class="form-group">
                        <label>Chọn loại file</label>
                        <select class="form-control" name="type[]">
                        <option value="" disabled selected>--- Chọn loại file ---</option>
                        <option value="0">File TXT</option>
                        <option value="1">File JAR</option>
                        <option value="2">File APK</option>
                        <option value="3">File ZIP</option>
                        </select>
                    </div>
                    label for="name">Chọn file</label>
                    <input type="file" class="form-control" id="file" name="file[]">
                    <hr>`  
            $('.form-add-file').append(html)         
        });

        $('#addFile').click(function(e) {
            e.preventDefault();
            $('.page-loading').removeClass('hidden');
            var url = $(this).attr('data-url');
            var type = 'POST';
            //var data = $("#formAdd").serialize();

            var data = new FormData();
            //Form data
            var form_data = $('#formAdd').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            //File data
            var file_data = $('input[name="file[]"]')[0].files;
            for (var i = 0; i < file_data.length; i++) {
                data.append("file[]", file_data[i]);
            }
            
            $.ajax({
                type: type,
                url: url,
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: data,
                success: function (response) {
                    const {success} = response
                    if (success) {
                        $('.page-loading').addClass('hidden');
                        Swal.fire({
                            title: "Upload file hoàn tất",
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