<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Surveys extends Model
{
    protected $fillable = [
        'survey_name',
        'survey_description',
        'slug',
        'public',
        'open'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($survey) {
            $survey->responses()->delete();
        });
    }

    public function questions()
    {
        return $this->hasMany(Questions::class, 'survey_id')->orderBy('question_order');
    }

    public function edits()
    {
        return $this->hasMany(SurveyEdit::class, 'survey_id');
    }

    public function responses()
    {
        return $this->hasMany(Responses::class, 'survey_id');
    }

    public function surveyResponses()
    {
        return $this->hasMany(SurveyResponse::class, 'survey_id');
    }

}
