<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/register',[\App\Http\Controllers\AuthController::class,'showRegistrationForm'])->name('register');
Route::post('/register',[\App\Http\Controllers\AuthController::class,'register']);
Route::get('/login',[\App\Http\Controllers\AuthController::class,'showLoginForm'])->name('login');
Route::post('/login',[\App\Http\Controllers\AuthController::class,'login']);
Route::get('/introduce',[\App\Http\Controllers\UserController::class,'showIntroduce'])->name('introduce');
Route::get('/contact',[\App\Http\Controllers\UserController::class,'showContact'])->name('contact');
Route::get('/home',[\App\Http\Controllers\UserController::class,'showHome'])->name('home');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/user/home',[\App\Http\Controllers\UserController::class,'home'])->name('user.home')->middleware('auth');
Route::get('/admin/home',[\App\Http\Controllers\AdminController::class,'home'])->name('admin.home')->middleware('auth');

Route::get('/post', [\App\Http\Controllers\PostController::class, 'showPost'])->name('post');
Route::get('/post/create',[\App\Http\Controllers\PostController::class,'create'])->name('post.create');
Route::post('/post/create',[\App\Http\Controllers\PostController::class,'store']);
Route::get('/post/detail/{id}', [PostController::class, 'showDetailPost'])->name('post.detail');

Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');

Route::get('/user/profile',[\App\Http\Controllers\UserController::class,'showProfilePage'])->name('user.profile');
Route::post('/user/profile/updateProfile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
Route::delete('/user/profile/deletePost/{id}', [PostController::class, 'deletePost'])->name('user.deletePost');
Route::delete('/user/profile/deleteComment/{id}', [CommentController::class,'deleteComment'])->name('user.deleteComment');
 
Route::get('/admin/user-management',[\App\Http\Controllers\AdminController::class,'showUserManagementPage'])->name('user.management');
Route::delete('/admin/user-management/deleteUser/{id}', [AdminController::class,'deleteUser'])->name('admin.deleteUser');

Route::delete('/admin/post-management/deleteUser/{id}', [AdminController::class,'deletePost'])->name('admin.deletePost');
Route::get('/admin/post-management',[\App\Http\Controllers\AdminController::class,'showPostManagementPage'])->name('post.management');
Route::get('/admin/post-management/price',[\App\Http\Controllers\AdminController::class,'showPostManagementPage'])->name('post.price management');
Route::get('/admin/user-management',[\App\Http\Controllers\AdminController::class,'showUserManagementPage'])->name('user.management');

Route::get('/admin/comment-management',[\App\Http\Controllers\AdminController::class,'showCommentManagementPage'])->name('comment.management');
Route::delete('/admin/comment-management/deleteComment/{id}', [AdminController::class,'deleteComment'])->name('admin.deleteComment');


Route::get('/admin/profile',[\App\Http\Controllers\AdminController::class,'showProfileAdmin'])->name('admin.profile');
Route::post('/admin/profile/updateProfile', [AdminController::class, 'updateProfileAdmin'])->name('admin.updateProfile');




