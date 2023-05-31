<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursePlanTable extends Migration
{
    public function up()
    {
        Schema::create('course_plan', function (Blueprint $table) {
            $table->increments('PlanID');
            $table->string('PlanTitle');
            $table->string('PlanDescription');
            $table->integer('PricePKR');
            $table->integer('PriceInternational');
            $table->timestamp('CreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('UpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_plan');
    }
}
    