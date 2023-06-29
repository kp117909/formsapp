<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'question_id',
        'response_id',
        'answer',
    ];

    public function survey()
    {
        return $this->belongsTo(Surveys::class, 'survey_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Questions::class, 'question_id');
    }

    public function options()
    {
        return $this->hasMany(Options::class, 'id' , 'option_id');
    }
}
