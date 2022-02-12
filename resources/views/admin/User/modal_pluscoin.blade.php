<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cộng lượng tài khoản: <span style="font-size: 1.2rem; color: red">{{$user->username}}</span></h5>
      </div>
      <div class="modal-body">
        <p>Tài khoản: <span style="font-size: 1.2rem;color: red">{{$user->username}}</span></p>
        <p>Nhân vật: <span style="font-size: 1.2rem;color: blue">{{trim($user->ninja, '[""]')}}</span></p>
        <p>Trạng thái: @if ($user->lock == 1)
            <span style="font-size: 1.2rem;color: red">Chưa kích hoạt</span>
            @else
            <span style="font-size: 1.2rem;color: green">Đã kích hoạt</span>
        @endif</p>
        <p>Số coin hiện tại:  <span style="font-size: 1.2rem;color: red">{{number_format($user->coin)}} coin</span></p>
        <hr>
        <form class="forms-sample" id="formPlusC" enctype="multipart/form-data">
            <div class="form-add-file">
                <div class="form-group">
                    <label for="coin">Số coin cộng thêm <span style="color: red">(*)</span></label>
                    <input type="number" class="form-control" id="coin" name="coin" placeholder="Nhập số coin cộng thêm...">
                </div>
                <div class="form-group">
                    <label for="ghi_chu">Ghi chú:</label>
                    <input type="text" class="form-control" id="ghi_chu" name="ghi_chu" placeholder="Nhập ghi chú..." value="Nạp coin qua Admin">
                </div>
                <hr>
            </div>
            <a id="btnPlusC" data-url="{{route('admin.postPlusCoin', ['id' => $user->id])}}" class="btn btn-success me-2">Cộng coin</a>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Đóng</button>
      </div>
    </div>
</div>

<script>
    $('#closeModal').click(function(e) {
        e.preventDefault();
        $('#exampleModal').modal('toggle');
    })

    $('#btnPlusC').click(function(e) {
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
                var coin = $('#coin').val();
                var ghi_chu = $('#ghi_chu').val();
                var url = $(this).attr('data-url');
                var type = 'POST';
                $.ajax({
                    url: url,
                    type: type,
                    data: {
                        coin: coin,
                        ghi_chu: ghi_chu,
                    },
                    dataType: 'json',
                    success: function (response) {
                        const {success} = response
                        if (success) {
                            Swal.fire({
                                title: "Cộng coin thành công",
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
                        var errObj=jQuery.parseJSON(response.responseText)
                        if(errObj.errors.coin) {
                            Swal.fire({
                                title: "Lỗi!",
                                text: errObj.errors.coin,
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
</script>