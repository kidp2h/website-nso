<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HistoryMomo;
use App\Models\NapTien;

class ApiController extends Controller
{
    //
    public function callbackMomo(Request $request) {
        // $id_api = '14571';
        // $api_key = 'd22c02294e8dec7ac07531c4cb2dd580';

        // $ten = $_POST['ten'];
        // $sdt = $_POST['sdt'];
        // $noidung = $_POST['noidung'];
        // $tien = $_POST['tien'];
        // $idapi = $_POST['idapi'];
        // $key = $_POST['api_key'];
        // $tranid =  $_POST['tranid'];

        // $check1 = md5($id_api.$api_key);
        // $check2 = md5($idapi.$key);

        $signature = "c16d6a79101cc6d45e3f880faad8ed88c53503bd3f570603a63a429264dc021f";
     
        $rawInput = file_get_contents("php://input");
        $DataInput  = json_decode($rawInput);

        if(isset($DataInput->signature) and $DataInput->signature == $signature){
            $phone = $DataInput->phone; 				//số điện thoại Momo nhận tiền
            $tranId = $DataInput->tranId; 				//Mã giao dịch
            $ackTime = $DataInput->ackTime;				//thời gian giao dịch
            $partnerId = $DataInput->partnerId;			//Tài khoản gửi (nếu có)
            $partnerName = $DataInput->partnerName; 	//Tên tài khoản gửi (nếu có)
            $amount = $DataInput->amount;				//số tiền nhận được
            $comment = $DataInput->comment; 			//Nội dung ghi chú

            $username = strtolower($comment);
            $username = substr($username, 9);
            $username = str_replace(' ', '',trim($username));

                $user = User::where('username', '=', $username)->first();
                if(isset($user)) {
                    $oldCoin = $user->coin;
                    if($amount <= 100000) {
                        $coin = $amount;
                    } else if($amount > 100000 && $amount<=200000) {
                        $coin = $amount + $amount*5/100;
                    } else if($amount > 200000 && $amount<=500000) {
                        $coin = $amount + $amount*10/100;
                    } else if($amount > 500000 && $amount<=1000000) {
                        $coin = $amount + $amount*20/100;
                    } else if($amount > 10000000) {
                        $coin = $amount + $amount*30/100;
                    }
                    $user->coin += $coin;
                    $user->update();

                    $historyMomo = new HistoryMomo;
                    $historyMomo->player_id = $user->id;
                    $historyMomo->code = $tranId;
                    $historyMomo->sdt = $partnerId;
                    $historyMomo->money = $amount;
                    $historyMomo->coin = $coin;
                    $historyMomo->old_coin = $oldCoin;
                    $historyMomo->new_coin = $user->coin;
                    $historyMomo->save();
                }               
            }
        
    }

    public function callbackTheCao() {
        if(isset($_GET['status']) && isset($_GET['request_id'])) {
            $status = $_GET['status'];
            $request_id = $_GET['request_id'];

            $telco = $_GET['telco']; // NHÀ MẠNG
            $pin = $_GET['pin']; // MÃ THẺ
            $serial = $_GET['serial']; // SERIAL
            $amount = intval($_GET['amount']); // MỆNH GIÁ GỬI
            $amount_real = intval($_GET['amount_real']); // MỆNH GIÁ THỰC
            $amount_recieve = intval($_GET['amount_recieve']); // SỐ TIỀN NHẬN ĐƯỢC

            $napTien = NapTien::find($request_id);
            
            if(isset($napTien)) {
                if($telco != '') {
                    $napTien->nha_mang = $telco;
                }
                $napTien->ma_the = $pin;
                $napTien->ma_seri = $serial;
                $checkMoney = 0;
                if($amount == $amount_real) {
                    $checkMoney = $amount;
                } else {
                    $checkMoney = $amount_real;
                }
                $napTien->menh_gia = $checkMoney;
                if($status == 'success') {
                    // Thẻ đúng
                    $napTien->trang_thai = 1;
                    $napTien->update();

                } else if($status == 'wrong_amount') {
                    // Sai mệnh giá
                    $napTien->trang_thai = 2;
                    $napTien->update();
                } else if($status == 'fail') {
                    // Thẻ sai
                    $napTien->trang_thai = 3;
                    $napTien->update();
                }

                $user = User::find($napTien->player_id);
                switch ($napTien->nha_mang) {
                    case 'VIETTEL': {
                        $coin = $checkMoney * 83/100;
                        break;
                    }
                    case 'VINAPHONE': {
                        $coin = $checkMoney * 82/100;
                        break;
                    }
                    case 'MOBIFONE': {
                        $coin = $checkMoney * 24/100;
                        break;
                    }
                    case 'VNMOBI': {
                        $coin = $checkMoney * 17/100;
                        break;
                    }
                    case 'ZING': {
                        $coin = $checkMoney * 17/100;
                        break;
                    }
                    case 'GATE': {
                        $coin = $checkMoney * 30/100;
                        break;
                    }
                }
                $user->coin += $coin;
                $user->update();

                $napTien->so_tien = $coin;
                $napTien->update();
                
            }

            
        }
    }
}
