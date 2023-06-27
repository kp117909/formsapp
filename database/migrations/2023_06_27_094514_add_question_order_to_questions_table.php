<?php

use App\Models\Questions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->integer('question_order')->after('is_required')->nullable();
        });

        // Przypisanie wartości dla istniejących rekordów
        $questions = Questions::orderBy('id')->get();
        $questionCountBySurvey = [];

        foreach ($questions as $question) {
            $surveyId = $question->survey_id;

            if (!isset($questionCountBySurvey[$surveyId])) {
                $questionCountBySurvey[$surveyId] = 1;
            }

            $question->question_order = $questionCountBySurvey[$surveyId]++;
            $question->save();
        }
    }

    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('question_order');
        });
    }
};
