<?php

namespace App\Exports;

use App\Models\Quizzes;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
// use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ResultExport implements FromView,ShouldAutoSize
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    // /**
    //  * @return \Illuminate\Support\Collection
    //  */
    // public function collection()
    // {
    //     return $this->data;
    // }

    /**
     * @return View
     */

    public function view(): View
    {
        return view('result.export', [
            'data' => $this->data
        ]);
    }
}
