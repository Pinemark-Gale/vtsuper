<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/* MC = multiple choice answer */
class CreateSubmissionAnswerMCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_answer_mc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_question_id')->constrained();
            $table->char('placement', 3);
            $table->string('response');
            $table->boolean('correct');
            $table->boolean('selected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submission_answer_mc');
    }
}
