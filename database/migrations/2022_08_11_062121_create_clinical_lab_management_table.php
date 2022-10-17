<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalLabManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_lab_management', function (Blueprint $table) {
            $table->id();
            $table->string('doctors_name')->nullable();
            $table->string('specialization')->nullable();
            $table->string('associated_hospitals_Clinics')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('message')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('clinical_lab_management');
    }
}
