<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_tests', function (Blueprint $table) {
            $table->id();
            $table->integer("TestID")->nullable();
            $table->string("SubTestId")->nullable();
            $table->string("SubTestDOSCode")->nullable();
            $table->string("SubTestName")->nullable();
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
        Schema::dropIfExists('sub_tests');
    }
}
