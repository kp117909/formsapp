<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyEdit extends Model
{
    use HasFactory;

    protected $table= "survey_edits";

    protected $fillable = ['survey_id', 'edit_url', 'edit_date'];

}
