// Swal.fire({
//     title: 'Error!',
//     text: 'Do you want to continue',
//     icon: 'error',
//     confirmButtonText: 'Cool'
//   })

$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#dataTable').DataTable({
        "scrollX": true,
        "language": {
            "decimal":        "",
            "emptyTable":     "Không có dữ liệu!",
            "info":           "Hiển thị _START_ tới _END_ của _TOTAL_ dòng dữ liệu",
            "infoEmpty":      "Hiển thị 0 tới 0 của 0 dòng dữ liệu",
            "infoFiltered":   "(lọc ra từ _MAX_ tổng số dữ liệu)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Hiển thị _MENU_ dòng dữ liệu",
            "loadingRecords": "Đang tải...",
            "processing":     "Đang tiến hành xử lý...",
            "search":         "Tìm kiếm:",
            "zeroRecords":    "Không có dữ liệu!",
            "paginate": {
                "first":      "Đầu tiên",
                "last":       "Cuối cùng",
                "next":       "Kế tiếp",
                "previous":   "Trở lại"
            },
            "aria": {
                "sortAscending":  ": kích hoạt để sắp xếp cột tăng dần",
                "sortDescending": ": kích hoạt để sắp xếp cột giảm dần"
            },
   
        },
    });

    $('.update-info').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Chức năng này đang cập nhật',
            icon: 'info',
            confirmButtonText: 'Đóng'
        })
    })

    var checkOpen = false;
    $('#open-menu-toggle').click(function(e) {
        e.preventDefault();
        if(!checkOpen) {
            $('.mobile-menu').addClass('menu-open');
            checkOpen = true
            $(this).addClass('hidden')
        }
    })
    $('#close-menu-toggle').click(function(e) {
        e.preventDefault();
        if(checkOpen) {
            $('.mobile-menu').removeClass('menu-open');
            checkOpen = false
            $('#open-menu-toggle').removeClass('hidden')
        }
    })

    $('#username').keydown(function(){
        $(this).removeClass('is-invalid')
    }) 
    $('#email').keydown(function(){
        $(this).removeClass('is-invalid')
    }) 
    $('#password').keydown(function(){
        $(this).removeClass('is-invalid')
    }) 
    $('#oldPass').keydown(function(){
        $(this).removeClass('is-invalid')
    }) 
    $('#confirmPassword').keydown(function(){
        $(this).removeClass('is-invalid')
    }) 
    $('#coin').keydown(function(){
        $(this).removeClass('is-invalid')
    }) 

    $('#btnLogin').click(function(e) {
      console.log("rac");
        e.preventDefault();
        var data = $('#formLogin').serialize();
        var type = "POST"
        var url = $(this).attr('data-url')
        var urlHome = $(this).attr('data-home')
        $.ajax({
            type: type,
            url: url,
            data: data,
            dataType: 'json',
            success: function (response) {
                const {success} = response
                if (success) {
                    Swal.fire({
                        title: "Đăng nhập thành công!",
                        icon: "success",
                        showConfirmButton: false,
                    })
                    setTimeout(function() {
                        window.location.href=urlHome
                    }, 1300)
                    return
                }
            },
            error: function (response) {
              console.log(response);
                var errObj=jQuery.parseJSON(response.responseText)
                if(errObj.errors){
                    const {username, password} = errObj.errors
                    if (username) {
                        $("#username").addClass("is-invalid")
                        $("#usernamelLogin").text(username)
                    }
                    if (password) {
                        $("#password").addClass("is-invalid")
                        $("#passwordLogin").text(password)
                    }
                    
                } else if(errObj.checkAccount) {
                    Swal.fire({
                        title: "Tài khoản hoặc mật khẩu sai",
                        text: "Hãy kiểm tra lại tài khoản hoặc mật khẩu của bạn.",
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
    })

    $('#btnRegister').click(function(e) {
        e.preventDefault();
        var data = $('#formRegister').serialize();
        var type = "POST"
        var url = $(this).attr('data-url')
        var urlHome = $(this).attr('data-home')
        $.ajax({
            type: type,
            url: url,
            data: data,
            dataType: 'json',
            success: function (response) {
                const {success} = response
                if (success) {
                    Swal.fire({
                        title: "Bạn đã đăng ký thành công",
                        icon: "success",
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href=urlHome
                        }
                    })
                }
            },
            error: function (response) {
                         var errObj=jQuery.parseJSON(response.responseText)
                if(errObj.errors){
                    const {username, password, email, password_confirmation} = errObj.errors
                    if (username) {
                        $("#username").addClass("is-invalid")
                        $("#usernamelRegister").text(username)
                    }
                    if (password) {
                        $("#password").addClass("is-invalid")
                        $("#passwordRegister").text(password)
                    }
                    if (email) {
                        $("#email").addClass("is-invalid")
                        $("#emailRegister").text(email)
                    }
                    if (password_confirmation) {
                        $("#confirmPassword").addClass("is-invalid")
                        $("#confirmPasswordRegister").text(password_confirmation)
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
    })
})