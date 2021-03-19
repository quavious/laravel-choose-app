<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiresController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get("/users/delete", [UsersController::class, "confirm"])->name("users.confirm");
Route::post("/users/delete", [UsersController::class, "delete"])->name("users.delete");

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get("/posts", [PostsController::class, "index"])->name("posts.index");
Route::get("/posts/create", [PostsController::class, "create"])->name("posts.create");
Route::post("/posts/create", [PostsController::class, "store"])->name("posts.store");
Route::get("/posts/post/{id}", [PostsController::class, "show"])->name("posts.show");
Route::get("/posts/post/{id}/update", [PostsController::class, "edit"])->name("posts.edit");
Route::post("/posts/post/{id}/update", [PostsController::class, "update"])->name("posts.update");
Route::post("/posts/post/{id}/delete", [PostsController::class, "destroy"])->name("posts.delete");
Route::get("/posts/search", [PostsController::class, "search"])->name("posts.search");

Route::post("/posts/post/{id}/like", [LikesController::class, "store"])->name("posts.like");

Route::post("/posts/post/{id}/comment/create", [CommentsController::class, "store"])->name("comments.store");
Route::post("/posts/post/{id}/comment/delete", [CommentsController::class, "destroy"])->name("comments.delete");

Route::get("/inquires", [InquiresController::class, "index"])->name("inquires.index");
Route::get("/inquires/search", [InquiresController::class, "search"])->name("inquires.search");
Route::get("/inquires/create", [InquiresController::class, "create"])->name("inquires.create");
Route::post("/inquires/create", [InquiresController::class, "store"])->name("inquires.store");
Route::get("/inquires/inquire/{id}", [InquiresController::class, "show"])->name("inquires.show");
Route::post("/inquires/inquire/{id}/check", [InquiresController::class, "check"])->name("inquires.check");
