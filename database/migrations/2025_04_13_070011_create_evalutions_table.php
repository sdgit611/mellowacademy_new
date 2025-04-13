<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvalutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evalutions', function (Blueprint $table) {
            $table->id();
            $table->string('dev_id');
            $table->string('user_id');
            $table->string('feedback1');
            $table->string('feedback2');
            $table->string('feedback3');
            $table->string('feedback4');
            $table->string('feedback5');
            $table->string('feedback6');
            $table->string('feedback7');
            $table->string('feedback8');
            $table->string('feedback9');
            $table->string('feedback10');
            $table->string('feedback11');
            $table->string('feedback12');
            $table->string('problems');
            $table->string('suggestion_future_topics');
            $table->string('final_comments');










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
        Schema::dropIfExists('evalutions');
    }
}
