@extends('layouts.master')

@section('header')
<title>Nạp tiền</title>
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
                        <div class="card-header text-light bg-success">Nạp tiền MOMO</div>
                        <div class="card-body">
                            <table style="width: 100%;">
							<tbody>
                                    <tr>
                                        <td colspan="2"><p style="font-weight: bold;">NẠP TIỀN QUA MOMO</p></td>
                                    </tr>
                                        <tr>
                                            <td><p >Nội dung chuyển khoản: </p></td>
                                            <td style="font-weight: bold;"><p style="font-weight: bold;">nsohoiuc {{Auth::user()->username}}</p></td>
                                        </tr>
                                        <tr>
                                            <td>Số điện thoại nhận tiền: </td>
                                            <td>037 830 8838</td>
                                        </tr>
                                        <tr>
                                            <td>Chủ tài khoản: </td>
                                            <td>Nguyễn Tiến Anh</td>
                                        </tr>

                                </tbody>
                            </table>
                            <hr>
                            <p style="font-weight: bold; color: red;">Lưu ý: Thời gian xử lý từ 1-2 phút</p>
                            <p>(*) Cần ghi đúng nội dung chuyển khoản</p>
                            <p>(**) Kiểm tra số điện thoại nhận tiền và chủ tài khoản</p>
                            <p>(***) Các trường hợp chuyển khoản sai chúng tôi sẽ không chịu trách nhiệm và không bồi thường.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div class="card text-dark bg-light mb-3">
                        <div class="card-header bg-light">Thông tin</div>
                        <div class="card-body">
                            <h5 class="card-title">BẢNG GIÁ QUY ĐỔI COIN</h5>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">Số tiền</th>
                                        <th style="width: 50%;">Tỷ lệ coin nhận về</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>1,000 - 100,000</td>
                                            <td style="font-weight: bold;">100%</td>
                                        </tr>
                                        <tr>
                                            <td>100,001 - 200,000</td>
                                            <td style="font-weight: bold;">105%</td>
                                        </tr>
                                        <tr>
                                            <td>200,001 - 500,000</td>
                                            <td style="font-weight: bold;">110%</td>
                                        </tr>
                                        <tr>
                                            <td>500,001 - 1,000,000</td>
                                            <td style="font-weight: bold;">120%</td>
                                        </tr>
                                        <tr>
                                            <td>> 1,000,000</td>
                                            <td style="font-weight: bold;">130%</td>
                                        </tr>
                                </tbody>
                            </table>
                            <hr>
                            <p>Những thắc mắc xin liên hệ QTV trong <a href="https://www.facebook.com/groups/386056276488774/">Group Facebook</a> hoặc <a href="https://zalo.me/g/kmaieh025">Box Zalo</a></p>
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
    })

    
</script>
@endsection

