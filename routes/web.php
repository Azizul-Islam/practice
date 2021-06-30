<?php

use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//one to one relationship
Route::get('/address/insert',[App\Http\Controllers\AddressController::class,'store']);
Route::get('/address/index',[App\Http\Controllers\AddressController::class,'index']);
Route::get('/address/update',[App\Http\Controllers\AddressController::class,'update']);
Route::get('/address/destroy',[App\Http\Controllers\AddressController::class,'destroy']);

//one to one inverse
Route::get('/address/{id}/user',[\App\Http\Controllers\AddressController::class,'getUser']);

//one to many relationship
Route::get('/address/user',[\App\Http\Controllers\AddressController::class,'getAddress']);
Route::get('/user/post',[\App\Http\Controllers\PostController::class,'store']);
Route::get('/user/posts',[\App\Http\Controllers\PostController::class,'index']);
Route::get('/user/post/update',[\App\Http\Controllers\PostController::class,'update']);
Route::get('/user/post/delete',[\App\Http\Controllers\PostController::class,'destroy']);

//many to many relationship
Route::get('/user/role',[App\Http\Controllers\RoleController::class,'store']);
Route::get('/user/{id}/role',[App\Http\Controllers\RoleController::class,'index']);
Route::get('/user/{id}/role/update',[App\Http\Controllers\RoleController::class,'update']);
Route::get('/user/{id}/role/delete',[App\Http\Controllers\RoleController::class,'delete']);
Route::get('/user/{id}/role/attach',[App\Http\Controllers\RoleController::class,'attach']);
Route::get('/user/{id}/role/detach',[App\Http\Controllers\RoleController::class,'detach']);

//relation with intermediat table
Route::get('/user/pivot',function(){
    $user = User::find(1);
    foreach($user->roles as $role){
        echo $role->pivot;
    }
});

//hash many through
Route::get('/country/post',[App\Http\Controllers\CountryController::class,'index']);

//morph many relationsip
Route::get('/staff/photo/read',[\App\Http\Controllers\StaffController::class,'index']);
Route::get('/staff/photo',[\App\Http\Controllers\StaffController::class,'store']);
Route::get('/staff/photo/update',[\App\Http\Controllers\StaffController::class,'update']);
Route::get('/staff/photo/delete',[\App\Http\Controllers\StaffController::class,'delete']);

