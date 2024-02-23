<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateExamController extends Controller
{
    //
    public function joinExam(){
        return view('index');
    }
    public function createExam(){
        return view('admin.create_quizzes');
    }
    public function insetExam(Request $request){
        $file = $request->file('file_1');

        // Faylni "storage/app/uploads" papkasiga saqlash
        $path = $file->store('uploads');
    }
}
