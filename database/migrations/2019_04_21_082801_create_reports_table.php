<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('report_id', 30)->unique();
            $table->string('file_name');
            $table->string('file_type');
            $table->string('owner', 30);
            $table->string('email');
            $table->integer('status');
            $table->integer('word_count');
            $table->integer('sentence_count')->default(0);
            $table->integer('search_type')->default(1);
            $table->integer('matching_sentence_count')->default(0);
            $table->integer('score')->default(0);
            $table->string('report_file_url')->nullable();
            $table->string('temp_file_url')->nullable();
            $table->text('match_url')->nullable();
            $table->text('data')->nullable();
            $table->timestamp('made_at');
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
        Schema::dropIfExists('reports');
    }
}
