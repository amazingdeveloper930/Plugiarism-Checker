<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_token', 30);
            $table->string('report_id', 30)->nullable();
            $table->string('file_name', 255);
            $table->string('file_path', 255);
            $table->string('email')->nullable();
            $table->string('report_url', 255)->nullable();
            $table->string('file_format', 30);
            $table->boolean('ispaid')->default(false);
            $table->integer('status');
            $table->integer('file_size');
            $table->integer('text_size');
            $table->float('price');
            $table->integer('available_time_sec');
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
        Schema::dropIfExists('document_files');
    }
}
