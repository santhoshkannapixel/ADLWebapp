<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderedTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_tests', function (Blueprint $table) {
            $table->id();
            $table->string("order_id")->nullable();
            $table->string("TestId")->nullable();
            $table->string("DosCode")->nullable();
            $table->text("TestName")->nullable();
            $table->text("AliasName1")->nullable();
            $table->text("AliasName2")->nullable();
            $table->string("ApplicableGender")->nullable();
            $table->string("IsPackage")->nullable();
            $table->string("Classifications")->nullable();
            $table->text("TransportCriteria")->nullable();
            $table->longText("SpecialInstructionsForPatient")->nullable();
            $table->longText("SpecialInstructionsForCorporates")->nullable();
            $table->longText("SpecialInstructionsForDoctors")->nullable();
            $table->longText("BasicInstruction")->nullable();
            $table->string("DriveThrough")->nullable();
            $table->string("HomeCollection")->nullable();
            $table->string("TestSchedule")->nullable();
            $table->integer("TestPrice")->nullable();
            $table->longText("TestImages")->nullable();
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
        Schema::dropIfExists('ordered_tests');
    }
}
