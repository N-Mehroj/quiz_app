<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateExamController;
use App\Http\Controllers\ResultController;
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
Route::get('/test_info', [CreateExamController::class,  'TestInfo']);
Route::post('/test_insert', [CreateExamController::class, 'createTestInfo']);
// Route::get("/user",[CreateExamController::class,'user']);
Route::get("/login_quiz",[CreateExamController::class,'loginQuiz']);
Route::post("/get_resault",[CreateExamController::class,'getQuizCorrect']);

Route::get('/result/export/', [ResultController::class, 'export']);
