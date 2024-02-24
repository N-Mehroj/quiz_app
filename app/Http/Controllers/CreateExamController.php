<?php

namespace App\Http\Controllers;

use App\Models\TestDb;
use App\Models\Options;
use Illuminate\Http\Request;
use App\Models\Quizzes;
use App\Models\User;

class CreateExamController extends Controller
{
    //
    public function joinExam()
    {
        return view('index');
    }
    public function createExam()
    {
       if(session('idTest')){
           return view('admin.create_quizzes');
       }else{
          return redirect()->back();
       }
    }
    public function TestInfo()
    {
       if(!session('idTest')){
           return view('admin.testDb');
       }else{
         return redirect()->back();
       }
    }
    public function createTestInfo(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required|min:3',
                'desc' => 'required|min:5',
                'start_date' => 'required',
                'end_date' => 'required',
                'time' => 'required',
                'allCount' => 'required',
                'showingCount' => 'required',
            ]
        );
        $room_id = bin2hex(random_bytes(5));
        $testDb = TestDb::create([
            'title' => $request->get('title'),
            'desc' => $request->get('desc'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'time' => $request->get('time'),
            'quiz_count' => $request->get('allCount'),
            'quiz_views_count' => $request->get('showingCount'),
            'allowed_room_id' => $room_id,
        ]);
        if ($testDb) {
            session(['idTest' => $testDb->id]);
            return redirect('/admin');
        } else {
            return redirect()->back();
        }
    }
    public function insetExam(Request $request)
    {
        $groupedData = [];
        $currentQuestion = null;

        foreach ($request->all() as $item) {
            $key = $item[0];
            $value = $item[1];

            if (strpos($key, 'Question') !== false) {
                $currentQuestion = $value;
                $groupedData[$currentQuestion] = ['Question' => $value, 'Options' => [], 'Answer' => ''];
            } elseif (strpos($key, 'Option') !== false) {
                $groupedData[$currentQuestion]['Options'][] = [$key => $value];
            } elseif (strpos($key, 'Answer') !== false) {
                $groupedData[$currentQuestion]['Answer'] = $value;
            }
        }

        $quzz = [];
        foreach ($groupedData as $key => $q) {
            foreach ($q as $key => $qu) {
                if ($key == 'Question') {
                    $quzz[] = $qu;
                    $quizCreate = Quizzes::create([
                        'test_id' => session('idTest'),
                        'question' => $qu,
                    ]);
                }
                print_r($q);
                if ($quizCreate) {
                    if ($key == 'Options') {
                        $vall = [];
                        foreach ($qu as $key => $value) {
                            foreach ($value as $key => $val) {
                                $vall[] = $val;
                            }
                            $encode = json_encode($vall);
                        }
                        Options::create([
                            'quiz_id' => $quizCreate->id,
                            'options' => $encode,
                            'correct' => $q['Answer'],
                        ]);
                    }
                }
            }
        }
        session()->forget('idTest');
    }

    public function loginQuiz(Request $request){
         $test = TestDb::where('allowed_room_id',$request->query('room_id'))->first();
         if(!$test){
             return redirect()->back();
         }else{
            return view('quiz.quiz_area');
            //  print_r($test[0]);
            //  return $test;
         }
    }
}
