@extends('layouts.master')

@section('header')
<title>Nạp thẻ điện thoại</title>
@endsection

@section('css')
<style>
    table, th, td {
        border: 1px solid #ccc;
        text-align: center;
    }
    th, td {
        line-height: 2.5rem;
    }
</style>
@endsection

@section('content')

<div class="container">
    <div class="chuc-nang">
        <div class="title">
            <h3>NẠP TIỀN</h3>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12 col-lg-7">
                    <div class="card text-dark bg-light mb-3">
                        <div class="card-header text-light bg-success">Nạp tiền Thẻ Điện Thoại</div>
                        <div class="card-body">
                            <form action="" id="napTien">
                                <div class="mb-3">
                                    <label for="telco" class="form-label">Nhà mạng:</label>
                                    <select class="form-select" name="telco" id="telco">
                                        <option value="" selected disabled>--- Chọn nhà mạng ---</option>
                                        <option value="1">Viettel</option>
                                        <option value="2">Vinaphone</option>
                                        <option value="3">Mobiphone</option>
                                        <option value="4">VietnamMobile</option>
                                        <option value="5">Zing</option>
                                        <option value="6">Gate</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Mệnh giá:</label>
                                    <select class="form-select" name="amount" id="amount">
                                        <option value="" selected disabled>--- Chọn mệnh giá ---</option>
                                        <option value="10000">10,000</option>
                                        <option value="20000">20,000</option>
                                        <option value="50000">50,000</option>
                                        <option value="100000">100,000</option>
                                        <option value="200000">200,000</option>
                                        <option value="300000">300,000</option>
                                        <option value="500000">500,000</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pin" class="form-label">Mã thẻ:</label>
                                    <input type="text" class="form-control" id="pin" name="pin" placeholder="Nhập mã thẻ...">
                                </div>
                                <div class="mb-3">
                                    <label for="serial" class="form-label">Số Seri:</label>
                                    <input type="text" class="form-control" id="serial" name="serial" placeholder="Nhập số serial...">
                                </div>
                                <a id="btnCheckout" data-url="{{route('auth.postThe')}}" class="btn btn-success btn-login">Nạp tiền</a>
                            </form>
                            <hr>
                            <p style="font-weight: bold; color: red;">Lưu ý:</p>
                            <p>(*) Chọn đúng giá trị thẻ, đúng số seri, mã thẻ</p>
                            <p>(**) Những thẻ bị điền sai thông tin chúng tôi sẽ không chịu trách nhiệm và không bồi thường.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div class="card text-dark bg-light mb-3">
                        <div class="card-header bg-light">Thông tin</div>
                        <div class="card-body">
                            <h5 class="card-title">BẢNG GIÁ Chiết khấu</h5>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">Nhà mạng</th>
                                        <th style="width: 50%;">Chiết khẩu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>Vietel</td>
                                            <td style="font-weight: bold;">17%</td>
                                        </tr>
                                        <tr>
                                            <td>Vinaphone</td>
                                            <td style="font-weight: bold;">18%</td>
                                        </tr>
                                        <tr>
                                            <td>Mobiphone</td>
                                            <td style="font-weight: bold;">24%</td>
                                        </tr>
                                        <tr>
                                            <td>VinamMobile</td>
                                            <td style="font-weight: bold;">17%</td>
                                        </tr>
                                        <tr>
                                            <td>Zing</td>
                                            <td style="font-weight: bold;">17%</td>
                                        </tr>
                                        <tr>
                                            <td>Gate</td>
                                            <td style="font-weight: bold;">30%</td>
                                        </tr>
                                </tbody>
                            </table>
                            <hr>
                            <p>Những thắc mắc xin liên hệ QTV trong <a href="https://www.facebook.com/0x4B6/">Group Facebook</a> hoặc <a href="https://zalo.me/g/kmaieh025">Box Zalo</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.modal_alert')
@endsection

@section('js')
<script>
    $(document).ready(function() {
		$('#modal-alert').modal('show');
        $('#btnCheckout').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Xác nhận đổi coin',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Không',
            }).then((result) => {
                if (result.isConfirmed) {
                    var data = $('#napTien').serialize();
                    var type = "POST"
                    var url = $(this).attr('data-url')
                    $.ajax({
                        type: type,
                        url: url,
                        data: data,
                        success: function (response) {
                            const {success} = response
                            if (success) {
                                Swal.fire({
                                    title: "Gửi thẻ thành công",
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
                            if(errObj.errors){
                                const {telco, amount, pin, serial} = errObj.errors
                                if (coin) {
                                    Swal.fire({
                                        title: "Lỗi!",
                                        text: telco,
                                        icon: "error",
                                        showConfirmButton: true,
                                    })
                                }
                                if (amount) {
                                    Swal.fire({
                                        title: "Lỗi!",
                                        text: amount,
                                        icon: "error",
                                        showConfirmButton: true,
                                    })
                                }
                                if (pin) {
                                    Swal.fire({
                                        title: "Lỗi!",
                                        text: pin,
                                        icon: "error",
                                        showConfirmButton: true,
                                    })
                                }
                                if (serial) {
                                    Swal.fire({
                                        title: "Lỗi!",
                                        text: serial,
                                        icon: "error",
                                        showConfirmButton: true,
                                    })
                                }
                            } else if (!errObj.success) {
                                    Swal.fire({
                                        title: "Lỗi!",
                                        text: "Gửi thẻ không thành công",
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
                }
            })
        })
    })

    
</script>
@endsection

