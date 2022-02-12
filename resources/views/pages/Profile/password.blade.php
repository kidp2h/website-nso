@extends('layouts.master')

@section('header')
<title>Đổi mật khẩu</title>
@endsection

@section('css')
@endsection

@section('content')

<div class="container">
    <div class="chuc-nang">
        <div class="title">
            <h3>ĐỔI MẬT KHẨU</h3>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card text-dark bg-light mb-3">
                        <div class="card-header bg-dark"></div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                  <label for="oldPass" class="form-label">Mật khẩu cũ: </label>
                                  <input type="password" class="form-control" id="oldPass" name="oldPass" placeholder="Nhập mật khẩu cũ..." >
                                  <div class="invalid-feedback" id="info-oldPass"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật mới: </label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới..." >
                                    <div class="invalid-feedback" id="info-password"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới: </label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Xácn nhận mật khẩu mới..." >
                                    <div class="invalid-feedback" id="info-confirmPassword"></div>
                                </div>
            
                                <a id="changePass" data-url="{{route('auth.password')}}" class="btn btn-success">Đổi mật khẩu</a>
                            </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pages.Profile.modal_coin')

@endsection

@section('js')

<script>
    $('#changePass').click(function(e) {
     e.preventDefault();
     Swal.fire({
         title: 'Xác nhận đổi lại mật khẩu!',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Có!',
         cancelButtonText: 'Không!',
       }).then((result) => {
         if (result.isConfirmed) {
             var password = $('#oldPass').val()
             var newPassword = $('#password').val()
             var confirmPassword = $('#confirmPassword').val()
             var type = "POST"
             var url = $(this).attr('data-url')
             $.ajax({
                 type: type,
                 url: url,
                 data: {
                     oldPassword: password,
                     password: newPassword,
                     password_confirmation: confirmPassword,
                 },
                 dataType: 'json',
                 success: function (response) {
                     const {success, isOld, isNew} = response
                     if (success && !isOld && !isNew) {
                         Swal.fire({
                             title: "Đổi mật khẩu thành công!",
                             icon: "success",
                             showConfirmButton: true,
                         })
                         $("#oldPass").val("")
                         $("#password").val("")
                         $("#confirmPassword").val("")
                     } else if (!success && isOld){
                         $("#oldPass").addClass("is-invalid")
                         $("#info-oldPass").text(isOld)
                     } else if (!success && isNew){
                         $("#password").addClass("is-invalid")
                         $("#info-password").text(isNew)
                     } else {
                         Swal.fire({
                             title: "Lỗi!",
                             icon: "error",
                             showConfirmButton: true,
                         })
                     }
                 },
                 error: function (response) {
                     var errObj=jQuery.parseJSON(response.responseText)
                     console.log(errObj)
                     if(errObj.errors){
                         const {oldPassword, password, password_confirmation} = errObj.errors
                         if (oldPassword) {
                             $("#oldPass").addClass("is-invalid")
                             $("#info-oldPass").text(oldPassword)
                         }
                         if (password) {
                             $("#password").addClass("is-invalid")
                             $("#info-password").text(password)
                         }
                         if (password_confirmation) {
                             $("#confirmPassword").addClass("is-invalid")
                             $("#info-confirmPassword").text(password_confirmation)
                         }
                     } else {
                         Swal.fire({
                             title: "Lỗi!",
                             icon: "error",
                             showConfirmButton: true,
                         })
                     }
                 }
             })
         }
     })
 })
 </script>

@endsection

