<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesOfferedTable extends Migration
{
    public function up()
    {
        Schema::create('courses_offered', function (Blueprint $table) {
            $table->increments('CourseID');
            $table->string('CourseCode');
            $table->string('CourseName');
            $table->text('CourseImage');
            $table->text('CourseDescription');
            $table->date('CourseStartDate');
            $table->date('CourseEndDate');
            $table->timestamp('CreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('UpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses_offered');
    }
}
