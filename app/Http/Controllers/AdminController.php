<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Ninja;
use App\Models\FileUpload;
use App\Models\Post;
use App\Models\Webshop;
use App\Models\HistoryCoin;
use App\Models\CheckOut;
use App\Models\DoiCoin;
use App\Models\HistoryWebshop;
use App\Models\CloneNinja;
use App\Models\XepHangLevel;
use App\Models\ClanManager;
use App\Models\GiftCode;
use App\Models\HistoryMomo;
use App\Models\NapTien;

class AdminController extends Controller
{
    //

    public static function index() {
        return view('admin.index');
    }
    
    public static function upload() {
        $file = FileUpload::all();
        return view('admin.Upload.index', compact('file'));
    }

    public static function addUpload() {
        return view('admin.Upload.add');
    }

    public static function editUpload($id) {
        $file = FileUpload::find($id);
        return view('admin.Upload.edit', compact('file'));
    }

    public static function webshop() {
        $webshop = Webshop::all();
        return view('admin.Webshop.index', compact('webshop'));
    }

    public static function addWebshop() {
        return view('admin.Webshop.add');
    }

    public static function editWebshop($id) {
        $webshop = Webshop::find($id);
        return view('admin.Webshop.edit', compact('webshop'));
    }
    
    public static function huongDan() {
        $data = Post::find(1);
        return view('admin.HuongDan.index', compact('data'));
    }

    public static function news() {
        $news = Post::where('id', '<>', 1)->get();
        return view('admin.TinTuc.index', compact('news'));
    }

    public static function history() {
        
        $momo = HistoryMomo::orderBy('id', 'desc')->get();
        $admin = HistoryCoin::orderBy('id', 'desc')->get();
        $doiCoin = DoiCoin::orderBy('id', 'desc')->get();
        $webshop = HistoryWebshop::orderBy('id', 'desc')->get();
        $naptien = NapTien::orderBy('id', 'desc')->get();
        $count1 = count($momo) + count($admin) + count($doiCoin) + count($webshop);
        $count2= 0;
        $count3= 0;
        $count4= 0;
        foreach ($momo as $item) {
            $count2 += $item->money;
            $count3 += $item->coin;
        }
        foreach ($doiCoin as $item) {
            $count3 += $item->coin;
        }
        foreach ($webshop as $item) {
            $count3 += $item->coin;
        }
        foreach ($admin as $item) {
            $count3 += $item->coin;
        }
        foreach ($naptien as $item) {
            $count3 += $item->so_tien;
            $count4 += $item->menh_gia;
        }
        return view('admin.History.index', compact('count1','count2', 'count3', 'count4','momo', 'admin', 'doiCoin', 'webshop', 'naptien'));
    }

    public static function addNews() {
        return view('admin.TinTuc.add');
    }
    
    public static function editNews($id) {
        $news = Post::find($id);
        return view('admin.TinTuc.edit', compact('news'));
    }

    public static function user() {
        $user = User::all();
        return view('admin.User.index', compact('user'));
    }

    public static function giftcode() {
        $giftcode = GiftCode::all();
        return view('admin.GiftCode.index', compact('giftcode'));
    }

    public static function randomCode(Request $request) {
        if($request->ajax()) {
            $respone = ['success' => true];

            $isCheck = true;
            while($isCheck) {
                $code = 'NSOHOIUC'.strtoupper(\Str::random(7));
                $check = GiftCode::where('code', $code)->first();
                if(!isset($check)){
                    $isCheck = false;
                }
            }
            
            $respone['code'] = $code;
            return response()->json($respone, 200);
            
        }
    }

    public static function addCode() {
        return view('admin.GiftCode.add');
    }

    public static function editCode($id) {
        $giftcode = GiftCode::find($id);
        return view('admin.GiftCode.edit', compact('giftcode'));
    }

    public static function view($id) {
        $user = User::find($id);
        $momo = HistoryMomo::where('player_id', $id)->orderBy('id', 'desc')->get();
        $admin = HistoryCoin::where('player_id', $id)->orderBy('id', 'desc')->get();
        $doiCoin = DoiCoin::where('player_id', $id)->orderBy('id', 'desc')->get();
        $webshop = HistoryWebshop::where('player_id', $id)->orderBy('id', 'desc')->get();
        $naptien = NapTien::where('player_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.User.detail', compact('user', 'momo', 'doiCoin', 'webshop', 'admin', 'naptien'));
    }

    public static function plusCoin(Request $request, $id) {
        if($request->ajax()) {
            $respone = ['success' => false];
            $user = User::find($id);
            if(isset($user)) {
                $data = view('admin.User.modal_pluscoin', compact('user'))->render();
                $respone['success'] = true;
                $respone['data'] = $data;
                return response()->json($respone, 200);
            }
            return response()->json($respone, 400);
        }
            
    }

    public static function ban(Request $request, $id) {
        if($request->ajax()) {
            $user = User::find($id);
            if(isset($user) && $user->id != Auth::user()->id) {
                $respone = ['success' => true];
                if($user->ban == 0) {
                    $user->ban = 1;
                    $user->update();
                    $respone['success'] = true;
                    $respone['ban'] = true;
                    return response()->json($respone, 200);
                } else if($user->ban == 1) {
                    $user->ban = 0;
                    $user->update();
                    $respone['success'] = true;
                    $respone['unBan'] = true;
                    return response()->json($respone, 200);
                }
            } else {
                $respone = ['success' => false];
                return response()->json($respone, 400);
            }
        }
    }

    public static function lock(Request $request, $id) {
        if($request->ajax()) {
            $user = User::find($id);
            if(isset($user) && $user->id != Auth::user()->id) {
                $respone = ['success' => true];
                if($user->lock == 0) {
                    $user->lock = 1;
                    $user->status = 0;
                    $user->update();
                    $respone['success'] = true;
                    $respone['lock'] = true;
                    return response()->json($respone, 200);
                } else if($user->lock == 1) {
                    $user->lock = 0;
                    $user->status = 0;
                    $user->update();
                    $respone['success'] = true;
                    $respone['unLock'] = true;
                    return response()->json($respone, 200);
                }
            } else {
                $respone = ['success' => false];
                return response()->json($respone, 400);
            }
        }
    }

    public static function role(Request $request, $id) {
        if($request->ajax()) {
            $user = User::find($id);
            if(isset($user) && $user->id != Auth::user()->id) {
                $respone = ['success' => true];
                if($user->role == 0) {
                    $user->role = 9999;
                    $user->update();
                    $respone['success'] = true;
                    $respone['lock'] = true;
                    return response()->json($respone, 200);
                } else if($user->role == 9999) {
                    $user->role = 0;
                    $user->update();
                    $respone['success'] = true;
                    $respone['unLock'] = true;
                    return response()->json($respone, 200);
                }
            } else {
                $respone = ['success' => false];
                return response()->json($respone, 400);
            }
        }
    } 

    public static function deletePlayer(Request $request) {
        if($request->ajax()) {
            set_time_limit(0);
            $user = User::where('role', '<>', 9999)->where('ninja',  '[]')->where('lock', 1)->get();
            $respone = ['success' => false];

            foreach($user as $item) {
                $item->delete();
            }

            // $user = User::all();
            // $data = [];
            // foreach($user as $item) {
            //     $data[] = $item->username;
            // }
            // $respone['data'] = $data;

            $respone['success'] = true;
            
            return response()->json($respone, 200);
        }
    }
    
    public static function delete(Request $request) {
        if($request->ajax()) {
            set_time_limit(0);
            $user = User::all();
            $respone = ['success' => false];

            foreach($user as $item) {
                $item->ninja = '[]';
                if($item->role != 9999) {
                    $item->luong = 0;
                    $item->coin = 0;
                    $item->ban = 0;
                    $item->lock = 1;
                }
                $item->update();
            }

            Ninja::truncate();
            CloneNinja::truncate();
            ClanManager::truncate();
            XepHangLevel::truncate();
            $respone['success'] = true;
            return response()->json($respone, 200);
        }
    }

    public static function activeAll(Request $request) {
        if($request->ajax()) {
            set_time_limit(0);
            $user = User::all();
            $respone = ['success' => false];

            foreach($user as $item) {
                $item->lock = 0;
                $item->status = 0;
                $item->update();
            }

            $respone['success'] = true;
            return response()->json($respone, 200);
        }
    }

    public static function unActiveAll(Request $request) {
        if($request->ajax()) {
            set_time_limit(0);
            $user = User::all();
            $respone = ['success' => false];

            foreach($user as $item) {
                if($item->role != 9999){
                    $item->lock = 1;
                    $item->update();
                } 
            }

            $respone['success'] = true;
            return response()->json($respone, 200);
        }
    }
    
    public static function postUpload(Request $request) {
        if($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'name.*' => 'required',
                'type.*' => 'required',
                'file.*' => 'required',
            ], [
                'name.*.required' => 'Hãy nhập tên sản phẩm!',
                'type.*.required' => 'Hãy nhập tên sản phẩm!',
                'file.*.required' => 'Hãy nhập tên sản phẩm!',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];

                $files = $request->file('file');
                $type = $request->type;
                $name = $request->name;
                if(isset($files)){
                    $i = 0;
                    foreach ($files as $file) {
                        if(isset($file)) {
                            $fu = new FileUpload;
                            $fileName = \Str::random(5) . '_' . $file->getClientOriginalName();
                            $destinationPath = public_path('upload/file');
                            $file->move($destinationPath, $fileName);

                            $fu->name = $file->getClientOriginalName();

                            $fu->link= "upload/file/".$fileName;
                            $fu->type= $type[$i];
                            $fu->name= $name[$i];
                            
                            $fu->save();
                        }
                        $i++;
                    }
                    $respone['success'] = true;
                    return response()->json($respone, 200);
                }
                $respone['success'] = false;
                return response()->json($respone, 400);
                
            }
        }
    }

    public static function postEdit(Request $request, $id) {
        if($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'type' => 'required',
            ], [
                'name.required' => 'Hãy nhập tên sản phẩm!',
                'type.required' => 'Hãy nhập tên sản phẩm!',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];

                $file = FileUpload::find($id);
                $file->type = $request->type;
                $file->name = $request->name;
                $file->update();
               
                $respone['success'] = true;
                return response()->json($respone, 200);

            }
        }
    }

    public static function deleteUpload(Request $request, $id) {
        if($request->ajax()) {
            $respone = ['success' => false];

            $file = FileUpload::find($id);
            if(isset($file)) {
                \File::delete($file->link);
                $file->delete();
                $respone['success'] = true;
                return response()->json($respone, 200);
            } 
            $respone['success'] = false;
            return response()->json($respone, 400);
        }
    }

    public static function updateHuongDan(Request $request) {
        if($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'content' => 'required',
            ], [
                'content.required' => 'Hãy nhập tên sản phẩm!',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];

                $post = Post::find(1);
                if(isset($post)) {
                    $post->content = $request->content;
                    $post->update();
                   
                    $respone['success'] = true;
                    return response()->json($respone, 200);
                } else {
                    $respone['success'] = false;
                    return response()->json($respone, 400);
                }
                

            }
        }
    }

    public static function postNews(Request $request) {
        if($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'title' => 'required|unique:posts,title',
                'content' => 'required',
                'short_content' => 'required',
                'image' => 'image',
            ], [
                'content.required' => 'Hãy nhập nội dung bài viết',
                'title.required' => 'Hãy nhập tiêu đề bài viết',
                'title.unique' => 'Tên bài viết đã trùng lặp',
                'short_content.required' => 'Hãy nhập nội dung tắm tắt',
                'image.image' => 'Ảnh tải lên sai định dạng',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];

                $post = new Post;
                
                $post->content = $request->content;
                $post->short_content = $request->short_content;
                $post->title = $request->title;
                $post->slug = \Str::slug($request->title, '-');
                $post->user_id = Auth::user()->id;
                $post->view = 0;

                

                if($request->hasFile('image')) {
                    $file = $request->file('image');
                    $fileName = \Str::random(10) . '_' . $file->getClientOriginalName();
                    $destinationPath = public_path('upload/file');
                    $file->move($destinationPath, $fileName);
                    $post->image= "upload/file/".$fileName;
                }
            
    
                $post->save();
                   
                $respone['success'] = true;
                return response()->json($respone, 200);
            }
        }
    }

    public static function postEditNews(Request $request, $id) {
        if($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'title' => 'required|unique:posts,title,'.$id,
                'content' => 'required',
                'short_content' => 'required',
            ], [
                'content.required' => 'Hãy nhập nội dung bài viết',
                'title.required' => 'Hãy nhập tiêu đề bài viết',
                'title.unique' => 'Tên bài viết đã trùng lặp',
                'short_content.required' => 'Hãy nhập nội dung tắm tắt',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];

                $post = Post::find($id);
                if(isset($post)) {
                    $post->content = $request->content;
                    $post->short_content = $request->short_content;
                    $post->title = $request->title;
                    $post->slug = \Str::slug($request->title, '-');
                    \File::delete($post->image);
                    if($request->hasFile('image')) {
                        $file = $request->file('image');
                        $fileName = \Str::random(10) . '_' . $file->getClientOriginalName();
                        $destinationPath = public_path('upload/file');
                        $file->move($destinationPath, $fileName);
                        $post->image= "upload/file/".$fileName;
                    }
                
                    $post->update();
                       
                    $respone['success'] = true;
                    return response()->json($respone, 200);
                }
                
                $respone['success'] = false;
                    return response()->json($respone, 400);
            }
        }
    }

    public static function deleteNews(Request $request, $id) {
        if($request->ajax()) {
            $respone = ['success' => false];

            $post = Post::find($id);
            if(isset($post)) {
                \File::delete($post->image);
                $post->delete();
                $respone['success'] = true;
                return response()->json($respone, 200);
            } 
            $respone['success'] = false;
            return response()->json($respone, 400);
        }
    }

    public static function postAddWebshop(Request $request) {
        if($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'ten_vat_pham' => 'required|unique:webshop,ten_vat_pham',
                'gia_coin' => 'required|numeric|min:1',
                'chi_tiet_webshop' => 'required',
                'chi_tiet_game' => 'required',
            ], [
                'ten_vat_pham.required' => 'Hãy nhập tên vật phẩm',
                'gia_coin.required' => 'Hãy nhập giá coin',
                'chi_tiet_webshop.required' => 'Hãy nhập mô tả',
                'chi_tiet_game.required' => 'Hãy nhập Option vật phẩm trong game',
                'ten_vat_pham.unique' => 'Tên vật phẩm này đã tồn tại',
                'gia_coin.numeric' => 'Giá coin sai định dạng',
                'gia_coin.min' => 'Giá coin nhỏ nhất là 1',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];

                $post = new Webshop;
                
                $post->ten_vat_pham = $request->ten_vat_pham;
                $post->gia_coin = $request->gia_coin;
                $post->chi_tiet_webshop = $request->chi_tiet_webshop;
                $post->chi_tiet_game = $request->chi_tiet_game;

                if($request->hasFile('hinh_anh')) {
                    $file = $request->file('hinh_anh');
                    $fileName = \Str::random(10) . '_' . $file->getClientOriginalName();
                    $destinationPath = public_path('upload/file');
                    $file->move($destinationPath, $fileName);
                    $post->hinh_anh= "upload/file/".$fileName;
                }
        
                $post->save();

                $respone['success'] = true;
                return response()->json($respone, 200);
            }
        }
    }

    public static function postEditWebshop(Request $request, $id) {
        if($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'ten_vat_pham' => 'required|unique:webshop,ten_vat_pham,'.$id,
                'gia_coin' => 'required|numeric|min:1',
                'chi_tiet_webshop' => 'required',
                'chi_tiet_game' => 'required',
            ], [
                'ten_vat_pham.required' => 'Hãy nhập tên vật phẩm',
                'gia_coin.required' => 'Hãy nhập giá coin',
                'chi_tiet_webshop.required' => 'Hãy nhập mô tả',
                'chi_tiet_game.required' => 'Hãy nhập Option vật phẩm trong game',
                'ten_vat_pham.unique' => 'Tên vật phẩm này đã tồn tại',
                'gia_coin.numeric' => 'Giá coin sai định dạng',
                'gia_coin.min' => 'Giá coin nhỏ nhất là 1',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];

                $post = Webshop::find($id);
                
                $post->ten_vat_pham = $request->ten_vat_pham;
                $post->gia_coin = $request->gia_coin;
                $post->chi_tiet_webshop = $request->chi_tiet_webshop;
                $post->chi_tiet_game = $request->chi_tiet_game;

                if($request->hasFile('hinh_anh')) {
                    if(isset($post->hinh_anh)) {
                        \File::delete($post->hinh_anh);
                    }
                    $file = $request->file('hinh_anh');
                    $fileName = \Str::random(10) . '_' . $file->getClientOriginalName();
                    $destinationPath = public_path('upload/file');
                    $file->move($destinationPath, $fileName);
                    $post->hinh_anh= "upload/file/".$fileName;
                }
        
                $post->update();

                $respone['success'] = true;
                return response()->json($respone, 200);

            }
        }
    }

    public static function deleteWebshop(Request $request, $id) {
        if($request->ajax()) {
            
                $respone = ['success' => false];
                $post = Webshop::find($id);
                if(isset($post->hinh_anh)) {
                    \File::delete($post->hinh_anh);
                }
                $post->delete();
                $respone['success'] = true;
                return response()->json($respone, 200);
        }
    }

    public static function postPlusCoin(Request $request, $id) {
        if($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'coin' => 'required|numeric',
            ], [
                'coin.required' => 'Hãy nhập coin',
                'coin.numeric' => 'Coin sai định dạng',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];
                $user = User::find($id);
                if(isset($user)) {

                    $oldCoin = $user->coin;
                    
                    $user->coin += round($request->coin);
                    $user->update();

                    $historyCoin = new HistoryCoin;
                    $historyCoin->player_id = $user->id;
                    $historyCoin->coin = $request->coin;
                    $historyCoin->old_coin = $oldCoin;
                    $historyCoin->new_coin = $user->coin;
                    $historyCoin->desc = $request->ghi_chu;
                    $historyCoin->save();

                    $respone['success'] = true;
                    return response()->json($respone, 200);
                }
                return response()->json($respone, 400);
            }
        }
            
    }

    public static function postCode(Request $request) {
        if($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'code' => 'required|unique:gift_code,code',
                'item_id' => 'required',
                'item_quantity' => 'required',
                'item_isLock' => 'required',
                'item_expires' => 'required',
            ], [
                'code.required' => 'Hãy nhập code',
                'code.unique' => 'Code này đã tồn tại',
                'item_id.required' => 'Hãy nhập danh sách vật phẩm',
                'item_quantity.required' => 'Hãy nhập danh sách số lượng',
                'item_isLock.required' => 'Hãy nhập danh sách trạng thái',
                'item_expires.required' => 'Hãy nhập danh sách thời hạn sử dụng vật phẩm',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];
                $idItem = explode (",",str_replace(" ", "",$request->item_id));
                $quantityItem = explode (",",str_replace(" ", "",$request->item_quantity));
                $lockItem = explode (",",str_replace(" ", "",$request->item_isLock));
                $expiresItem = explode (",",str_replace(" ", "",$request->item_expires));

                if(count($idItem) == count($quantityItem) && count($idItem) == count($lockItem) && count($idItem) == count($expiresItem)) {
                    $code = new GiftCode;
                    $code->code = strtoupper($request->code);
                    $code->item_id = json_encode($idItem);
                    $code->item_quantity =json_encode($quantityItem);
                    $code->item_isLock = json_encode($lockItem);
                    $code->item_expires = json_encode($expiresItem);
                    $code->isPlayer=0;
                    $code->isTime=0;
                    if(strlen(str_replace(" ", "",$request->player)) > 0) {
                        $code->isPlayer = 1;
                        $code->player = json_encode(explode (",",str_replace(" ", "",$request->player)));
                    }
                    if(isset($request->time)) {
                        $code->isTime = 1;
                        $code->time = $request->time;
                    }
                    $code->save();
            
                    $respone['success'] = true;
                    return response()->json($respone, 200);
                } else {
                    $respone['success'] = false;
                    $respone['isLength'] = true;
                    return response()->json($respone, 400);
                }
            }
        }
            
    }

    public static function postEditCode(Request $request, $id) {
        if($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'code' => 'required|unique:gift_code,code,'.$id,
                'item_id' => 'required',
                'item_quantity' => 'required',
                'item_isLock' => 'required',
                'item_expires' => 'required',
            ], [
                'code.required' => 'Hãy nhập code',
                'code.unique' => 'Code này đã tồn tại',
                'item_id.required' => 'Hãy nhập danh sách vật phẩm',
                'item_quantity.required' => 'Hãy nhập danh sách số lượng',
                'item_isLock.required' => 'Hãy nhập danh sách trạng thái',
                'item_expires.required' => 'Hãy nhập danh sách thời hạn sử dụng vật phẩm',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            } else {
                $respone = ['success' => false];
                $idItem = explode (",",str_replace(" ", "",$request->item_id));
                $quantityItem = explode (",",str_replace(" ", "",$request->item_quantity));
                $lockItem = explode (",",str_replace(" ", "",$request->item_isLock));
                $expiresItem = explode (",",str_replace(" ", "",$request->item_expires));

                if(count($idItem) == count($quantityItem) && count($idItem) == count($lockItem) && count($idItem) == count($expiresItem)) {
                    $code = GiftCode::find($id);
                    $code->code = $request->code;
                    $code->item_id = json_encode($idItem);
                    $code->item_quantity =json_encode($quantityItem);
                    $code->item_isLock = json_encode($lockItem);
                    $code->item_expires = json_encode($expiresItem);
                    $code->isPlayer=0;
                    $code->isTime=0;
                    if(strlen(str_replace(" ", "",$request->player)) > 0) {
                        $code->isPlayer = 1;
                        $code->player = json_encode(explode (",",str_replace(" ", "",$request->player)));
                    }
                    if(isset($request->time)) {
                        $code->isTime = 1;
                        $code->time = $request->time;
                    }
                    $code->update();
            
                    $respone['success'] = true;
                    return response()->json($respone, 200);
                } else {
                    $respone['success'] = false;
                    $respone['isLength'] = true;
                    return response()->json($respone, 400);
                }

                

            }
        }
            
    }

    public static function deleteCode(Request $request, $id) {
        if($request->ajax()) {
            $respone = ['success' => false];
            $code = GiftCode::find($id);
            if(isset($code)) {
                $code->delete();
                $respone['success'] = true;
                return response()->json($respone, 200);
            } 
            return response()->json($respone, 400);
        }
    }
}
