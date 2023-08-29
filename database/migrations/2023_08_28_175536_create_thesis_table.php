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
            $table->json('author')->nullable();
            $table->text('abstract')->nullable();
            $table->string('file_url')->nullable();
            $table->integer('view_count')->default(0);
            $table->integer('download_count')->default(0);
            $table->json('keywords')->nullable();
            $table->integer('published_year')->nullable();
            $table->timestamps();
            
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
