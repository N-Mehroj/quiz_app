<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use LDAP\Result;

class TestDb extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'testDb';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'desc',
        'start_date',
        'end_date',
        'time',
        'quiz_count',
        'quiz_views_count',
        'allowed_room_id'
    ];
    public function quiz()
    {
        return $this->hasMany(Quizzes::class,'test_id', 'id');
    }
    public function result()
    {
        return $this->hasMany(ResultsStudets::class,'testDb_id', 'id');
    }

}
