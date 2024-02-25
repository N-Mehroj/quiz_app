<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultsStudets extends Model
{
    use HasFactory;
    protected $table = 'results_studets';
    protected $primaryKey = 'id';

    protected $fillable = [
        'userId',
        'testDb_id',
        'result_percentage',
    ];
    public function testDb()
    {
        return $this->hasMany(TestDb::class);
    }
}
