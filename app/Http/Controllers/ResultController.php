<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ResultExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\TestDb;
use App\Models\Options;
use App\Models\Quizzes;
use App\Models\ResultsStudets;
use App\Models\ResultData;

use Carbon\Carbon;

class ResultController extends Controller
{

    public function export(Request $request)
    {
        $db = TestDb::where('allowed_room_id', $request->query('room_id'))->with('result')->get();
        // return $db;
        $carbonDate = \Carbon\Carbon::parse($db[0]['result'][0]['created_at']);
        $data = [
            'title' => $db[0]['title'],
            'desc' => $db[0]['desc'],
            'complated' => $carbonDate->format('Y-m-d H:i:s'),
        ];
        foreach ($db[0]['result'] as $row) {
            if ($row['userId'] == $request->ip()) {
                $res = ResultsStudets::where('id', $row['id'])->with('resultData')->get();
                $data['percentage'] = $res[0]['result_percentage'];
                foreach ($res as $item) {
                    foreach ($item['resultData'] as $key => $itemData) {
                        $resData =[
                            "id" => $itemData['id'],
                            "question" => $itemData['question'],
                            "option" => $itemData['option'],
                            "correct_type" => $itemData['correct_type'],
                        ];
                        $data['resault_data'][$key] = $resData;
                    }
                }
            }
        }
        // return $data;
        return Excel::download(new ResultExport($data), 'Test_Result.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
            'Excel2007' => [
                'AutoSize' => true,
            ],
        ]);
    }
}
