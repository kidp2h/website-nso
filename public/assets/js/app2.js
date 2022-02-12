$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      $('#example').DataTable();
      $('#example').DataTable();
      $('#example2').DataTable();
      $('#example3').DataTable();
      $('#example4').DataTable();
      $('#example5').DataTable();

   
    $('#btnUnActive').click(function(e) {
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
                $.ajax({
                    type: type,
                    url: url,
                    success: function (response) {
                        const {success} = response
                        $('.page-loading').addClass('hidden');
                        if (success) {
                            Swal.fire({
                                title: "Huỷ kích hoạt toàn bộ người chơi thành công",
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
                        $('.page-loading').removeClass('hidden');
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

    $('#btnActive').click(function(e) {
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
                $.ajax({
                    type: type,
                    url: url,
                    success: function (response) {
                        const {success} = response
                        $('.page-loading').addClass('hidden');
                        if (success) {
                            
                            Swal.fire({
                                title: "Kích hoạt toàn bộ người chơi thành công",
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
                        $('.page-loading').removeClass('hidden');
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

    $('#btnDelete').click(function(e) {
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
                $.ajax({
                    type: type,
                    url: url,
                    success: function (response) {
                        const {success} = response
                        $('.page-loading').addClass('hidden');
                        if (success) {
                            
                            Swal.fire({
                                title: "Đã xoá toàn bộ nhân vật",
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
                        $('.page-loading').addClass('hidden');
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

    $('#btnDeletePlayer').click(function(e) {
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
                $.ajax({
                    type: type,
                    url: url,
                    success: function (response) {
                        const {success} = response
                        $('.page-loading').addClass('hidden');
                        if (success) {
                            
                            Swal.fire({
                                title: "Đã xoá toàn bộ tài khoản chưa kích hoạt thành công",
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
                        $('.page-loading').addClass('hidden');
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

    
})