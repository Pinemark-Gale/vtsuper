<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/* MC = multiple choice answer */
class CreateActivityAnswerMCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_answer_mc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_answer_id')->constrained();
            $table->char('placement', 3);
            $table->string('response');
            $table->boolean('correct');
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
        Schema::dropIfExists('activity_answer_mc');
    }
}
