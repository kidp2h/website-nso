<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DoiCoin;
use App\Models\CheckOut;
use App\Models\FileUpload;
use App\Models\HistoryCoin;
use App\Models\HistoryMomo;
use App\Models\Post;
use App\Models\Webshop;
use App\Models\HistoryWebshop;
use App\Models\User;
use App\Models\NapTien;
use Illuminate\Support\Facades\Http;
class PageController extends Controller
{
    //
    public static function index() {
        return view('pages.index');
    }

    public static function huongDan() {
        $data = Post::find(1);
        return view('pages.huong-dan', compact('data'));
    }
    
    public static function phpmyadmin() {
        return view('pages.phpmyadmin');
    }

    public static function login() {
        return view('pages.login');
    }

    public static function register() {
        return view('pages.register');
    }

    public static function download() {
        $file = FileUpload::where('type', '<>', 0)->get();
        return view('pages.download', compact('file'));
    }

    public static function news() {
        $news = Post::where('id', '<>', 1)->orderBy('id', 'desc')->get();
        return view('pages.news', compact('news'));
    }

    public static function detailNews($id) {
        $news = Post::find($id);
		$news->view += 1;
		$news->update();
        return view('pages.detail', compact('news'));
    }

    public static function chucnang() {
        return view('pages.chuc-nang');
    }

    public static function profile() {
        return view('pages.Profile.index');
    }
    
    public static function checkout() {
        return view('pages.NapTien.index');
    }

    public static function webshop() {
        $webshop = Webshop::all();
        return view('pages.Webshop.index', compact('webshop'));
    }

    public static function password() {
        return view('pages.Profile.password');
    }

    public static function history() {
        $doi_coin = DoiCoin::where('player_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $momo = HistoryMomo::where('player_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $coinAdmin = HistoryCoin::where('player_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $webshop = HistoryWebshop::where('player_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $napTien = NapTien::where('player_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $now = \Carbon\Carbon::now();
        return view('pages.Profile.history', compact('doi_coin', 'momo','now', 'coinAdmin', 'webshop', 'napTien'));
    }
    
    public static function changeDogeCoin(Request $request, $value) {
        if ($request->ajax()) {
            $response = ['success' => false];

            $api_dogecoin = Http::get('https://api.coingecko.com/api/v3/coins/dogecoin');
            
            if (isset($api_dogecoin)) {
                $api_dogecoin = json_decode($api_dogecoin, true);
                $dogecoin = $api_dogecoin['market_data']['current_price']['vnd'];

                $dc = $value/$dogecoin;

                $response['dogecoin'] = number_format($dc,4, '.', '');  
                $response['vnd'] = number_format($value);  
                $response['success'] = true;
                return response()->json($response, 200);
            } 
            return response()->json($response, 400); 
        }
    }

    public static function thedienthoai() {
        return view('pages.NapTien.dienthoai');
    }

    

 
}
