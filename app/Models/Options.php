<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    use HasFactory;
    protected $table = 'options';
    protected $primaryKey = 'id';

    protected $fillable = [
        'quiz_id',
        'options',
        'correct',
    ];
    public function quiz()
    {
        return $this->belongsTo(TestDb::class);
    }
}

