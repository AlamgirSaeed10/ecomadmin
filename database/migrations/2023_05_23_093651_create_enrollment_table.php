<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentTable extends Migration
{
    public function up()
    {
        Schema::create('enrollment', function (Blueprint $table) {
            $table->increments('EnrollmentID');
            $table->integer('PlanID')->unsigned();
            $table->integer('CourseID');
            $table->integer('StudentID');
            $table->string('StudentName');
            $table->string('FatherName');
            $table->string('StudentCNIC');
            $table->string('StudentPhone');
            $table->string('StudentCity');
            $table->string('StudentEmail');
            $table->string('StudentGender');
            $table->string('TrainingMode');
            $table->string('PaymentOption');
            $table->string('KnowAboutUs');
            $table->string('EnrollmentStatus');
            $table->timestamp('CreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('UpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    public function down()
    {
        Schema::dropIfExists('enrollment');
    }
}
