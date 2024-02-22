<?php

namespace App\Models\Api\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'order_changing',
        'option_changing',
        'quiz_count',
        'quiz_views_count',
        'allowed_room_id'
    ];

}
