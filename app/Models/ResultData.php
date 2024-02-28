<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultData extends Model
{
    use HasFactory;
    protected $table = 'result_data';
    protected $primaryKey = 'id';

    protected $fillable = [
        'result_id',
        'question',
        'option',
        'correct_type',
    ];

    public function resultsStudets()
    {
        return $this->belongsTo(ResultsStudets::class);
    }
}
