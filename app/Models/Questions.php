<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'survey_id',
        'question_text',
        'question_type',
        'is_required',
        'question_order',
    ];

    public function survey()
    {
        return $this->belongsTo(Surveys::class);
    }

    public function options()
    {
        return $this->hasMany(Options::class, 'question_id');
    }
}
