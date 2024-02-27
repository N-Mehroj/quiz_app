<?php

namespace App\Http\Controllers;

use App\Models\TestDb;
use App\Models\Options;
use Illuminate\Http\Request;
use App\Models\Quizzes;
use App\Models\ResultsStudets;
use App\Models\ResultData;
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
        if (session('idTest')) {
            return view('admin.create_quizzes');
        } else {
            return redirect()->back();
        }
    }
    public function TestInfo()
    {
        if (!session('idTest')) {
            return view('admin.testDb');
        } else {
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
        // return $request->all();
        $radioCorrectKey = [];
        $a = 0;
        foreach ($request->get('radio') as $key => $radio) {
            if ($radio == 'on') {
                $radioCorrectKey[] = $a;
            } else {
                $a++;
            }
        }

        $options = [];
        foreach ($request->get('answer') as $key => $allAnswer) {
            $options[] = $allAnswer;
        }
        foreach ($radioCorrectKey as $answ) {
            foreach ($request->get('answer') as $key => $answer) {
                if ($answ == $key) {
                    $correct[] = $answer;
                }
            }
        }
        $options = json_encode($options);
        $correct = json_encode($correct);
        $quizCreate = Quizzes::create([
            'test_id' => session('idTest'),
            'question' => $request->get('quiz')[0],
            'quiz_type' => $request->get('quiz_type')[0],
        ]);
        if ($quizCreate) {
            Options::create([
                'quiz_id' => $quizCreate->id,
                'options' => $options,
                'correct' => $correct,
            ]);
        }
        return redirect()->back();
    }

    public function loginQuiz(Request $request)
    {
        $test = TestDb::where('allowed_room_id', $request->query('room_id'))->with('result')->get();
        if ($request->ip() == @$test[0]->result[0]['userId']) {
            return redirect('/');
        }

        if ($test->count() != 1) {
            return redirect()->back();
        } else {
            $quizzes =  Quizzes::where('test_id', $test[0]->id)
                ->limit($test[0]->quiz_views_count)
                ->with('options')
                ->inRandomOrder()
                ->get();
            $quizlist = [];
            foreach ($quizzes as $key => $quiz) {
                $newItem = [
                    'id' => $quiz['id'],
                    'test_id' => $quiz['test_id'],
                    'question' => $quiz['question'],
                ];
                $newItem['options'] = [];
                foreach ($quiz['options'] as $option) {
                    $newItem['options'] = [
                        'id' => $option['id'],
                        'quiz_id' => $option['quiz_id'],
                        'options' => json_decode($option['options']),
                        'correct' => $option['correct'],
                    ];
                }
                $quizlist[] = $newItem;
            }
            return view('quiz.quiz_area', compact('quizlist', 'test'));
        }
    }

    public function getQuizCorrect(Request $request)
    {
        $test = TestDb::where('allowed_room_id', $request[0]['room_id'])->first();
        // return $test['quiz_views_count'];
        $correctCount = 0;
        $resault = [];
        foreach ($request->all() as $item) {
            foreach ($item['answer'] as $key => $ans) {
                $quizzes =  Quizzes::where('id', $ans['id'])->with('options')->get();
                // return json_decode($quizzes[0]['options'][0]['correct']);
                // print_r($ans['vall']);
                print_r(json_decode($quizzes[0]['options'][0]['correct']));
                // $res= [];
                foreach (json_decode($quizzes[0]['options'][0]['correct']) as $key => $value) {
                    // $res[] = $value;
                    if ($value == $ans['vall']) {
                        // print_r($value);
                        $res = [
                            'id' => $quizzes[0]['id'],
                            'question' => $quizzes[0]['question'],
                            'correct' => 1,
                        ];
                        $resault[] = $res;
                        $correctCount++;
                    }
                    if($value != $ans['vall']) {
                        $res = [
                            'id' => $quizzes[0]['id'],
                            'question' => $quizzes[0]['question'],
                            'correct' => $ans['vall'],
                        ];
                        $resault[] = $res;
                    }
                }
                // if (array_intersect($ans['vall'], json_decode($quizzes[0]['options'][0]['correct']))) {
                //     $res = [
                //         'id' => $quizzes[0]['id'],
                //         'question' => $quizzes[0]['question'],
                //         'correct' => 1,
                //     ];
                //     $resault[] = $res;
                //     $correctCount++;
                // } else {
                //     $res = [
                //         'id' => $quizzes[0]['id'],
                //         'question' => $quizzes[0]['question'],
                //         'correct' => $ans['vall'],
                //     ];
                //     $resault[] = $res;
                // }
            }
        }
        usort($resault, function ($a, $b) {
            return $a['id'] - $b['id'];
        });
        $resault['percent'] = ((string)($correctCount / $test['quiz_views_count']) * 100) . '%';
        $resault['ip'] = $request->ip();
        $resData = ResultsStudets::create([
            // 'userId' => $request->ip(),
            'userId' => '120',
            'testDb_id' => $test->id,
            'result_percentage' => $resault['percent'],
        ]);
        if ($resData) {
            $id = [];
            foreach ($resault as $key => $resGetData) {
                // $id[] = $res['id'];
                if (gettype($key) != 'string') {
                    ResultData::create([
                        'quiz_id' => $resGetData['id'],
                        'question' => $resGetData['question'],
                        'option' => $resGetData['correct'],
                    ]);
                }
            }
        }

        return view('quiz.ajax', compact('resault'));
    }
}
