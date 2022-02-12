@extends('layouts.admin_master')

@section('css')
<style>
    #cke_1_contents {
        min-height: 500px;
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
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form id="formUpdate">
                <h4 class="card-title">Hướng dẫn nạp tiền</h4>
                <textarea name="content" id="text" cols="30" rows="100">
                    {!! $data->content !!}
                </textarea>
                <script src={{ url('ckeditor/ckeditor.js') }}></script>
                <script>
                    
                    CKEDITOR.replace( 'text', {
                        filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
                    } );

                </script>
                <a id="update" data-url="{{route('admin.updateHuongDan')}}" class="btn btn-success me-2 mt-2">Cập nhật</a>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

@include('ckfinder::setup')
@endsection


@section('js')

<script>
    $(document).ready(function() {
        $('#update').click(function(e) {
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
                    var data = CKEDITOR.instances.text.getData();
                    $.ajax({
                        type: type,
                        url: url,
                        data: {
                            content: data,
                        },
                        success: function (response) {
                            const {success} = response
                            if (success) {
                                $('.page-loading').addClass('hidden');
                                Swal.fire({
                                    title: "Cập nhật thành công",
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
                                    text: "Hãy điền đẩy đủ các trường",
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
                }
            })
        });
    } );
</script>
@endsection