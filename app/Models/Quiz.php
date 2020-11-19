<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Test;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'test_id',
        'question',
        'correct_answer',
        'answer',
        'score'
    ];
    public function testsq()
    {
        return $this->belongsTo(Test::class,'test_id');
    }
}
