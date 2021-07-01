<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/user')->name('user.')->group(function(){
   Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
       Route::view('/login', 'auth.login')->name('login');
       Route::view('/register', 'auth.register')->name('register');
       Route::post('/create',[UserController::class,'create'])->name('create');
       Route::post('/login',[UserController::class,'login'])->name('login');
   });

   //all authenticate route
   Route::middleware(['auth:web','PreventBackHistory'])->group(function(){
       Route::view('/home','home')->name('home');
       Route::post('/logout',[UserController::class,'logout'])->name('logout');
   });
});

//admin route
Route::prefix('/admin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin'])->group(function () {
        Route::view('/login','admin.auth.login')->name('login');
        Route::post('/login',[App\Http\Controllers\Admin\AdminController::class,'login'])->name('login');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::view('/dashboard','home')->name('home');
    });
});

Route::prefix('/doctor')->name('doctor.')->group(function(){
    Route::middleware(['guest:doctor'])->group(function () {
        Route::view('/login','doctor.auth.login')->name('login');
        Route::post('/login',[App\Http\Controllers\Doctor\DoctorController::class,'login'])->name('login');
    });

    Route::middleware(['auth:doctor'])->group(function () {
        Route::view('/dashboard','home')->name('home');
        Route::post('/logout',[App\Http\Controllers\Doctor\DoctorController::class,'logout'])->name('logout');
    });
});

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


//accessor and mutators
Route::get('/getrole',function(){
    $role = Role::find(4);
    return $role->name;
    
});

Route::get('/setrole',function(){
    $role =new Role;
    $role->name = 'subscriber';
    $role->save();
});

//query scope
Route::get('/query/scope',function(){
    $roles = Role::latest()->get();
    // dd($roles);
    foreach($roles as $role){
        echo $role->name."<br>";
    }
});


