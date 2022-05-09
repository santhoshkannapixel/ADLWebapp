<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->integer("BranchId")->nullable();
            $table->string("BranchCode")->nullable();
            $table->string("BranchName")->nullable();
            $table->integer("BranchCityId")->nullable();
            $table->string("BranchCity")->nullable();
            $table->text("BranchAddress")->nullable();
            $table->string("BrachContact")->nullable();
            $table->string("BranchEmail")->nullable();
            $table->string("IsProcessingLocation")->nullable();
            $table->text("BranchTimings")->nullable();
            $table->string("State")->nullable();
            $table->string("Country")->nullable();
            $table->integer("Pincode")->nullable();
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
        Schema::dropIfExists('branches');
    }
}
