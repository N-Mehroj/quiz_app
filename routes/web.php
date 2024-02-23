<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateExamController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CreateExamController::class, 'joinExam']);
Route::get('/admin', [CreateExamController::class, 'createExam']);
Route::post('/insert', [CreateExamController::class, 'insetExam']);
// Route::get("/user",[CreateExamController::class,'user']);
