<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DoiCoin;
use App\Models\CheckOut;
use App\Models\Webshop;
use App\Models\HistoryWebshop;
use App\Models\Ninja;
use App\Models\NapTien;
use Illuminate\Support\Facades\Http;
class AuthController extends Controller
{
    //
    public function logout() {
        Auth::logout();
        return redirect()->route('index');
    }

    public function email(Request $request) {
        if ($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'email' => 'required|email|unique:player,email,'.Auth::user()->id,
            ], [
                'email.required' => 'Hãy nhập email cần thay đổi',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Địa chỉ email này đã có người sử dụng',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];
                $user = User::find(Auth::user()->id);
                if(isset($user)) {
                    $user->email = $request->email;
					if($user->lock == 1) {
						$user->invite = $request->invite;
					}
                    $user->update();
                    $respone['success'] = true;
                    return response()->json($respone, 200);
                }
                return response()->json($respone, 400);
            }   
        }
    }

    public static function login(Request $request) {
        if ($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required'
            ], [
                'username.required' => 'Hãy nhập tài khoản',
                'password.required' => 'Hãy nhập mật khẩu'
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];
                $usn = strtolower($request->username);
                $user = User::where('username', $usn)->where('password',$request->password)->first();
                if (!$user) {
                    $respone['checkAccount'] = true;
                    return response()->json($respone, 400);
                } else {
                    Auth::login($user);
                    $respone['success'] = true;
                    return response()->json($respone, 200);
                }
            }   
        }
    }

    public function register(Request $request) {
        if ($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'email' => 'required|email|unique:player,email',
                'username' => 'required|unique:player,username',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required'
            ], [
                'email.required' => 'Hãy nhập email',
                'email.email' => 'Email sai định dạng',
                'email.unique' => 'Địa chỉ email đã liên kết với tài khoản khác',
                'username.required' => 'Hãy nhập tài khoản',
                'username.unique' => 'Tài khoản này đã tồn tại',
                'password.required' => 'Hãy nhập mật khẩu',
                'password.confirmed' => 'Xác nhận mật khẩu sai',
                'password.min' => 'Độ dài mật khẩu lớn hơn 6 ký tự',
                'password_confirmation.required' => 'Hãy xác nhận mật khẩu'
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => true];
                $user = new User;
                $user->username = strtolower($request->username);
                $user->email = $request->email;
                $user->password = $request->password;
				$user->invite = $request->invite;
                $user->lock = 1;
                $user->ban = 0;
                $user->luong = 0;
                $user->ninja = '[]';
                $user->coin = 0;
                $user->role = 0;
                $user->status = -1;
                $user->save();
                return response()->json($respone, 200);
            }   
        }
    }

    public function active(Request $request) {
        if ($request->ajax()) {
            $respone = ['success' => false];    
            $user = User::find(Auth::user()->id);
            if($user->status != -1) {
                return response()->json($respone, 400);
            }
            if($user->coin < 15000) {
                $respone['checkCoin'] = true;
                return response()->json($respone, 400);
            } else if($user->lock != 1) {
                $respone['checkLock'] = true;
                return response()->json($respone, 400);
            }else {
				$doicoin = new DoiCoin;
				$doicoin->old_coin = $user->coin;
				$doicoin->player_id = $user->id;
                $invUser = User::where('username', $user->invite)->first();
                if(isset($invUser)) {
					$doicoin2 = new DoiCoin;
                    $doicoin2->player_id = $invUser->id;
					$doicoin2->old_coin = $invUser->coin;
					
                    $user->coin -= 13000;
		
					$doicoin->coin = -13000;
					
                    $invUser->coin += 2000;
                    $invUser->update();
                    
                    $doicoin2->coin = 2000;
					$doicoin2->new_coin = $invUser->coin;
                    $doicoin2->save();
                } else {
                    $user->coin -= 15000;
                    $user->invite = '';
					$doicoin->coin = -15000;
                }
                $user->lock = 0;
                $user->status = 0;
                $user->update();
				
				$doicoin->new_coin = $user->coin;
				$doicoin->save();
                $respone['success'] = true;
                return response()->json($respone, 200);
            }
        }
    }

    public function activeTN(Request $request) {
        if ($request->ajax()) {
            // $respone = ['success' => false];    
            // $user = User::find(Auth::user()->id);
            // if($user->status != -1) {
            //     return response()->json($respone, 400);
            // }
            // if($user->coin < 10000) {
            //     $respone['checkCoin'] = true;
            //     return response()->json($respone, 400);
            // } else if($user->lock != 1) {
            //     $respone['checkLock'] = true;
            //     return response()->json($respone, 400);
            // }else {
			// 	$doicoin = new DoiCoin;
			// 	$doicoin->old_coin = $user->coin;
			// 	$doicoin->player_id = $user->id;

            //     $user->coin -= 10000;
            //     $user->invite = '';
			// 	$doicoin->coin = -10000;

            //     $user->lock = 0;
            //     $user->status = 1;
            //     $user->update();
				
			// 	$doicoin->new_coin = $user->coin;
			// 	$doicoin->save();
            //     $respone['success'] = true;
            //     return response()->json($respone, 200);
            // }
        }
    }

    public function upgrade(Request $request) {
        if ($request->ajax()) {
            // $respone = ['success' => false];    
            // $user = User::find(Auth::user()->id);
            // if($user->status != 1) {
            //     return response()->json($respone, 400);
            // }
            // if($user->coin < 15000) {
            //     $respone['checkCoin'] = true;
            //     return response()->json($respone, 400);
            // } else {
			// 	$doicoin = new DoiCoin;
			// 	$doicoin->old_coin = $user->coin;
			// 	$doicoin->player_id = $user->id;

            //     $user->coin -= 15000;
            //     $user->invite = '';
			// 	$doicoin->coin = -15000;

            //     $user->lock = 0;
            //     $user->status = 0;
            //     $user->update();
				
			// 	$doicoin->new_coin = $user->coin;
			// 	$doicoin->save();
            //     $respone['success'] = true;
            //     return response()->json($respone, 200);
            // }
        }
    }
    
    public function changeCoinLuong(Request $request) {
        if ($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'coin' => 'required|numeric|min:1000',
            ], [
                'coin.required' => 'Hãy nhập số coin cần đổi',
                'coin.numeric' => 'Giá trị nhập vào sai định dạng',
                'coin.min' => 'Số coin thấp nhất được đổi là 1,000 Hồi Ức coin',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];
                $coinChange = round($request->coin);
                $user = User::find(Auth::user()->id);

                if($user->lock == 1) {
                    $respone['checkLock'] = true;
                    return response()->json($respone, 400);
                } 

                if($user->ban >= 1) {
                    $respone['checkBan'] = true;
                    return response()->json($respone, 400);
                } 

                if($user->coin < $coinChange) {
                    $respone['checkCoin'] = true;
                    return response()->json($respone, 400);
                } 
                
                if($user->online == 1) {
                    $respone['checkOnline'] = true;
                    return response()->json($respone, 400);
                }  

                $oldCoin = $user->coin;

                $user->coin -= $coinChange;
                $user->luong += $coinChange;
                $user->update();
                
                $doicoin = new DoiCoin;
                $doicoin->player_id = $user->id;
                $doicoin->coin = $coinChange;
                $doicoin->old_coin = $oldCoin;
                $doicoin->new_coin = $user->coin ;
                $doicoin->save();

                
                $respone['success'] = true;
                return response()->json($respone, 200);
                
            }   
        }
    }

    public function password(Request $request) {
        if ($request->ajax()) {

            $validator = \Validator::make($request->all(), [
                'oldPassword' => 'required',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required',
            ], [
                'oldPassword.required' => 'Hãy nhập mật khẩu cũ',
                'password.required' => 'Hãy nhập mật khẩu mới',
                'password.confirmed' => 'Xác nhận mật khẩu mới sai',
                'password.min' => 'Độ dài mật khẩu lớn hơn 6',
                'password_confirmation.required' => 'Hãy xác nhận mật khẩu mới',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];

                $user = User::find(Auth::user()->id);
                if($user->password != $request->oldPassword) {
                    $respone['isOld'] = 'Mật khẩu cũ sai';
                    return response()->json($respone, 200);
                } else if ($user->password == $request->password){
                    $respone['isNew'] = 'Mật khẩu mới trùng mật khẩu cũ';
                    return response()->json($respone, 200);
                } else {
                    $user->password = $request->password;
                    $user->update();
                    $respone['success'] = true;
                    return response()->json($respone, 200);
                }
            }   
        }
    }
    
    public function checkout(Request $request) {
        
    }

    public static function confirmCheckout(Request $request, $address) {
        
    }

    public static function rePay(Request $request, $id) {
        
    }

    Public static function buyWebshop(Request $request, $id) {
        if ($request->ajax()) {
            $respone = ['success' => false];

            $user = User::find(Auth::user()->id);
            if($user->online == 1) {
                $respone['success'] = false;
                $respone['isOnline'] = true;
                return response()->json($respone, 400);
            }
            $item = Webshop::find($id);  
            
            if($user->coin < $item->gia_coin) {
                $respone['success'] = false;
                $respone['isCoin'] = true;
                return response()->json($respone, 400);
            }
            
            $ninja = Ninja::where('name', trim($user->ninja, '[""]'))->first();
            if(isset($ninja)) {
                $bag = json_decode($ninja->ItemBag, true);
                if($ninja->maxluggage < count($bag)) {
                    $respone['success'] = false;
                    $respone['isMaxBag'] = true;
                    return response()->json($respone, 400);
                }
                for($i = 0; $i<count($bag); $i++) {
                    $bag[$i]["index"] = $i;
                }
                $temp = json_decode($item->chi_tiet_game, true);
                if(isset($temp["expires"])) {
                    $temp["expires"] += round(microtime(true) * 1000);;
                }
                $temp["index"] = count($bag);
                $bag[] = $temp;
                $ninja->ItemBag = $bag;
                $ninja->timestamps = false;
                $ninja->update();

                $user->coin -= $item->gia_coin;
                $user->update();

                $historyWs = new HistoryWebshop;
                $historyWs->player_id = $user->id;
                $historyWs->ten_vat_pham = $item->ten_vat_pham;
                $historyWs->coin = $item->gia_coin;
                $historyWs->save();

                $respone['success'] = true;
                return response()->json($respone, 200);
            } else {
                $respone['success'] = false;
                $respone['ninja'] = true;
                return response()->json($respone, 400);
            }
             
        }
    }

    Public static function postThe(Request $request) {
        if ($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'telco' => 'required',
                'amount' => 'required',
                'pin' => 'required',
                'serial' => 'required',
            ], [
                'telco.required' => 'Hãy chọn nhà mạng',
                'amount.required' => 'Hãy chọn mệnh giá thẻ',
                'pin.required' => 'Hãy điền mã thẻ',
                'serial.required' => 'Hãy điền số Seri',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];

                switch ($request->telco) {
                    case 1: {
                        $nhaMang = 'VIETTEL';
                        break;
                    }
                    case 2: {
                        $nhaMang = 'VINAPHONE';
                        break;
                    }
                    case 3: {
                        $nhaMang = 'MOBIFONE';
                        break;
                    }
                    case 4: {
                        $nhaMang = 'VNMOBI';
                        break;
                    }
                    case 5: {
                        $nhaMang = 'ZING';
                        break;
                    }
                    case 6: {
                        $nhaMang = 'GATE';
                        break;
                    }
                    default: {
                        $respone['success'] = false;
                        return response()->json($respone, 400);
                    }

                }

                $napThe = new NapTien;
                $napThe->player_id = Auth::user()->id;
                $napThe->nha_mang = $nhaMang;
                $napThe->menh_gia = $request->amount;
                $napThe->ma_the = $request->pin;
                $napThe->ma_seri = $request->serial;
                $napThe->trang_thai = 0;
                $napThe->save();
				
                $curl = curl_init('https://gachthevip.net/api/send-card?request_id='.$napThe->id.'&telco='.$nhaMang.'&pin='.$request->pin.'&serial='.$request->serial.'&amount='.$request->amount);
				
				curl_setopt_array($curl, [
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET',
				]);
						
				curl_setopt($curl, CURLOPT_HTTPHEADER, array(
					'partner_id: 1468527397',
                    'partner_key: daff21006b90a489b12e334c25a08156'
				));

				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                $data = curl_exec($curl);
				
                curl_close($curl);
                $data = json_decode($data, true);

                if($data['status'] == 'success') {
                    $respone['success'] = true;
                    return response()->json($respone, 200);
                }else{
                    $napThe->delete();
                    $respone['success'] = false;
                    return response()->json($respone, 400);
                }
            }
        }
    }
}
