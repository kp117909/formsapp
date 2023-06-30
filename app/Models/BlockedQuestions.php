<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedQuestions extends Model
{
    use HasFactory;

    protected $fillable = [
        'option_id',
        'blocked_question_id',
    ];

    public function options()
    {
        return $this->belongsTo(Options::class, 'id');
    }

}
