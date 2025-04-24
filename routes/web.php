<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RajaOngkirController;


Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('backend.login');
});
Route::get('/', function () { 
    // return view('welcome'); 
    return redirect()->route('beranda'); 
}); 


Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth');
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');
// Route::resource('backend/user', UserController::class)->middleware('auth');
Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');
Route::get('backend/user', [UserController::class, 'index'])->name('backend.user.index');
Route::resource('backend/kategori', KategoriController::class, ['as' => 'backend']) ->middleware('auth');
Route::resource('backend/produk', ProdukController::class, ['as' => 'backend'])->middleware('auth'); 
// Route untuk menambahkan foto 
Route::post('foto-produk/store', [ProdukController::class, 'storeFoto'])->name('backend.foto_produk.store')->middleware('auth'); 
// Route untuk menghapus foto 
Route::delete('foto-produk/{id}', [ProdukController::class, 'destroyFoto'])->name('backend.foto_produk.destroy')->middleware('auth'); 
// Route untuk laporan user
Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser')->middleware('auth'); 
Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser')->middleware('auth'); 
// Route untuk laporan produk
Route::get('backend/laporan/formproduk', [ProdukController::class, 'formProduk'])->name('backend.laporan.formproduk')->middleware('auth'); 
Route::post('backend/laporan/cetakproduk', [ProdukController::class, 'cetakProduk'])->name('backend.laporan.cetakproduk')->middleware('auth');

// Frontend 
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produk.detail');
Route::get('/produk/kategori/{id}', [ProdukController::class, 'produkkategori'])->name('produk.kategori');
Route::get('/produk/all', [ProdukController::class, 'produkAll'])->name('produk.all');

# API GOOGLE
Route::get('/auth/redirect', [CustomerController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/google/callback', [CustomerController::class, 'callback'])->name('auth.callback');

#Logout
Route::get('/logout', [CustomerController::class, 'logout'])->name('customer.logout');

# Route untuk Customer 
Route::resource('/backend/customer', CustomerController::class, ['as' => 'backend'])->middleware('auth');

Route::middleware('is.customer')->group(function() {
# Route untuk menampilkan halaman akun customer
Route::get('/customer/akun/{id}', [CustomerController::class, 'akun'])->name('customer.akun');
# Route untuk mengupdate akun customer
Route::put('/customer/akun/{id}/update', [CustomerController::class, 'updateAkun'])->name('customer.updateAkun'); 
});

# untuk menambahkan produk kedalam keranjang
Route::post('/add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('order.addToCart');
Route::get('/cart',[OrderController::class, 'viewCart'])->name('order.cart');

# vmkfmvkf

Route::get('/list-ongkir', function () {
    $response = Http::withHeaders([
        'key' => env('KOMERCE_API_KEY') // pastikan ini sesuai isi .env
    ])->get('http://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=sinduharjo&limit=5&offset=0');

    dd($response->json());
}); 

Route::get('/cek-ongkir', function () { 
    return view('ongkir'); 
}); 
 
Route::get('/provinces', [RajaOngkirController::class, 'getProvinces']); 
Route::get('/cities', [RajaOngkirController::class, 'getCities']); 
Route::post('/cost', [RajaOngkirController::class, 'getCost']); 