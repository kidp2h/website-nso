@extends('layouts.admin_master')

@section('content')

<div class="content-wrapper">
    <div class="page-loading hidden">
        <img class="loading" src="{{asset('assets/admin/images/auth/loading.png')}}" alt="">
        <p style="font-size: 1.5rem;">Đang thực hiện...</p>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{route('admin.giftcode')}}" class="btn btn-primary btn-icon-text">
                < Quay lại                                                
            </a>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Thêm mới Gift Code</h4>
            <form class="forms-sample" id="formAddCode" enctype="multipart/form-data">
                <div class="form-add-file">
                    <div class="form-group">
                        <label for="code">Gift Code</label>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="code" name="code" placeholder="Nhập gift code...">
                            </div>
                            <div class="col-md-2"> <a id="randomCode" data-url="{{route('admin.randomCode')}}" class="btn btn-danger me-2 btn-sm">Tạo ngẫu nhiên</a></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="item_id">Danh sách item</label>
                        <span style="color: blue;">vd: -3, -2, -1, 1</span>
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="item_id" name="item_id" placeholder="Danh sách item...">
                            </div>
                            <div class="col-md-2"> <a id="viewList" class="btn btn-danger me-2 btn-sm">Xem danh sách VP</a></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="item_quantity">Danh sách Số lượng từng item</label>
                        <span style="color: blue;">vd: 10000000, 1000000, 1000, 1</span>
                        <input type="text" class="form-control" id="item_quantity" name="item_quantity" placeholder="Danh sách Số lượng từng item...">
                    </div>
                    <div class="form-group">
                        <label for="item_isLock">Trạng thái từng item (0: không khoá - 1: khoá)</label>
                        <span style="color: blue;">vd: 0,0,0,1</span>
                        <input type="text" class="form-control" id="item_isLock" name="item_isLock" placeholder="Trạng thái từng item...">
                    </div>
                    <div class="form-group">
                        <label for="item_expires">Hạn sử dụng từng item (vĩnh viễn: -1 hoặc mili giây)</label>
                        <span style="color: blue;">vd: -1, -1, -1, 86400000</span>
                        <input type="text" class="form-control" id="item_expires" name="item_expires" placeholder="Hạn sử dụng từng item...">
                    </div>
                    <div class="form-group">
                        <label for="player">Danh sách tài khoản được nhận (bỏ trống sẽ là tất cả người chơi)</label>
                        <span style="color: blue;">vd: admin, admin2</span>
                        <input type="text" class="form-control" id="player" name="player" placeholder="Danh sách tài khoản được nhận...">
                    </div>
                    <div class="form-group">
                        <label for="time">Hạn sử dụng code (bỏ trống là không giới hạn thời gian)</label>
                        <input  style="width: 20%;" type="datetime-local" class="form-control" id="time" name="time" placeholder="Hạn sử dụng code...">
                    </div>
                    <hr>
                </div>
                <a id="addGiftCode" data-url="{{route('admin.postCode')}}" class="btn btn-success me-2">Thêm mới</a>

              </form>
          </div>
        </div>
      </div>
    </div>
</div>

@include('admin.GiftCode.modal_view')
@endsection


@section('js')
<script>

    $('#viewList').click(function(e) {
        e.preventDefault();
        $('#exampleModal').modal('show');
    })

    $('#closeModal').click(function(e) {
        e.preventDefault();
        $('#exampleModal').modal('toggle');
    })


$('#randomCode').click(function(e) {
            e.preventDefault();
            $('.page-loading').removeClass('hidden');
            var url = $(this).attr('data-url');
            var type = 'GET';
            $.ajax({
                type: type,
                url: url,
                success: function (response) {
                    const {success, code} = response
                    if (success && code) {
                        $('.page-loading').addClass('hidden');
                        $('#code').val(code)
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
    });
   
    $('#addGiftCode').click(function(e) {
            e.preventDefault();
            $('.page-loading').removeClass('hidden');
            var url = $(this).attr('data-url');
            var type = 'POST';
            var form_data = $('#formAddCode').serializeArray();

            $.ajax({
                type: type,
                url: url,
                data: form_data,
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
                        const {code, item_id, item_quantity, item_isLock, item_expires} = errObj.errors
                        if(code) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: code,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        } 
                        if(item_id) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: item_id,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        }
                        if(item_quantity) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: item_quantity,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        }if(item_isLock) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: item_isLock,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        }if(item_expires) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: item_expires,
                                icon: "error",
                                showConfirmButton: true,
                            })
                        }
                    }
                    else if(errObj.isLength) {
                        Swal.fire({
                            title: "Lỗi!",
                            text: "Hãy kiểm tra lại độ dài các mảng id vật phẩm, số lượng, trạng thái, thời gian",
                            icon: "error",
                            showConfirmButton: true,
                        })
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