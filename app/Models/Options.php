<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Options extends Model
{
    protected $fillable = ['question_id', 'option_text', 'option_value'];

    public function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Questions::class, 'question_id');
    }

    public function answers()
    {
        return $this->hasMany(SurveyResponse::class, 'option_id');
    }
}
