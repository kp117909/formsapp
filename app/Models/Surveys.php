<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Surveys extends Model
{
    protected $fillable = [
        'survey_name',
        'survey_description',
    ];

    public function questions()
    {
        return $this->hasMany(Questions::class, 'survey_id')->orderBy('question_order');
    }

}
