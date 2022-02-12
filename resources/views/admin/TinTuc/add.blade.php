@extends('layouts.admin_master')
@section('css')
<style>
    #cke_1_contents {
        min-height: 400px;
    }

    .cus-card {
        position: relative;
    }

    .btn-add {
        position: absolute;
        bottom: 20px;
        width: 100%;
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
            <a href="{{route('admin.news')}}" class="btn btn-primary btn-icon-text">
                < Quay lại                                                
            </a>
        </div>
    </div>
    <form class="forms-sample" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Tiêu đề bài viết</h4>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề bài viết">
                <h4 class="card-title mt-4">Nội dung bài viết</h4>
                <textarea name="content" id="content" cols="30" rows="100">
                </textarea>
                <script src={{ url('ckeditor/ckeditor.js') }}></script>
                <script>
                    CKEDITOR.replace( 'content', {
                        filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
                    } );
                </script>
              </div>
            </div>
          </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body cus-card">
            <h4 class="card-title">Nội dung tóm tắt</h4>
            <textarea  class="form-control" id="short_content" name="short_content"></textarea>

            <h4 class="card-title mt-3">Hình ảnh đại diện</h4>
            <div class="row">
                <div class="col-md-12 mb-2"><input type="file" class="form-control" id="file" name="file"></div>
                <div class="col-md-12"><img id="blah" src="" alt="" width="300" height="300" /></div>
            </div>
            <div class="btn-add">
                <a id="addNews" style="width: 100%;" data-url="{{route('admin.postNews')}}" class="btn btn-success me-2">Đăng tải</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>
</div>
@endsection


@section('js')
<script>
 
        $("#file").change(function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        $('#addNews').click(function(e) {
            e.preventDefault();
            $('.page-loading').removeClass('hidden');
            var url = $(this).attr('data-url');
            var type = 'POST';
            var title = $('#title').val()
            var content = CKEDITOR.instances.content.getData();
            var short_content = $('textarea#short_content').val()
            var image = $('#file')[0].files[0];
          
            var data = new FormData();
            data.append('image',image);
            data.append('title',title);
            data.append('content',content);
            data.append('short_content',short_content);

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
                            title: "Đăng bài viết thành công",
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
                        const {content, title, short_content, image} = errObj.errors
                        if(content) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: content,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        } 
                        if(title) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: title,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        }
                        if(short_content) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: short_content,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        }if(image) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: image,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        }
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
        });

        
   
</script>
@endsection