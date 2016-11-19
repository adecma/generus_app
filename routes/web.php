<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
if (!env('ALLOW_REGISTRATION', false)) {
    Route::any('/register', function() {
        abort(403);
    });
}

Route::get('/home', 'HomeController@index')->name('home.index');
Route::get('/home/profile', 'HomeController@profile')->name('home.profile');
Route::post('/home/profile/edit', 'HomeController@profileUpdate')->name('home.profile_update');
Route::get('/home/profile/edit', 'HomeController@profileEdit')->name('home.profile_edit');
Route::post('/home/profile/replace_password', 'HomeController@updatePassword')->name('home.update_password');
Route::get('/home/profile/replace_password', 'HomeController@replacePassword')->name('home.replace_password');

Route::get('/kelompok', function(){
    return redirect()->route('home.index');
})->middleware('auth', 'role:kelompok|viewer|master');

Route::group(['prefix' => 'kelompok', 'middleware' => ['auth', 'role:kelompok|viewer|master']], function() {
	Route::get('/generus/search', 'GenController@search')->name('generus.search');
	Route::get('/generus/count', 'GenController@count')->name('generus.count');
    Route::post('/generus/{generus}/avatar', 'GenController@update_avatar')->name('generus.avatar');
    Route::resource('/generus', 'GenController');
});

Route::get('/desa', function(){
    return redirect()->route('home.index');
})->middleware('auth', 'role:master');

Route::group(['prefix' => 'desa', 'middleware' => ['auth', 'role:master']], function() {
    Route::get('/role/search', 'RoleController@search')->name('role.search');
    Route::resource('/role', 'RoleController', ['except' => 'show']);

    Route::get('/permission/search', 'PermissionController@search')->name('permission.search');
    Route::resource('/permission', 'PermissionController', ['except' => 'show']);

    Route::get('/user/search', 'UserController@search')->name('user.search');
    Route::resource('/user', 'UserController', ['except' => 'show']);

    Route::get('/kategori/search', 'KategoriController@search')->name('kategori.search');
    Route::resource('/kategori', 'KategoriController', ['except' => 'show']);

    Route::get('/kelompok/search', 'KelompokController@search')->name('kelompok.search');
    Route::resource('/kelompok', 'KelompokController', ['except' => 'show']);
});
