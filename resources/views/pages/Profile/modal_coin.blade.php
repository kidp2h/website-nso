
<div class="modal fade" id="modal-coin-luong" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Đổi Hồi Ức coin sang lượng</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <h3 class="mark">Tỷ lệ đổi là <span style="font-size:1.2rem; color: red;">1:1</span></h3>
              <hr>
              <p class="note">(*) Để sử dụng chức năng này, tài khoản của bạn cần phải <span style="font-weight:600; color: red;">ĐĂNG XUẤT</span> khỏi game</p>
              <hr>
            <form>
                <div class="mb-3">
                    <label for="coin" class="form-label">Số coin: </label>
                    <input type="text" class="form-control" id="coin" name="coin" value="" placeholder="Nhập số coin cần đổi sang lượng...">
                    <div id="info-coin" class="invalid-feedback"></div>
                </div>
                <a id="submitCoinLuong" data-url="{{route('auth.changeCoinLuong')}}" class="btn btn-success mt-1"><i class="fas fa-sync-alt"></i> Đổi lượng</a>
                <a style="float: right;" class="btn btn-secondary mt-1" data-bs-dismiss="modal">Đóng</a>
            </form>
          </div>
        </div>
    </div>
</div>