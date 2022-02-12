@extends('layouts.master')

@section('header')
<title>Thông tin tài khoản</title>
@endsection

@section('css')
@endsection

@section('content')

<div class="container">
    <div class="chuc-nang">
        <div class="title">
            <h3>THÔNG TIN TÀI KHOẢN</h3>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card text-dark bg-light mb-3">
                        <div class="card-header bg-dark"></div>
                        <div class="card-body">
                          <h5 class="card-title">Hồi ức coin: <span style="color:red;">{{number_format(Auth::user()->coin)}}</span></h5>
                          <hr>
                          @if(Auth::user()->lock == 1) 
                            <a id="activeAccount" data-url="{{route('auth.active')}}" class="btn btn-danger mt-1"><i class="fas fa-user-check"></i> KÍCH HOẠT CHÍNH THỨC (15k)</a>
                            {{-- <a id="activeAccountTN" data-url="{{route('auth.activetn')}}" class="btn btn-dark mt-1"><i class="fas fa-user-check"></i> KÍCH HOẠT TRẢI NGHIỆM (10k)</a> --}}
                          @elseif(Auth::user()->status == 1)
                          <a id="upgradeAccount" data-url="{{route('auth.upgrade')}}" class="btn btn-danger mt-1"><i class="fas fa-user-check"></i> NÂNG CẤP TÀI KHOẢN (15k)</a>
                            @endif
                            <a href="{{route('index.chucnang')}}" class="btn btn-warning mt-1"><i class="fas fa-coins"></i> Nạp coin</a>
                            <a href="{{route('index.history')}}"  class="btn btn-success mt-1"><i class="fas fa-history"></i> Lịch sử giao dịch</a>
                            <a href="{{route('index.password')}}"  class="btn btn-primary mt-1"><i class="fas fa-exchange-alt"></i> Đổi mật khẩu</a>
                            <a id="changeCoinLuong" class="btn btn-danger mt-1"><i class="fas fa-location-arrow"></i> Đổi Hồi Ức coin sang lượng</a>
                          <hr>
                          <form>
                                <div class="mb-3">
                                    <label class="form-label">Tài khoản:</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->username}}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái tài khoản:</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->ban == 1 ? 'TÀI KHOẢN BỊ KHOÁ DO VI PHẠM QUY ĐỊNH SERVER' : (Auth::user()->lock==1 ? 'Chưa kích hoạt' : (Auth::user()->status == 0 ? 'TÀI KHOẢN CHÍNH THỨC' : 'TÀI KHOẢN TRẢI NGHIỆM'))}}" disabled>
                                </div>
								<div class="mb-3">
                                    <label class="form-label">Tài khoản giới thiệu:</label>
                                    @if(Auth::user()->lock == 1)
                                    <input type="text" class="form-control" id="invite" name="invite" value="{{Auth::user()->invite}}"  >
                                    @else
                                    <input type="text" class="form-control" id="invite" name="invite" value="{{Auth::user()->invite}}" disabled >
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email :</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Nhập email lấy lại mật khẩu..." value="{{Auth::user()->email}}">
                                    <div id="emailChange" class="invalid-feedback"></div>
                                    </div>
                                <a id="changeEmail" data-url="{{route('auth.email')}}" class="btn btn-success mt-1"><i class="fas fa-sync-alt"></i> Cập nhật</a>
                            </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pages.Profile.modal_coin')
@include('pages.modal_alert')
@endsection

@section('js')

<script>
    $(document).ready(function() {
		$('#modal-alert').modal('show');
        $('#changeEmail').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Xác nhận cập nhật',
				
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Cập nhật',
                cancelButtonText: 'Không',
            }).then((result) => {
                if (result.isConfirmed) {
                    var email = $('#email').val()
                    var invite = $('#invite').val()
                    var type = "POST"
                    var url = $(this).attr('data-url')
                    $.ajax({
                        type: type,
                        url: url,
                        data: {
                            email: email,
                            invite: invite,
                        },
                        dataType: 'json',
                        success: function (response) {
                            const {success} = response
                            if (success) {
                                Swal.fire({
                                    title: "Cập nhật thành công",
                                    icon: "success",
                                    showConfirmButton: true,
                                })
                            }
                        },
                        error: function (response) {
                            var errObj=jQuery.parseJSON(response.responseText)
                            if(errObj.errors){
                                const {email} = errObj.errors
                                if (email) {
                                    $("#email").addClass("is-invalid")
                                    $("#emailChange").text(email)
                                }
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
        })

        $('#activeAccount').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Xác nhận kích hoạt tài khoản',
                text: 'Phí kích hoạt 15k coin (Chỉ còn 13k coin với tài khoản có người giới thiệu)',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Không',
            }).then((result) => {
                if (result.isConfirmed) {
                    var type = "POST"
                    var url = $(this).attr('data-url')
                    $.ajax({
                        type: type,
                        url: url,
                        success: function (response) {
                            const {success} = response
                            if (success) {
                                Swal.fire({
                                    title: "Kích hoạt tài khoản thành công",
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
							if (errObj.checkCoin) {
                                    Swal.fire({
                                        title: "Không đủ Hồi Ức Coin",
                                        text: "Bạn không có đủ hồi ức coi để kích hoạt tài khoản",
                                        icon: "error",
                                        showConfirmButton: true,
                                    })
                                }
                                else if (errObj.checkLock) {
                                    Swal.fire({
                                        title: "Lỗi",
                                        text: "Tài khoản của bạn đã được kích hoạt trước đó rồi",
                                        icon: "error",
                                        showConfirmButton: true,
                                    })
                                }else {
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

        $('#activeAccountTN').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Xác nhận kích hoạt TRẢI NGHIỆM',
                text: 'Phí kích hoạt 10,000 coin',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Không',
            }).then((result) => {
                if (result.isConfirmed) {
                    var type = "POST"
                    var url = $(this).attr('data-url')
                    $.ajax({
                        type: type,
                        url: url,
                        success: function (response) {
                            const {success} = response
                            if (success) {
                                Swal.fire({
                                    title: "Kích hoạt tài khoản trải nghiệm thành công",
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
							if (errObj.checkCoin) {
                                    Swal.fire({
                                        title: "Không đủ Hồi Ức Coin",
                                        text: "Bạn không có đủ hồi ức coi để kích hoạt tài khoản",
                                        icon: "error",
                                        showConfirmButton: true,
                                    })
                                }
                                else if (errObj.checkLock) {
                                    Swal.fire({
                                        title: "Lỗi",
                                        text: "Tài khoản của bạn đã được kích hoạt trước đó rồi",
                                        icon: "error",
                                        showConfirmButton: true,
                                    })
                                }else {
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

        $('#upgradeAccount').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Xác nhận nâng cấp tài khoản lên CHÍNH THỨC',
                text: 'Phí nâng cấp 15,000 coin',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Không',
            }).then((result) => {
                if (result.isConfirmed) {
                    var type = "POST"
                    var url = $(this).attr('data-url')
                    $.ajax({
                        type: type,
                        url: url,
                        success: function (response) {
                            const {success} = response
                            if (success) {
                                Swal.fire({
                                    title: "Nâng cấp tài khoản thành công",
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
							if (errObj.checkCoin) {
                                    Swal.fire({
                                        title: "Không đủ Hồi Ức Coin",
                                        text: "Bạn không có đủ hồi ức coi để kích hoạt tài khoản",
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

        $('#changeCoinLuong').click(function(e) {
            e.preventDefault();
            $('#modal-coin-luong').modal('show');
        })

        $('#submitCoinLuong').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Xác nhận đổi coin',
				text: 'Hãy chắc chắn rằng bạn đã ĐĂNG XUẤT khỏi game.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Không',
            }).then((result) => {
                if (result.isConfirmed) {
                    var coin = $('#coin').val()
                    var type = "POST"
                    var url = $(this).attr('data-url')
                    $.ajax({
                        type: type,
                        url: url,
                        data: {
                            coin: coin,
                        },
                        dataType: 'json',
                        success: function (response) {
                            const {success} = response
                            if (success) {
                                Swal.fire({
                                    title: "Bạn đã đổi lượng thành công",
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
                                const {coin} = errObj.errors
                                if (coin) {
                                    $("#coin").addClass("is-invalid")
                                    $("#info-coin").text(coin)
                                }
                                
                            } 
                            else if(errObj.checkLock) {
                                Swal.fire({
                                    title: "Lỗi",
                                    text: "Tài khoản của bạn chưa được kích hoạt, không thể sử dụng chức năng này",
                                    icon: "error",
                                    showConfirmButton: true,
                                })
                            }
                            else if(errObj.checkBan) {
                                Swal.fire({
                                    title: "Lỗi",
                                    text: "Tài khoản của bạn đã bị KHOÁ do vi phạm quy định của Server, không thể sử dụng chức năng này",
                                    icon: "error",
                                    showConfirmButton: true,
                                })
                            }
                            else if(errObj.checkCoin) {
                                Swal.fire({
                                    title: "Lỗi",
                                    text: "Bạn không đủ Hồi Ức coin để thực hiện chức năng này",
                                    icon: "error",
                                    showConfirmButton: true,
                                })
                            }else if(errObj.checkOnline) {
                                Swal.fire({
                                    title: "Lỗi",
                                    text: "Tài khoản của bạn chưa được ĐĂNG XUẤT khỏi game, hãy ĐĂNG XUẤT và thực hiện lại",
                                    icon: "error",
                                    showConfirmButton: true,
                                })
                            }else {
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

