<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">THANH TOÁN GIAO DỊCH <span style="color: red;">MNT{{$maGiaDich}}</span></h5>
        </div>
        <div class="modal-body">
            <p>Bạn vui lòng chuyển <span class="mark"><span style="font-size:1.2rem; color: red;">{{$dogecoinModal}}</span> Dogecoin</span> đến địa chỉ VÍ dưới đây để thực hiện thanh toán.</p>
            <hr>
            <p class="note">(*) Số Dogecoin cần chuyển tại đây có thể khác do với DỰ TÍNH vì biến động thị trường theo thời gian.</p>
            <hr>
            <span class="note">(**) Sau khi đã chuyển Dogecoin cho chúng tôi, hãy ấn nút <span style="font-weight:600;">XÁC NHẬN ĐÃ CHUYỂN COIN</span> bên dưới để hoàn tất giao dịch và nhận Hồi Ức coin tương ứng.</span>
                <hr>
            <div class="checkout">
                <span>ĐỊA CHỈ VÍ - </span>
                <a href="#" id="copy" style="font-size: 1.4rem;"><i class="fas fa-copy"></i></a>
                <br>
                <p id="p1">{{$addressModal}}</p>
                {!! QrCode::size(350)->generate($addressModal) !!}
                <hr>
                <a id="confirmCheckout" data-url="{{route('auth.confirmCheckout', ['address' => $addressModal])}}" class="btn btn-primary btn-login mt-1"><i class="fas fa-check-circle"></i> Xác nhận đã chuyển Dogecoin</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#confirmCheckout').click(function(e) {
        e.preventDefault();
        var type = "POST"
        var url = $(this).attr('data-url')
        $.ajax({
            type: type,
            url: url,
            success: function (response) {
                const {success} = response
                if (success) {
                    Swal.fire({
                        title: "Nạp tiền thành công",
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
                const {checkStatus, checkDogecoin, dogecoin} = response
                if(errObj.checkStatus) {
                    Swal.fire({
                        title: "Lỗi!",
                        text: "Giao dịch này đã được xác nhận thành công trước đó rồi",
                        icon: "error",
                        showConfirmButton: true,
                    })
                }
                if(errObj.checkDogecoin) {
                    Swal.fire({
                        title: "Lỗi!",
                        text: `Bạn chưa chuyển đủ số Dogecoin cho chúng tôi, bạn cần chuyển thêm ${errObj.dogecoin} Dogecoin để hoàn tất giao dịch`,
                        icon: "error",
                        showConfirmButton: true,
                    })
                }
                if(errObj.checkDay) {
                    Swal.fire({
                        title: "Lỗi!",
                        text: 'Giao dịch này đã quá thời hạn để xác nhận thanh toán!',
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
    })

    $('#copy').click(function(e){
        e.preventDefault();
        var aux = document.createElement("div");
        aux.setAttribute("contentEditable", true);
        aux.innerHTML = document.getElementById('p1').innerHTML;
        aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)"); 
        document.body.appendChild(aux);
        aux.focus();
        document.execCommand("copy");
        document.body.removeChild(aux);
        Swal.fire({
            title: "Copy địa chỉ ví thành công",
            icon: "success",
            showConfirmButton: true,
        })
    })
</script>