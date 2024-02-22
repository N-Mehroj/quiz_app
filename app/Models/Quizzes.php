<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizzes extends Model
{
    use HasFactory;
    protected $table = 'quizzes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'file_id',
        'question',
        'image',
    ];
}
