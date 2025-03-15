<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\CheckAge;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\backend\PengalamanKerjaController;
use App\Http\Controllers\backend\PendidikanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ApiPendidikanController;

//Acara 3
Route::get('/', function () {
    return view('welcome');
// Route::get('/index', function () {
//     return view('welcome');
// });
// Route::get('/user', [UserController::class, 'index']);

// Route::match(['get', 'post'], '/', function () {
//     return 'ini match';
// });
// Route::any('/', function () {
//     return 'ini any';
});

Route::redirect('/here', 'there', 301);
Route::view('/welcome2', 'welcome');
Route::view('/welcome3', 'welcome')->name('Taylor');
Route::get('user/acara3/{name?}', function ($name = null) {
    return $name;
});
Route::get('user/acara3/{name?}', function ($name = "John") {
    return $name;
});
Route::get('user//acara3/{name}', function ($name) {

})->where('name', '[A-Za-z]+');
Route::get('user/{id}', function ($id) { })->where('id', '[0-9]+');
Route::get('user/{id}{name}', function ($id, $name) { })->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
Route::get('user/{id}', function ($id) {
});
Route::get('search/{search}', function ($search) {
    return $search;
})->where('search', '.*');


//Acara 4
Route::get('/user/{id}/profile', function ($id) {
    return "Profil user dengan ID $id";
})->name('profile');

Route::get('/generate-url', function () {
    $url = route('profile', ['id' => 5]);
    return "URL ke profile: $url";
});

Route::get('/redirect-profile', function () {
    return redirect()->route('profile', ['id' => 5]);
});

Route::middleware(['first', 'second'])->group(function () {
    Route::get('/first', function () {
    });
    Route::get('/user/profile', function () {
    });
});
Route::
        namespace('Admin')->group(function () { });

Route::domain('{account).myapp.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
    });
});
Route::prefix('admin')->group(function () {
    Route::get('users', function () {
    });
});
Route::name('admin')->group(function () {
    Route::get('users', function () {
    })->name('users');
});

//Acara 5
Route::get('user', [ManagementUserController::class, 'index']);
Route::get('user/create', [ManagementUserController::class, 'create']);
Route::post('user', [ManagementUserController::class, 'store']);
Route::get('user/{id}', [ManagementUserController::class, 'show']);
Route::get('user/{id}/edit', [ManagementUserController::class, 'edit']);
Route::put('user/{id}', [ManagementUserController::class, 'update']);
Route::delete('user/{id}', [ManagementUserController::class, 'destroy']);

//Acara 6
Route::get('/home', [ManagementUserController::class, 'index']);

//Acara 7
Route::resource('/homeacara7', HomeController::class);

//Acara 8
Route::get('dashboard', [DashboardController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Acara 12
Route::get('/admin/profile1', function () {

})->middleware('auth');
Route::get('/1', function () {

})->middleware('first', 'second');
Route::get('/admin/profile2', function () {

})->middleware(CheckAge::class);

Route::get('/2', function () {

})->middleware('web');
Route::group(['middleware' => ['web']], function () { });
ROute::middleware(['web', 'subscribed'])->group(function () {

});
Route::put('post/{id}', function () {

})->middleware('role:editor');

//Acara 13
Route::group(['namespace' => ''], function () {
    Route::resource('pendidikan', 'PendidikanController');
    Route::resource('pengalaman_kerja', PengalamanKerjaController::class);
});

Route::group(['namespace' => 'Backend'], function () {
    Route::resource('dashboard', 'DashboardController');
    Route::resource('pendidikan', 'PendidikanController');
});

//Acara 15
Route::resource('pendidikan', PendidikanController::class);

//Acara 17
//create
Route::get('/session/create', [SessionController::class, 'create']);
//show
Route::get('/session/show', [SessionController::class, 'show']);
//delete
Route::get('/session/delete', [SessionController::class, 'delete']);
//menangkap data melalui URL
Route::get('/pegawai/{nama}', [PegawaiController::class, 'index']);
//menangkap data melalui inputan
Route::get('/formulir', [PegawaiController::class, 'formulir']);
Route::post('/formulir/proses', [PegawaiController::class, 'proses']);

//Acara 18
Route::post('/formulir/proses', [PegawaiController::class, 'proses']);
//cobaerror

Route::get('/cobaerror/{nama?}', [CobaController::class, 'index']);

//Acara 19
Route::get('/upload', [UploadController::class, 'upload'])->name('upload');
Route::post('/upload/proses', [UploadController::class, 'proses_upload'])->name('upload.proses');

Route::get('/upload', [UploadController::class, 'upload'])->name('upload');
Route::post('/upload/resize', [UploadController::class, 'resize_upload'])->name('upload.resize');

//Acara 20
//dropzne
Route::get('/dropzone', [UploadController::class, 'dropzone']);
Route::post('/dropzone/store', [UploadController::class, 'dropzone_store'])->name('dropzone.store');

//PDF Upload
Route::get('/pdf_upload', [UploadController::class, 'pdf_upload'])->name('pdf_upload');
Route::post('/pdf_store', [UploadController::class, 'pdf_store'])->name('pdf_store');