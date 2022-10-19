<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrnadController;

use App\Http\Controllers\Frontend\IndexController;

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

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});


// Admin Auth and Profile all route

// Admin Dashboard
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

// Admin Logout
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

// Admin Profile
Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');

// View Admin Profile Edit Page
Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');

// Admin Profile Edit Form Submit
Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');


// Admin Password Change Page
Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');

// Admin Password Change Form Submit
Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');



// User Auth and Profile all route

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard',compact('user'));
})->name('dashboard');

// Home Page
Route::get('/', [IndexController::class, 'index']);

// User Logout
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');

// User Profile Edit Page
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');

// User Profile Edit Form Submit
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');

// User Password Change Page
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');

// User Password Change Form Submit
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');


// Admin -> Brand all routes

Route::prefix('brand')->group(function () {

    // Admin -> all brand view page
    Route::get('/view', [BrnadController::class, 'BrandView'])->name('all.brand');

    // Admin -> all brand input form submit
    Route::post('/store', [BrnadController::class, 'BrandStore'])->name('brand.store');

    // Admin -> brand edit page
    Route::get('/edit/{id}', [BrnadController::class, 'BrandEdit'])->name('brand.edit');

    // Admin -> brand edit form submit
    Route::post('/update', [BrnadController::class, 'BrandUpdate'])->name('brand.update');



});
