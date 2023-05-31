<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('CertificateID');
            $table->string('CertificateNo')->nullable();
            $table->integer('CourseID')->unsigned();
            $table->integer('StudentID')->nullable();
            $table->date('StartingDate')->nullable();
            $table->date('CompilitionDate')->nullable();
            $table->string('CertificateImage')->nullable();
            $table->date('CreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('UpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
