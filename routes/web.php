<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Todo\TodoController;

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

Route::get('/todo',[TodoController::class,'create'])->name('todo');
Route::post('/todo_store',[TodoController::class,'store'])->name('todo_store');
Route::get('/todo_show',[TodoController::class,'show'])->name('todo_show');
Route::get('todo_delete/{todo_id}',[TodoController::class,'destroy']);
Route::delete('bulkcategoryDelete',[TodoController::class,'deleteAll'])->name('bulkcategoryDelete');

