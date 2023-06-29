<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responses extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'response_id'
    ];

    public function survey()
    {
        return $this->belongsTo(Surveys::class, 'survey_id');
    }

    public function surveyResponses(){
        return $this->hasMany(SurveyResponse::class, 'response_id');
    }

}
