<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


        Route::get('/', [PageController::class, 'index'])->name('index');

Route::get('/phpmyadmin', [PageController::class, 'phpmyadmin'])->name('phpmyadmin');

Route::get('captcha-form', [CaptchaController::class, 'captchForm'])->name('getcapcha');
Route::post('store-captcha-form', [CaptchaController::class, 'storeCaptchaForm'])->name('postcapcha');

Route::get('/tai-game', [PageController::class, 'download'])->name('index.download');

Route::get('/tin-tuc', [PageController::class, 'news'])->name('index.news');

Route::get('/tin-tuc/{id}/{slug}', [PageController::class, 'detailNews'])->name('index.detailNews');


Route::post('momo-api-callback/romcoca', [ApiController::class, 'callbackMomo'])->name('momo.callback');
Route::get('the-cao-api-callback-2/romcoca', [ApiController::class, 'callbackTheCao'])->name('thecao.callback');



Route::prefix('/')->middleware('login')->group(function () {
    Route::get('dang-nhap', [PageController::class, 'login'])->name('index.login');
    Route::get('dang-ky', [PageController::class, 'register'])->name('index.register');

    Route::post('dang-nhap', [AuthController::class, 'login'])->name('auth.login');
    Route::post('dang-ky', [AuthController::class, 'register'])->name('auth.register');
});

Route::prefix('/')->middleware('auth')->group(function () {

    Route::get('/huong-dan-nap-tien', [PageController::class, 'huongDan'])->name('index.huongDan');

    Route::prefix('chuc-nang')->group(function () {
        Route::get('/', [PageController::class, 'chucnang'])->name('index.chucnang');

        Route::get('/nap-tien', [PageController::class, 'checkout'])->name('index.checkout');

        Route::get('/nap-the-dien-thoai', [PageController::class, 'thedienthoai'])->name('index.theDienThoai');
        Route::post('/nap-the-dien-thoai', [AuthController::class, 'postThe'])->name('auth.postThe');

        Route::get('/webshop', [PageController::class, 'webshop'])->name('index.webshop');
        Route::post('/webshop/{id}', [AuthController::class, 'buyWebshop'])->name('index.buyWebshop');
    });

    Route::prefix('thong-tin-tai-khoan')->group(function () {
        Route::get('/', [PageController::class, 'profile'])->name('index.profile');

        Route::post('email', [AuthController::class, 'email'])->name('auth.email');

        Route::post('kich-hoat', [AuthController::class, 'active'])->name('auth.active');
        Route::post('kich-hoat-tn', [AuthController::class, 'activeTN'])->name('auth.activetn');
        Route::post('nang-cap-tai-khoan', [AuthController::class, 'upgrade'])->name('auth.upgrade');

        Route::post('doi-coin-luong', [AuthController::class, 'changeCoinLuong'])->name('auth.changeCoinLuong');

        Route::get('doi-mat-khau', [PageController::class, 'password'])->name('index.password');
        Route::post('doi-mat-khau', [AuthController::class, 'password'])->name('auth.password');

        Route::get('lich-su-giao-dich', [PageController::class, 'history'])->name('index.history');
        Route::get('lich-su-giao-dich/thanh-toan-lai/{id}', [AuthController::class, 'rePay'])->name('index.rePay');
    });

    Route::get('dang-xuat', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::prefix('quan-ly-tai-khoan')->group(function () {
        Route::get('/', [AdminController::class, 'user'])->name('admin.user');

        Route::post('xoa-nhan-vat', [AdminController::class, 'delete'])->name('admin.delete');
        Route::post('xoa-tai-khoan', [AdminController::class, 'deletePlayer'])->name('admin.deletePlayer');
        Route::post('kick-hoat-all', [AdminController::class, 'activeAll'])->name('admin.activeAll');
        Route::post('huy-kick-hoat-all', [AdminController::class, 'unActiveAll'])->name('admin.unActiveAll');

        Route::post('khoa/{id}', [AdminController::class, 'ban'])->name('admin.ban');
        Route::post('kich-hoat/{id}', [AdminController::class, 'lock'])->name('admin.lock');
        Route::post('xet-quyen/{id}', [AdminController::class, 'role'])->name('admin.role');
        
        Route::get('xem/{id}', [AdminController::class, 'view'])->name('admin.view');

        Route::get('cong-coin/{id}', [AdminController::class, 'plusCoin'])->name('admin.plusCoin');
        Route::post('cong-coin/{id}', [AdminController::class, 'postPlusCoin'])->name('admin.postPlusCoin');
    });

    Route::prefix('thong-ke-giao-dich')->group(function () {
        Route::get('/', [AdminController::class, 'history'])->name('admin.history');

    });

    Route::prefix('upload')->group(function () {
        Route::get('/', [AdminController::class, 'upload'])->name('admin.upload');

        Route::get('them-moi', [AdminController::class, 'addUpload'])->name('admin.addUpload');
        Route::post('them-moi', [AdminController::class, 'postUpload'])->name('admin.postUpload');

        Route::get('sua/{id}', [AdminController::class, 'editUpload'])->name('admin.editUpload');
        Route::post('sua/{id}', [AdminController::class, 'postEdit'])->name('admin.postEdit');

        Route::post('xoa/{id}', [AdminController::class, 'deleteUpload'])->name('admin.deleteUpload');
    });

    Route::prefix('webshop')->group(function () {
        Route::get('/', [AdminController::class, 'webshop'])->name('admin.webshop');

        Route::get('them-moi', [AdminController::class, 'addWebshop'])->name('admin.addWebshop');
        Route::post('them-moi', [AdminController::class, 'postAddWebshop'])->name('admin.postAddWebshop');

        Route::get('sua/{id}', [AdminController::class, 'editWebshop'])->name('admin.editWebshop');
        Route::post('sua/{id}', [AdminController::class, 'postEditWebshop'])->name('admin.postEditWebshop');

        Route::post('xoa/{id}', [AdminController::class, 'deleteWebshop'])->name('admin.deleteWebshop');

    });

    Route::prefix('huong-dan-nap-tien')->group(function () {
        Route::get('/', [AdminController::class, 'huongDan'])->name('admin.huongDan');

        Route::post('/', [AdminController::class, 'updateHuongDan'])->name('admin.updateHuongDan');
    });

    Route::prefix('quan-ly-tin-tuc')->group(function () {
        Route::get('/', [AdminController::class, 'news'])->name('admin.news');

        Route::get('/random-giftcode', [AdminController::class, 'randomCode'])->name('admin.randomCode');

        Route::get('them-moi', [AdminController::class, 'addNews'])->name('admin.addNews');
        Route::post('them-moi', [AdminController::class, 'postNews'])->name('admin.postNews');
        
        Route::get('sua/{id}', [AdminController::class, 'editNews'])->name('admin.editNews');
        Route::post('sua/{id}', [AdminController::class, 'postEditNews'])->name('admin.postEditNews');

        Route::post('xoa/{id}', [AdminController::class, 'deleteNews'])->name('admin.deleteNews');
    });

    Route::prefix('quan-ly-gift-code')->group(function () {
        Route::get('/', [AdminController::class, 'giftcode'])->name('admin.giftcode');

        Route::get('them-moi', [AdminController::class, 'addCode'])->name('admin.addCode');
        Route::post('them-moi', [AdminController::class, 'postCode'])->name('admin.postCode');
        
        Route::get('sua/{id}', [AdminController::class, 'editCode'])->name('admin.editCode');
        Route::post('sua/{id}', [AdminController::class, 'postEditCode'])->name('admin.postEditCode');

        Route::post('xoa/{id}', [AdminController::class, 'deleteCode'])->name('admin.deleteCode');

    });
});

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

Route::any('/ckfinder/examples/{example?}', 'CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
    ->name('ckfinder_examples');




