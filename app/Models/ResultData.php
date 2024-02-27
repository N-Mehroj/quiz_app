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
        'quiz_id',
        'question',
        'option',
    ];
}
