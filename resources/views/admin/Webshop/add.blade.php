@extends('layouts.admin_master')

@section('content')

<div class="content-wrapper">
    <div class="page-loading hidden">
        <img class="loading" src="{{asset('assets/admin/images/auth/loading.png')}}" alt="">
        <p style="font-size: 1.5rem;">Đang thực hiện...</p>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{route('admin.webshop')}}" class="btn btn-primary btn-icon-text">
                < Quay lại                                                
            </a>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Thêm vật phẩm Webshop</h4>
            <form class="forms-sample" id="formAdd" enctype="multipart/form-data">
                <div class="form-add-file">

                    <div class="form-group">
                        <label for="ten_vat_pham">Tên vật phẩm</label>
                        <input type="text" class="form-control" id="ten_vat_pham" name="ten_vat_pham" placeholder="Nhập tên vật phẩm...">
                    </div>
                    <div class="form-group">
                        <label for="hinh_anh">Hình ảnh</label>
                        <input type="file" class="form-control" id="hinh_anh" name="hinh_anh">
                    </div>
                    <div class="form-group">
                        <label for="gia_coin">Giá coin</label>
                        <input type="number" class="form-control" id="gia_coin" name="gia_coin">
                    </div>
                    <div class="form-group">
                        <label for="chi_tiet_game">Option trong game</label>
                        <span style="color: blue;">vd: {"isLock":true,"expires":432000000,"sale":0,"quantity":1,"upgrade":0,"id":407,"sys":0,"isExpires":true,"option":[{"id":58,"param":20},{"id":6,"param":1000}]}</span>
                        <input type="text" class="form-control" id="chi_tiet_game" name="chi_tiet_game" placeholder="vd: ">
                    </div>
                    <div class="form-group">
                        <label for="chi_tiet_webshop">Mô tả</label>
                        <textarea name="chi_tiet_webshop" id="content" cols="30" rows="100">
                        </textarea>
                        <script src={{ url('ckeditor/ckeditor.js') }}></script>
                        <script>
                            CKEDITOR.replace( 'content', {
                                filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
                            } );
                        </script>
                    </div>
                    <hr>
                </div>
                <a id="addWebshop" data-url="{{route('admin.postAddWebshop')}}" class="btn btn-success me-2">Thêm mới</a>

              </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection


@section('js')
<script>
   
   $('#addWebshop').click(function(e) {
            e.preventDefault();
            $('.page-loading').removeClass('hidden');
            var url = $(this).attr('data-url');
            var type = 'POST';
            var ten_vat_pham = $('#ten_vat_pham').val()
            var content = CKEDITOR.instances.content.getData();
            var gia_coin = $('#gia_coin').val()
            var chi_tiet_game = $('#chi_tiet_game').val()
            var image = $('#hinh_anh')[0].files[0];
          
            var data = new FormData();
            data.append('ten_vat_pham',ten_vat_pham);
            data.append('gia_coin',gia_coin);
            data.append('chi_tiet_webshop',content);
            data.append('chi_tiet_game',chi_tiet_game);
            data.append('hinh_anh',image);

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
                            title: "Thêm mới thành công",
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
                        const {ten_vat_pham, gia_coin, chi_tiet_webshop, chi_tiet_game, hinh_anh} = errObj.errors
                        if(ten_vat_pham) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: ten_vat_pham,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        } 
                        if(gia_coin) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: gia_coin,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        }
                        if(chi_tiet_webshop) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: chi_tiet_webshop,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        }if(chi_tiet_game) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: chi_tiet_game,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        }if(hinh_anh) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: hinh_anh,
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