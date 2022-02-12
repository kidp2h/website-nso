@extends('layouts.admin_master')

@section('content')

<div class="content-wrapper">
    <div class="page-loading hidden">
        <img class="loading" src="{{asset('assets/admin/images/auth/loading.png')}}" alt="">
        <p style="font-size: 1.5rem;">Đang thực hiện...</p>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{route('admin.user')}}" class="btn btn-primary btn-icon-text">
                < Quay lại                                                
            </a>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Thông tin tài khoản</h4>
            <p>Tài khoản: <span style="font-size: 1.1rem;color: red;">{{$user->username}}</span></p>
            <p>Nhân vật: <span style="font-size: 1.1rem;color: blue;">{{trim($user->ninja, '[""]')}}</span></p>
            <p>Số coin: <span style="font-size: 1.1rem;">{{number_format($user->coin)}} coin</span> | <a data-url="{{route('admin.plusCoin', ['id'=>$user->id])}}" class="btn btn-success btn-sm btnPlusCoin">Cộng Coin</a></p>
            <p>Oline: 
                @if($user->online == 1) 
                    <span style="font-size: 1.1rem; color: red;"> Online</span>
                @else
                    <span style="font-size: 1.1rem; color: green;"> Không</span>
                @endif
            </p>
            <p>Trạng thái tài khoản: 
                @if($user->lock == 1)
                    <span style="color: red;">Chưa kích hoạt</span> | <a data-url="{{route('admin.lock',['id'=>$user->id])}}"  class="btn btn-success btn-sm btnLock">Active</a>
                @else
                    <span style="color: green;">Đã kích hoạt</span> | <a data-url="{{route('admin.lock',['id'=>$user->id])}}"  class="btn btn-warning btn-sm btnLock">Unactive</a>
                @endif
            </p>
            <p>Khoá: 
                @if($user->ban == 1)
                    <span style="color: red;">Bị khoá (Vi phạm QĐ)</span> | <a data-url="{{route('admin.ban',['id'=>$user->id])}}" class="btn btn-warning btn-sm btnBan">Unlock</a>
                @elseif($user->ban == 2)
                    <span style="color: green;">Bị khoá (Block IP)</span> | <a data-url="{{route('admin.ban',['id'=>$user->id])}}" class="btn btn-warning btn-sm btnBan">Unlock</a>
                @else
                    <span style="color: green;">KHÔNG</span> | <a data-url="{{route('admin.ban',['id'=>$user->id])}}" class="btn btn-danger btn-sm btnBan" >Lock</a>
                @endif
            </p>
            <p>Quyền hạn: 
                @if($user->role == 9999)
                    <span style="color: red;">ADMIN</span> | <a data-url="{{route('admin.role',['id'=>$user->id])}}"  class="btn btn-danger btn-sm btnRole">Xoá Admin</a>
                @else
                    <span style="color: green;">Không</span> | <a data-url="{{route('admin.role',['id'=>$user->id])}}"  class="btn btn-dark btn-sm btnRole">Xét Admin</a>
                @endif
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lịch sử nạp MOMO</h4>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã giao dịch</th>
                        <th>Số tiền nạp</th>
                        <th>Số coin nhận</th>
                        <th>Số coin cũ</th>
                        <th>Số coin mới</th>
                         <th>Ngày/giờ thanh toán</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($momo))
                        <?php $i = 1; ?>
                        @foreach ($momo as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td style="color: red; font-weight: bold;">MM{{$item->id}}</td>
                            <td style=" font-weight: bold;">{{number_format($item->money)}} VND</td>
                            <td style=" font-weight: bold;">{{number_format($item->coin)}} coin</td>
                            <td style="font-weight: bold;">{{number_format($item->old_coin)}}</td>
                            <td style="font-weight: bold;">{{number_format($item->new_coin)}}</td>
                            <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                        </tr>
                    @endforeach

                    @endif
                </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lịch sử nạp thẻ cào</h4>
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                                        <th>Mã giao dịch</th>
                                        <th>Số coin nhận được</th>
                                        <th>Nhà mạng</th>
                                        <th>Mệnh giá</th>
                                        <th>Mã thẻ</th>
                                        <th>Số seri</th>
                                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($naptien))
                        <?php $i = 1; ?>
                        @foreach ($naptien as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td style="color: red; font-weight: bold;">TDT{{$item->id}}</td>
                            <td style="font-weight: bold;">{{number_format($item->so_tien)}} coin</td>
                            <td >{{$item->nha_mang}}</td>
                            <td >{{number_format($item->menh_gia)}}</td>
                            <td >{{$item->ma_the}}</td>
                            <td >{{$item->ma_seri}}</td>
                            <td>
                                @if($item->trang_thai == 0)
                                    <span style="color: blue;">Đang chờ xử lý</span>
                                @elseif($item->trang_thai == 1)
                                    <span style="color: green;">Thành công</span>
                                @elseif($item->trang_thai == 2)
                                    <span style="color: orange;">Thẻ sai mệnh giá</span>
                                @elseif($item->trang_thai == 3)
                                    <span style="color: red;">Không thành công</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    @endif
                </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lịch sử nạp coin qua ADMIN</h4>
            <table id="example3" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã giao dịch</th>
                        <th>Số coin nạp</th>
                        <th>Số coin cũ</th>
                        <th>Số coin mới</th>
                        <th>Ghi chú</th>
                        <th>Thời gian nhận</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($admin))
                       
                            <?php $i = 1; ?>
                            @foreach ($admin as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td style="color: red; font-weight: bold;">NCA{{$item->id}}</td>
                                    <td>{{number_format($item->coin)}}</td>
                                    <td>{{number_format($item->old_coin)}}</td>
                                    <td>{{number_format($item->new_coin)}}</td>
                                    <td>{{$item->desc}}</td>
                                    <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                                </tr>
                            @endforeach
  
                    @endif
                </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lịch sử đổi coin</h4>
            <table id="example4" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã giao dịch</th>
                        <th>Số coin đổi</th>
                        <th>Số coin cũ</th>
                        <th>Số coin mới</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($doiCoin))
                       
                            <?php $i = 1; ?>
                            
                            @foreach ($doiCoin as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td style="color: red; font-weight: bold;">MDC{{$item->id}}</td>
                                    <td>{{number_format($item->coin)}}</td>
                                    <td>{{number_format($item->old_coin)}}</td>
                                    <td>{{number_format($item->new_coin)}}</td>
                                    <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                                </tr>
                            @endforeach

                    @endif
                </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lịch sử mua vật phẩm webshop</h4>
            <table id="example5" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã giao dịch</th>
                        <th>Tên vật phẩm</th>
                        <th>Số coin</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($webshop))
                            <?php $i = 1; ?>
                            @foreach ($webshop as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td style="color: red; font-weight: bold;">WS{{$item->id}}</td>
                                    <td>{{$item->ten_vat_pham}}</td>
                                    <td style="color: red;">- {{number_format($item->coin)}} coin</td>
                                    <td>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
</div>
@endsection


@section('js')
<script>
    $('.btnPlusCoin').click(function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        var type = 'GET';
        $.ajax({
            type: type,
            url: url,
            success: function (response) {
                const {success, data} = response
                if (success, data) {
                    $('#exampleModal').html(data);
                    $('#exampleModal').modal('show');
                }
            },
            error: function (response) {
                var errObj=jQuery.parseJSON(response.responseText)
                Swal.fire({
                    title: "Lỗi!",
                    text: "Hãy liên hệ BQT để biết thêm chi tiết",
                    icon: "error",
                    showConfirmButton: true,
                })
            }
        })
        
    })

    $('.btnBan').click(function(e) {
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
                var url = $(this).attr('data-url');
                var type = 'POST';
                $.ajax({
                    type: type,
                    url: url,
                    success: function (response) {
                        const {success, ban, unBan} = response
                        if (success) {
                            if(unBan) {
                                Swal.fire({
                                    title: "Đã mở khoá tài khoản",
                                    icon: "success",
                                    showConfirmButton: true,
                                }).then((result) => {
                                     if (result.isConfirmed) {
                                         location.reload()
                                     }
                                })
                            } else if(ban) {
                                Swal.fire({
                                    title: "Đã khoá tài khoản",
                                    icon: "success",
                                    showConfirmButton: true,
                                }).then((result) => {
                                     if (result.isConfirmed) {
                                         location.reload()
                                     }
                                })
                            }
                            
                        }
                    },
                    error: function (response) {
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

    $('.btnLock').click(function(e) {
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
                var url = $(this).attr('data-url');
                var type = 'POST';
                $.ajax({
                    type: type,
                    url: url,
                    success: function (response) {
                        const {success, lock, unLock} = response
                        if (success) {
                            if(unLock) {
                                Swal.fire({
                                    title: "Đã kích hoạt tài khoản",
                                    icon: "success",
                                    showConfirmButton: true,
                                }).then((result) => {
                                     if (result.isConfirmed) {
                                         location.reload()
                                     }
                                })
                            } else if(lock) {
                                Swal.fire({
                                    title: "Đã huỷ kích hoạt khoản",
                                    icon: "success",
                                    showConfirmButton: true,
                                }).then((result) => {
                                     if (result.isConfirmed) {
                                         location.reload()
                                     }
                                })
                            }
                            
                        }
                    },
                    error: function (response) {
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

    $('.btnRole').click(function(e) {
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
                var url = $(this).attr('data-url');
                var type = 'POST';
                $.ajax({
                    type: type,
                    url: url,
                    success: function (response) {
                        const {success, lock, unLock} = response
                        if (success) {
                            if(unLock) {
                                Swal.fire({
                                    title: "Thay đổi quyền hạn thành công",
                                    icon: "success",
                                    showConfirmButton: true,
                                }).then((result) => {
                                     if (result.isConfirmed) {
                                         location.reload()
                                     }
                                })
                            } else if(lock) {
                                Swal.fire({
                                    title: "Thay đổi quyền hạn thành công",
                                    icon: "success",
                                    showConfirmButton: true,
                                }).then((result) => {
                                     if (result.isConfirmed) {
                                         location.reload()
                                     }
                                })
                            }
                            
                        }
                    },
                    error: function (response) {
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