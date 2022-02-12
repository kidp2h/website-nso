@extends('layouts.admin_master')

@section('css')

@endsection

@section('content')

<div class="content-wrapper">
    <div class="page-loading">
        <img class="loading" src="{{asset('assets/admin/images/auth/loading.png')}}" alt="">
        <p style="font-size: 1.5rem;">Đang thực hiện...</p>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <a id="btnUnActive" data-url="{{route('admin.unActiveAll')}}" class="btn btn-danger btn-icon-text">
                <i class="mdi mdi-lock"></i> Huỷ kích hoạt toàn bộ tài khoản                                                  
            </a>
            <a id="btnActive" data-url="{{route('admin.activeAll')}}" class="btn btn-success btn-icon-text">
                <i class="mdi mdi-lock-open-outline"></i> Kích hoạt toàn bộ tài khoản                                             
            </a>
            <a id="btnDelete" data-url="{{route('admin.delete')}}" class="btn btn-warning btn-icon-text">
                <i class="mdi mdi-delete-forever"></i> Xoá toàn bộ Nhân vật                                             
            </a>
            <a id="btnDeletePlayer" data-url="{{route('admin.deletePlayer')}}" class="btn btn-dark btn-icon-text">
                <i class="mdi mdi-delete-forever"></i> Xoá tài khoản không có nhân vật & chưa kích hoạt                                           
            </a>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Danh sách tài khoản</h4>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tài khoản</th>
                        <th>Kích hoạt</th>
                        <th>Khoá</th>
                        <th>Nhân vật</th>
                        <th>Coin</th>
                        <th>Online</th>
                        <th>Quyền hạn</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($user))
                    <?php $i = 1; ?>
                    @foreach ($user as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->username}}</td>
                            <td>
                                @if($item->lock == 1) <span style="color: red;">Chưa kích hoạt</span>
                                @else <span style="color: green;">Đã kích hoạt</span>
                                @endif
                            </td>
                            <td>
                                @if($item->ban == 1) <span style="color: red;">Bị khoá (Vi phạm QĐ)</span>
                                @elseif($item->ban == 2) <span style="color: red;">Bị khoá (Block IP)</span>
                                @else <span>Không</span>
                                @endif
                            </td>
                            <td>{{trim($item->ninja, '[""]')}}</td>
                            <td>{{number_format($item->coin)}}</td>
                            <td>{{$item->online == 1? 'Có' : 'Không'}}</td>
                            <td>
                                @if($item->role == 9999) <span style="color: red;">Admin</span>
                                @else Không 
                                @endif
                            </td>
                            <td>
                                @if($item->id != Auth::user()->id)
                                    @if($item->ban == 0)
                                    <a data-url="{{route('admin.ban',['id'=>$item->id])}}" class="btn btn-danger btn-sm btnBan" >Lock</a>
                                    @else
                                    <a data-url="{{route('admin.ban',['id'=>$item->id])}}" class="btn btn-warning btn-sm btnBan">Unlock</a>
                                    @endif
                                    
                                    @if($item->lock == 1)
                                        <a data-url="{{route('admin.lock',['id'=>$item->id])}}"  class="btn btn-success btn-sm btnLock">Active</a>
                                    @else
                                        <a data-url="{{route('admin.lock',['id'=>$item->id])}}"  class="btn btn-warning btn-sm btnLock">Unactive</a>
                                    @endif
                                    @if($item->role == 0)
                                        <a data-url="{{route('admin.role',['id'=>$item->id])}}"  class="btn btn-dark btn-sm btnRole">Xét Admin</a>
                                    @else
                                        <a data-url="{{route('admin.role',['id'=>$item->id])}}"  class="btn btn-danger btn-sm btnRole">Xoá Admin</a>
                                    @endif
                                @endif
                                <a href="{{route('admin.view', ['id'=>$item->id])}}"  class="btn btn-primary btn-sm btnView">View</a>
                                <a data-url="{{route('admin.plusCoin', ['id'=>$item->id])}}" class="btn btn-success btn-sm btnPlusCoin">Cộng Coin</a>
                            </td>
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
    jQuery(window).on("load", function(){
        $('.page-loading').addClass('hidden');
    });
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