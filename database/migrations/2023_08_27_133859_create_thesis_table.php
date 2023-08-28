<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('department_id');
            $table->integer('course_id');
            $table->string('title')->nullable();
            $table->text('author')->nullable();
            $table->text('abstract')->nullable();
            $table->binary('file');
            $table->integer('view_count')->nullable();
            $table->integer('download_count')->default(0);
            $table->integer('published_year')->nullable();
            $table->dateTime('created_at')->nullable();
            
            $table->foreign('course_id', 'fk_thesis_courses1')->references('id')->on('courses');
            $table->foreign('department_id', 'fk_thesis_departments1')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thesis');
    }
}
