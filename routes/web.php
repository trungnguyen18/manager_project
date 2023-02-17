<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['verify' => true]);

Route::get('/dashboard', 'DashboardController@dashboard')->middleware('auth');

//user
Route::get('admin/user/list', 'AdminUserController@index')->middleware('can:list_user');
Route::get('admin/user/add', 'AdminUserController@add')->middleware('can:add_user');
Route::post('admin/user/store', 'AdminUserController@store')->name('user_store');
Route::get('admin/user/update/{id}', 'AdminUserController@update')->name('user_update')->middleware('can:edit_user');
Route::get('admin/user/edit/{id}', 'AdminUserController@edit')->name('user_edit');
Route::get('admin/user/delete/{id}', 'AdminUserController@delete')->name('delete_user')->middleware('can:delete_user');

//Role
Route::get('admin/role/list', 'AdminRoleController@list');
Route::get('admin/role/create', 'AdminRoleController@create')->name('role_create');
Route::post('admin/role/store', 'AdminRoleController@store')->name('role_store');
Route::get('admin/role/update/{id}', 'AdminRoleController@update')->name('role_update');
Route::post('admin/role/edit/{id}', 'AdminRoleController@edit')->name('role_edit');
Route::get('admin/role/delete/{id}', 'AdminRoleController@delete')->name('role_delete');

//permission
Route::get('admin/permission/create', 'AdminPermissionController@createPermission')->name('permission_create');
Route::post('admin/permission/store', 'AdminPermissionController@store')->name('permission_store');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/admin', 'HomeController@admin')->name('admin')->middleware('verified');

Route::get('/post/list', 'PostController@index')->name('post.index');
Route::get('/post/show/{id}', 'PostController@show')->name('post.show');
Route::get('/post/create', 'PostController@create')->name('post.create');
